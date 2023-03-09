@extends('layouts.default')
@section('title','Tambah COA')
@section('header-title','Tambah COA')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('coa.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="nomor_coa">Nomor COA</label>
                <input type="text" name="nomor_coa" class="form-control @error('nomor_coa') is-invalid @enderror" value="{{old('nomor_coa')}}">
                @error('nomor_coa')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama_coa">Nama COA</label>
                <input type="text" name="nama_coa" class="form-control @error('nama_coa') is-invalid @enderror" value="{{old('nama_coa')}}">
                @error('nama_coa')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nama Index</label>
                    <select class="form-control" id="id_index" name="id_index">
                        @foreach ($index as $i )
                        <option value="{{ $i->id }}">{{ $i->nama_index }}</option>
                        @endforeach 
                    </select>
                @error('id_index')
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
