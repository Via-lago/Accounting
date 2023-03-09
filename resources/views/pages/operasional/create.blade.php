@extends('layouts.default')
@section('title','Tambah Transaksi Operasional')
@section('header-title','Tambah Transaksi Operasional')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('operasional.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Tanggal Transaksi Operasional</label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal')}}">
                @error('tanggal')
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
            {{-- <div class="form-group">
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
            </div> --}}
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="ket" class="form-control @error('ket') is-invalid @enderror" value="{{old('ket')}}">
                @error('ket')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Jenis</label>
                    <select class="form-control" id="jenis" name="jenis">
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                @error('jenis')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{old('jumlah')}}">
                @error('jumlah')
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
