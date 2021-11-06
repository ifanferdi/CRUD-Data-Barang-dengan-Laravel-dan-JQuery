@extends('layouts/main')

@section('content')

<div class="row justify-content-between m-0 mb-3">

    <a href="" class="btn btn-primary col-md-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        Tambah Data
    </a>

    <div class="col-6">
        <form action="/barang/cari" class="m-0" id="formCari">
            <div class="input-group">
                @csrf
                <input type="text" class="form-control" placeholder="Cari barang" id="cari">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div id="data"></div>

@endsection

@include('barang.tambah_barang')
@include('barang.edit_barang')
@include('barang.hapus_barang')