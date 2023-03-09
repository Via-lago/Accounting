@extends('layouts.default')
@section('title','Edit transaksi operasional')
@section('header-title','Edit transaksi operasional')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('operasional.update', $operasional->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Tanggal Transaksi Operasional</label>
                <input type="invisible" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{$operasional->tanggal}}" readonly>
                @error('tanggal')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Nama COA</label>
                    <select type ="invisible" class="form-control" id="id_coa" name="id_coa">
                        @foreach ($coa as $c )
                        <option type ="invisible" value="{{ $c->id }}" readonly>{{ $c->nama_coa }}</option>
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
                <input type="text" name="ket" class="form-control @error('ket') is-invalid @enderror" value="{{$operasional->ket}}">
                @error('ket')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jenis</label>
                    <select type="invisible" class="form-control" id="jenis" name="jenis" value="{{$operasional->jenis}}" readonly>
                        <option type="invisible" value="{{$operasional->jenis}}" readonly>Pemasukan</option>
                        <option type="invisible" value="{{$operasional->jenis}}" readonly>Pengeluaran</option>
                    </select>
                @error('jenis')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="invisible" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{$operasional->jumlah}}" readonly>
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
