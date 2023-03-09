@extends('layouts.default')
@section('title','Laporan')
@section('header-title','Laporan')


@section('content')
<div class="card shadow mb-4 col-lg-9">
    <div class="card-body">
        <form action="{{route('transaksi.download')}}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="">Tanggal Awal</label>
                    <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal" value="{{old('tanggal_awal')}}">
                    @error('tanggal_awal')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="">Tanggal Akhir</label>
                    <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" value="{{old('tanggal_akhir')}}">
                    @error('tanggal_akhir')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success"><i class="fa fa-download" aria-hidden="true"></i>
                Download</button>
        </form>

    </div>
</div>
@endsection
