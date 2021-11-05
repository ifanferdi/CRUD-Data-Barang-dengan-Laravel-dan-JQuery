@extends('layouts/main')

@section('content')

<a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
    Tambah Data
</a>

<div id="data"></div>

@endsection

@include('barang.tambah_barang')
@include('barang.edit_barang')
@include('barang.hapus_barang')