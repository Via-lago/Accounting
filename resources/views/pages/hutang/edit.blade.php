@extends('layouts.default')
@section('title','Edit transaksi Hutang')
@section('header-title','Edit transaksi Hutangg')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('hutang.update', $hutang->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Tanggal Transaksi</label>
                <input type="invisible" name="tanggaltransaksi_hutang" class="form-control @error('tanggaltransaksi_hutang') is-invalid @enderror" value="{{$hutang->tanggaltransaksi_hutang}}" readonly>
                @error('tanggaltransaksi_hutang')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Tanggal Jatuh Tempo</label>
                <input type="invisible" name="jatuhtempo_hutang" class="form-control @error('jatuhtempo_hutang') is-invalid @enderror" value="{{$hutang->jatuhtempo_hutang}}" readonly>
                @error('jatuhtempo_hutang')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nama COA</label>
                    <select class="form-control" id="id_coa" name="id_coa">
                        @foreach ($coa as $c )
                        <option value="{{ $c->id }}">{{ $c->nama_coa }}</option>
                        @endforeach 
                    </select>
                @error('id_coa')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{$hutang->keterangan}}">
                @error('keterangan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="invisible" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{$hutang->jumlah}}" readonly>
                @error('jumlah')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>

    </div>
</div>
@endsection
