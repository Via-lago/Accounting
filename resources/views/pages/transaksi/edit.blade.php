@extends('layouts.default')
@section('title','Edit transaksi')
@section('header-title','Edit transaksi')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('transaksi.update', $transaksi->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Tanggal Transaksi</label>
                <input type="invisible" name="tanggal_transaksi" class="form-control @error('tanggal_transaksi') is-invalid @enderror" value="{{$transaksi->tanggal_transaksi}}" readonly>
                @error('tanggal_transaksi')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nama COA</label>
                    <select class="form-control" id="id_coa" name="id_coa">
                        @foreach ($coa as $c )
                        <option value="{{ $c->id }}" readonly>{{ $c->nama_coa }}</option>
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
                <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{$transaksi->keterangan}}">
                @error('keterangan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jenis</label>
                    <select type="invisible" class="form-control" id="jenis" name="jenis" value="{{$transaksi->jenis}}" readonly>
                        <option type="invisible" value="{{$transaksi->jenis}}" readonly>Pemasukan</option>
                        <option type="invisible" value="{{$transaksi->jenis}}" readonly>Pengeluaran</option>
                    </select>
                @error('jenis')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="invisible" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{$transaksi->jumlah}}" readonly>
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
