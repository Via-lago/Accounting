@extends('layouts.default')
@section('title','Profile Instansi')
@section('header-title','Profile user')

@section('content')
    <div class="card shadow mb-4 col-lg-6">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nama Instansi</dt>
                <dd class="col-sm-9">{{ $instansi->nama }}</dd>

                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">{{ $instansi->alamat }}</dd>
              </dl>
              <a href="{{route('instansi.edit', $instansi->id)}}" class="btn btn-success">
                Ubah
              </a>
        </div>
    </div>
@endsection
@push('after-script')
    @include('sweetalert::alert')
@endpush
