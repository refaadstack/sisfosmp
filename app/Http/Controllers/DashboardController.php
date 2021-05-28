<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kelas;
use App\Mapel;
use App\Pengumuman;
use App\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // auth
    }

    public function index(){
        $siswa= Siswa::count();
        $kelas = Kelas::count();
        $guru =Guru::count();
        $mapel= Mapel::count();
        // dd($mapel);
        $pengumuman = Pengumuman::latest()->first();
        return view('dashboard.index',compact(['siswa','guru','kelas','pengumuman','mapel']));
    }
}
