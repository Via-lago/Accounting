@extends('layouts.default')
@section('title','Profile user')
@section('header-title','Profil user')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ $user->nama }}</dd>

            <dt class="col-sm-3">Username</dt>
            <dd class="col-sm-9">{{ $user->username }}</dd>

            <dt class="col-sm-3">Level</dt>
            <dd class="col-sm-9">{{ $user->level }}</dd>
          </dl>
          <a href="{{route('edit-profile')}}" class="btn btn-success">
            Ubah
          </a>
    </div>
</div>
@endsection
@push('after-script')
    @include('sweetalert::alert')
@endpush

