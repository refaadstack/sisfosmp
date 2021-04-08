<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\Kelas;
use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('namakelas', 'asc')->get();
        $kelas2 = Kelas::all();
        $guru = Guru::OrderBy('id', 'asc')->get();
        $mapel = Mapel::all();
        return view('admin.jadwal.index', compact(['kelas', 'guru','mapel','kelas2']));
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
        $jadwal = new Jadwal();
        $jadwal->create($request->all());
        // dd($request->all());
        return back()->with('info','Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas2 = Kelas::all();
        $mapel = Mapel::all();
        $guru = Guru::all();
        $jadwal2 = Jadwal::all();
        $kelas = Kelas::findorfail($id);
        $jadwal = Jadwal::OrderBy('id', 'asc')->OrderBy('jam_mulai', 'asc')->where('kelas_id', $id)->get();

    
        return view('admin.jadwal.show', compact(['jadwal', 'kelas','kelas2','mapel','guru','jadwal2']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
         return view('admin.jadwal.edit');
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
       //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
