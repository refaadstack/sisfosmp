@extends('layouts.master')
@section('title','Profil')
@section('content')
    <div class="content ml-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid rounded" style="width: 200px; border-radius: 50%" src="{{$siswa->getAvatar()}}" alt="User profile picture">
                            </div>
                
                        <h5 class="profile-username text-center text-capitalize">{{ $siswa->nama }}</h5>
                
                        <p class="text-muted text-center">{{ $siswa->email}}</p>
                
                        <ul class="list-group list-group-unbordered mb-6">
                            <li class="list-group-item">
                            <b>Tempat Lahir</b> <span class="float-right text-capitalize">{{ $siswa->tempatlahir }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Tanggal Lahir</b> <span class="float-right text-capitalize">{{ $siswa->tanggallahir}}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Agama</b> <span class="float-right text-capitalize">{{ $siswa->agama }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Jenis Kelamin</b> <span class="float-right text-capitalize">{{ $siswa->jeniskelamin }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Kelas</b> <span class="float-right text-capitalize">{{ $siswa->kelas->namakelas}}</span>
                            </li>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                
            </div>
        </div>   
    </div>     
    
    
@endsection