<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Guru;
use App\Imports\SiswaImport;
use App\Kelas;
use App\Mapel;
use App\Siswa;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = \App\Kelas::all();
        $data = \App\Siswa::all();
        return view('admin.siswa.index', compact(['data','kelass']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required',
            'nis'           => 'required|unique:siswas,nis',
            'jeniskelamin'   => 'required',
            'nisn'           => 'required|unique:siswas,nisn',
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'kelas_id'       => 'required',
            'nama_orangtua'  => 'required',
            'email'          => 'required|unique:siswas,email',
        ]);

        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->remember_token = str::random(60);
        $user->save();

        $request->request->add(['user_id'=> $user->id]);
        Siswa::create($request->all());

        return back()->withInfo('Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {

        /**
         *
         * Disini saya cek kondisi dia guru apa bukan kalu guru saya
         * ambil matapelajaran melalui relationship jadi saya ambil data guru yang login sekarang
         * terus ambil relasi mapelnya
         * kalau dia bukan guru yaudah saya get semua mapel lewat table mapel
         */
        if(Auth::user()->role == 'guru'){
            $matapelajaran = Guru::with(['mapels'])->where('user_id',Auth::user()->id)->first()
                ->mapels;
        }else{
            $matapelajaran = Mapel::all();
        }



        $mapelCharts = Mapel::all();
        $kelas = Kelas::all();
        $siswa = Siswa::find($id);
        $mapel = Mapel::find($id);
        $categories = [];
        $data =[];


        foreach($mapelCharts as $mp){


            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[]= $mp->nama;
                $data[]= $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->uas;
            }
        }


        return view ('admin.siswa.profil',compact(['siswa','kelas','matapelajaran','categories','data','mapel']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'           => 'required',
            'nis'           => 'required|unique:siswas,nis,'.$id,
            'jeniskelamin'   => 'required',
            'nisn'           => 'required|unique:siswas,nisn,'.$id,
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'nama_orangtua'  => 'required',
            'email'          => 'required|unique:siswas,email,'.$id,
            'avatar'         => 'mimes:jpeg,png,jpg',
        ]);

        $siswa = Siswa::find($id);

        $siswa->update($request->all());
        if($request->hasFile('avatar')){

            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return back()->withInfo('Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->user()->delete();
        $siswa->delete();

        return back()->withInfo('Data sudah dihapus');
    }
    public function addnilai(Request $request, $idsiswa){

        $request->validate([
            'mapel' => 'required',
            'nilai' => 'required|max:3',
        ]);

        $siswa=\App\Siswa::find($idsiswa);

        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->withError('Data sudah ada!!');
        }

        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai,'guru_id' => Auth::user()->id,'uh'=>$request->uh,'tugas'=>$request->tugas,'uts'=>$request->uts,'uas'=>$request->uas]);
        // ['nilai'=>$request->nilai]);
        return redirect('siswa/'.$idsiswa.'/profile')->withInfo('Data sudah ditambah');
    }
    public function updatenilai(Request $request,$idsiswa){
        $request->validate([
            'mapel' => 'required',
            'nilai' => 'required|max:3',
        ]);
        $siswa=\App\Siswa::find($idsiswa);
        $siswa->mapel()->updateExistingPivot($request->mapel,['nilai' => $request->nilai,'guru_id' => Auth::user()->id,'uh'=>$request->uh,'tugas'=>$request->tugas,'uts'=>$request->uts,'uas'=>$request->uas]);
        // dd($request->all());
        return redirect('siswa/'.$idsiswa.'/profile')->withInfo('Data sudah diupdate!');
    }
    public function deletenilai($idsiswa, $idmapel){

        $siswa = Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses','Data sudah dihapus');

    }

    public function cetak_rapor_pdf($id)
    {

        $siswa = Siswa::find($id);
        $today = \Carbon\Carbon::now()->format('j F Y');
        // dd($siswa);

    	$pdf = PDF::loadView('admin.siswa.rapor_pdf',['siswa'=>$siswa,'today'=>$today]);
    	return $pdf->stream('rapor.pdf');


    }
    public function profilsaya()
    {
        $kelas = Kelas::all();
        $matapelajaran = Mapel::all();
        $siswa = auth()->user()->siswa;
        $categories = [];
        $data =[];

        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[]= $mp->nama;
                $data[]= $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }

        return view ('siswa.profilsaya',compact(['siswa','kelas','matapelajaran','categories','data',]));
    }
    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_siswa',$nama_file);
 
		// import data
		Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));

 
		// notifikasi dengan session
 
		// alihkan halaman kembali
		return redirect('/siswa')->withInfo('siswa sudah diimport');
	}
    public function export_excel()
	{
		return Excel::download(new SiswaExport, 'siswa.xlsx');
	}
}
