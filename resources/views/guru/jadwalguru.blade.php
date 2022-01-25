@extends('layouts.master')

@section('content')
{{-- <div class="container">

    
    <table class="table table-bordered" style="margin-bottom: 300px">
        <tr>
            <td>hari</td>
            <td>kelas</td>
            <td>jam</td>
        </tr>
        @foreach ($jadwal as $jadwal)
        <tr>
            <td>{{ $jadwal->hari }}</td>
            <td>{{ $jadwal->namakelas}}</td>
            <td>{{ $jadwal->jam_mulai }}</th>
            </tr>
        @endforeach
    </table>
</div> --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Data Jadwal SMP N 1 Muaro Jambi</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-dark">JADWAL</h5> 
        </div>
        <div class="card-header py-6">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th >Mata Pelajaran</th>
                        <th >Hari</th>
                        <th>Jam Pelajaran</th>
                        
                        
                    </tr>
                </thead>
                <tbody> 
                  @foreach ($jadwal as $data)    
                    <tr>
                      <td style="width: 10%">{{ $loop->iteration }}</td>
                      <td>
                           <h6 class="card-title">{{ $data->namakelas }}</h6>
                           <p class="card-text"><small class="text-muted">{{ $data->mapel }}</small></p>
                       </td>
                      <td class="text-capitalize">{{ $data->hari}}</td>
                      <td>{{ $data->jam_mulai }} WIB - {{ $data->jam_selesai }} WIB</td>
                      
                    </tr>
                    
                  @endforeach
                    
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
    @endsection