<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        return view('admin.kelas.index' , compact(['kelas','guru']));
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
            'namakelas' => 'required|unique:kelas,namakelas',
            'walikelas' =>'required|unique:kelas,walikelas,except,id',]);

        $kelas = new Kelas();
        $kelas->create($request->all());
        // dd($request->all());
        return back()->withInfo('Kelas sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'namakelas' => 'required|unique:kelas,namakelas,'.$id,
            'walikelas' =>'required|unique:kelas,walikelas,'.$id,
            ]);

        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        // dd($request->all());
        return back()->withInfo('Kelas sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
