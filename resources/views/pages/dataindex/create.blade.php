@extends('layouts.default')
@section('title','Tambah Index')
@section('header-title','Tambah Index')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('index.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="nomor_index">Nomor Index</label>
                <input type="text" name="nomor_index" class="form-control @error('nomor_index') is-invalid @enderror" value="{{old('nomor_index')}}">
                @error('nomor_index')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_index">Nama Index</label>
                <input type="text" name="nama_index" class="form-control @error('nama_index') is-invalid @enderror" value="{{old('nama_index')}}">
                @error('nama_index')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>

    </div>
</div>
@endsection
