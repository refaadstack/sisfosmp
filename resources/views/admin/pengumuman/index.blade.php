@extends('layouts.master')
@section('title','PENGUMUMAN')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="margin-bottom: 500px">
                <div class="text-center" style="font-size: 25px" ><p class="font-weight-bold">Buat Pengumuman</p></div>
                <form action="{{ route('pengumuman.store') }}" method="POST">
                    @csrf
                    <div class="form-group">    
                        <label for="title">JUDUL PENGUMUMAN</label>
                        <input type="text" class="form-control"  placeholder="Masukkan title" name="judul" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="text">ISI PENGUMUMAN</label>
                        <textarea name="isi"  class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm float-right">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
    <script>
           CKEDITOR.replace('isi')
    </script>
@endsection