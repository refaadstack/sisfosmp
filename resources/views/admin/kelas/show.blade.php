@extends('layouts.master')
@section('title',"Kelas $kelas2->namakelas")
@section('content')
 <div class="container-fluid">
     <h3 class="text-gray-800" >DAFTAR SISWA KELAS {{ $kelas2->namakelas }}</h3>
     <div class="card-shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Table</h6>     
      </div>
      <div class="card-header py-6">
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th >Nama Siswa</th>
                      <th >NISN</th>
                      <th >Jenis Kelamin</th>
                  </tr>
              </thead>
              <tbody> 
                @foreach ($kelas2->siswa as $siswa)    
                  <tr>
                    <td style="width: 10%">{{ $loop->iteration }}</td>
                    <td class="text-capitalize" style="width: 40%">{{ $siswa->nama }}</td>
                    <td class="text-capitalize">{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->jeniskelamin }}</td>
                  </tr>
                  @endforeach
                  
              </tbody>
          </table>
      </div>
      </div>
        
     </div>
 </div>
@endsection