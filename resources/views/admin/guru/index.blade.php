@extends('layouts.master')
@section('title','Data Guru')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Data Guru SMP N 1 Muaro Jambi</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Table Guru</h6> 
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah">
              + Tambah Data
            </button>  
            <button type="button" class="btn btn-warning float-right mr-2" data-toggle="modal" data-target="#import">
              <i class="far fa-file"></i> Import Data
            </button>  
            <a href="/guru/cetak/excel" class="btn btn-success float-right mr-2" target="_blank" rel="noopener noreferrer">
            <i class="fas fa-download"></i> Export</a>
        </div>
        <div class="card-header py-6">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>No Handphone</th>
                            <th>Jurusan</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $guru)
                        <tr>
                            <td class="text-capitalize"><a href="{{ route('guru.show',$guru->id) }}">{{ $guru->nama }}</a></td>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->jeniskelamin }}</td>
                            <td class="text-capitalize">{{ $guru->tempatlahir }}</td>
                            <td>{{ $guru->tanggallahir }}</td>
                            <td>{{ $guru->agama }}</td>
                            <td>{{ $guru->no_hp }}</td>
                            <td>{{ $guru->jurusan }}</td>
                            <td>{{ $guru->jabatan }}</td>
                            <td>
                              <a href="#edit{{$guru->id}}" class="btn btn-warning btn-sm" data-toggle="modal">Edit</a>
                              <a href="#delete{{$guru->id}}" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                            </td>                      
                          </tr>
                          {{-- modalEdit --}}
                          <div class="modal" id="edit{{$guru->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Edit Data Guru</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                          
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ route('guru.update',$guru->id) }}" method="POST"class="needs-validation" novalidate role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                          <label for="nama">Nama</label>
                                          <input type="text" class="form-control"  placeholder="Masukkan Nama" name="nama" value="{{ $guru->nama }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Nama tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="nip">NIP</label>
                                          <input type="text" class="form-control" placeholder="Masukkan NIP" name="nip" value="{{ $guru->nip }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">NIP tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="mapel_id">Pilih Mata Pelajaran</label>
                                          <select class="form-control" name="mapel_id" required>
                                              <option value="" selected disabled hidden>Pilih Mata Pelajaran</option>
                                              @foreach ($mapels as $mapel)
                                              <option value="{{ $mapel->id }}" @if($guru->mapel_id== $mapel->id) selected @endif>{{ $mapel->nama }}</option>    
                                              @endforeach
                                          </select> 
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                      </div>
                                        <div class="form-group">
                                            <label for="jeniskelamin">Jenis Kelamin</label>
                                            <select class="form-control" name="jeniskelamin" required>
                                                <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" @if($guru->jeniskelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                                                <option value="Perempuan" @if($guru->jeniskelamin == 'Perempuan') selected @endif>Perempuan</option>
                                            </select> 
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Jenis kelamin tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempatlahir">Tempat lahir</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan Tempat Lahir" name="tempatlahir" value="{{ $guru->tempatlahir }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Tempat lahir tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggallahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control"  placeholder="pilih tanggal lahir" name="tanggallahir" value="{{ $guru->tanggallahir }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Tanggal lahir tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="agama">Pilih Agama</label>
                                          <select class="form-control" name="agama" required>
                                              <option value="" selected disabled hidden>Pilih Agama</option>
                                              <option value="Islam" @if($guru->agama == 'Islam') selected @endif>Islam</option>
                                              <option value="Kristen Protestan" @if($guru->agama == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                                              <option value="Katolik" @if($guru->agama == 'Katolik') selected @endif>Katolik</option>
                                              <option value="Hindu" @if($guru->agama == 'Hindu') selected @endif>Hindu</option>
                                              <option value="Buddha"  @if($guru->agama == 'Buddha') selected @endif>Buddha</option>
                                              <option value="Khonghucu" @if($guru->agama == 'Khonghucu') selected @endif>Khonghucu</option>
                                          </select> 
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Agama tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="no_hp">Nomor Hp</label>
                                          <input type="number" class="form-control"  placeholder="Masukkan No HP" name="no_hp" value="{{ $guru->no_hp }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">nomor handphone tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="jabatan">Jabatan</label>
                                          <input type="text" class="form-control"  placeholder="Masukkan Jabatan" name="jabatan" value="{{ $guru->jabatan }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Jabatan tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="jurusan">Jurusan</label>
                                          <input type="text" class="form-control"  placeholder="Masukkan Jurusan" name="jurusan" value="{{ $guru->jurusan }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Jurusan tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-Mail</label>
                                            <input type="email" class="form-control"  placeholder="e-mail belum ada" name="email" value="{{ $guru->email }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">e-mail tidak boleh kosong! Format e-mail salah!</div>
                                        </div>  
                                        <div class="form-group">
                                          <label for="avatar">Masukkan foto guru</label>
                                        <input type="file" name="avatar" class="form-control">  
                                        </div>            
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </form>
                                </div>
                          
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                          
                              </div>
                            </div>
                        </div>

                        {{-- start modal delete --}}
                        <div class="modal fade" id="delete{{$guru->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Apakah Anda yakin menghapus data <b>"{{ $guru->nama }}"?</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">

                                    <form action="{{ route('guru.destroy',$guru->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <div class="form-group">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Konfirmasi Hapus</button>
                                    </form>
                                   </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- end modal hapus --}}
                          @endforeach
                    </tbody>
                    <!-- ModalTambah -->
                      <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data guru</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="modal-body">
                                <form action="{{ route('guru.store') }}" method="POST" class="needs-validation" novalidate>
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="nama">Nama</label>
                                      <input type="text" class="form-control"  placeholder="Masukkan Nama" name="nama" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Nama tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                      <label for="nip">NIP</label>
                                      <input type="number" class="form-control" placeholder="Masukkan NIP" name="nip">
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">NIP tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                      <label for="mapel_id">Pilih Mata Pelajaran</label>
                                      <select class="form-control" name="mapel_id" required>
                                          <option value="" selected disabled hidden>Pilih Mata Pelajaran</option>
                                          @foreach ($mapels as $mapel)
                                          <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>    
                                          @endforeach
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                  </div>
                                    <div class="form-group">
                                        <label for="jeniskelamin">Jenis Kelamin</label>
                                        <select class="form-control" name="jeniskelamin" required>
                                            <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select> 
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Jenis kelamin tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempatlahir">Tempat lahir</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan Tempat Lahir" name="tempatlahir" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Tempat lahir tidak boleh kosong!</div>
                                      </div>
                                    <div class="form-group">
                                        <label for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control"  placeholder="pilih tanggal lahir" name="tanggallahir" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Tanggal lahir tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                      <label for="agama">Pilih Agama</label>
                                      <select class="form-control" name="agama" required>
                                          <option value="" selected disabled hidden>Pilih Agama</option>
                                          <option value="Islam">Islam</option>
                                          <option value="Kristen Protestan">Kristen Protestan</option>
                                          <option value="Katolik">Katolik</option>
                                          <option value="Hindu">Hindu</option>
                                          <option value="Buddha">Buddha</option>
                                          <option value="Khonghucu">Khonghucu</option>
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Agama tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="email" class="form-control"  placeholder="Masukkan Email" name="email" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">e-mail tidak boleh kosong! Format e-mail salah!</div>
                                    </div>
                                    <div class="form-group">
                                      <label for="no_hp">No Handphone</label>
                                      <input type="number" class="form-control"  placeholder="Masukkan nomor handphone" name="no_hp" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">no hp tidak boleh kosong! Format e-mail salah!</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control"  placeholder="Masukkan Jabatan" name="jabatan" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">jabatan tidak boleh kosong!</div>
                                  </div>
                                  <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" class="form-control"  placeholder="Masukkan Jurusan" name="jurusan" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">jurusan tidak boleh kosong!</div>
                                  </div>  
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </form>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- end modal tambah --}}
                      {{-- modal import --}}
                      <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Import Data Guru</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="modal-body">
                                <form action="{{ route('guru.import') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="nama">Masukkan File excel</label>
                                      <input type="file" class="form-control"  placeholder="Masukkan File excel" name="file" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Nama tidak boleh kosong!</div>
                                    </div>        
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </table>
            </div>
        </div>
    </div>
</div>
  <script>
    
    // Disable form submissions if there are invalid fields
    // (function() {
    //   'use strict';
    //   window.addEventListener('load', function() {
    //     // Get the forms we want to add validation styles to
    //     var forms = document.getElementsByClassName('needs-validation');
    //     // Loop over them and prevent submission
    //     var validation = Array.prototype.filter.call(forms, function(form) {
    //       form.addEventListener('submit', function(event) {
    //         if (form.checkValidity() === false) {
    //           event.preventDefault();
    //           event.stopPropagation();
    //         }
    //         form.classList.add('was-validated');
    //       }, false);
    //     });
    //   }, false);
    // })();
       
    </script>
    
    

@endsection