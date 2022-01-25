<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Guru;
use App\Imports\GuruImport;
use App\Jadwal;
use App\Mapel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Guru::all();
        $mapels = Mapel::all();
        return view('admin.guru.index', compact(['data','mapels']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nip'            => 'nullable|unique:gurus,nip,',
            'jeniskelamin'   => 'required',
            'mapel_id'       => 'required',
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'no_hp'          => 'required',
            'jabatan'        => 'required',
            'jurusan'        => 'required',
            'email'          => 'required|unique:gurus,email', 
        ]);

        $user = new User;
        $user->role = 'guru';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->remember_token = str::random(60);
        $user->save();

        $request->request->add(['user_id'=> $user->id]);
        Guru::create($request->all());
        
        return back()->withInfo('Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.profil',compact(['guru']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'nip'            => 'nullable|unique:gurus,nip,'.$id,
            'jeniskelamin'   => 'required',
            'mapel_id'        => 'required',
            'nuptk'          => 'nullable|unique:gurus,nuptk,'.$id,
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'no_hp'          => 'required',
            'jabatan'        => 'required',
            'jurusan'        => 'required',
            'email'          => 'required|unique:gurus,email,'.$id,
            'avatar'         => 'mimes:jpeg,png,jpg',  
        ]);

        $guru = Guru::find($id);

        $guru->update($request->all());
        if($request->hasFile('avatar')){

            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $guru->avatar = $request->file('avatar')->getClientOriginalName();
            $guru->save();
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
        $guru = Guru::find($id);
        $guru->user()->delete();
        $guru->delete();
        return back()->withInfo('Data Guru berhasil dihapus');
    }

    public function profilguru(){

        $guru = auth()->user()->guru;
        return view ('guru.profilguru', compact(['guru']));
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
		$file->move('file_guru',$nama_file);
 
		// import data
		Excel::import(new GuruImport, public_path('/file_guru/'.$nama_file));

 
		// notifikasi dengan session
 
		// alihkan halaman kembali
		return redirect('/guru')->withInfo('guru sudah diimport');

    
    }
    public function cetak_excel()
	{
		return Excel::download(new GuruExport,'guru.xlsx');
        
    }
    public function jadwalGuru($idguru){
        $guru = Guru::find($idguru);
        $jadwal = DB::table('gurus')
                  ->join('jadwals as j','gurus.id','j.guru_id')
                  ->join('kelas as k','k.id','j.kelas_id')
                  ->join('mapels as m','m.id','j.mapel_id')
                  ->select(
                      'j.hari',
                      'j.jam_mulai',
                      'j.jam_selesai',
                      'k.namakelas',
                      'gurus.nama',
                      'm.nama as mapel'
                  )
                  ->where('j.guru_id',$guru->id)
                  ->get();
        // dd($jadwal);
        return view('guru.jadwalguru',compact('guru','jadwal'));
    }
}
