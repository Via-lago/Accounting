@extends('layouts.default')
@section('title','Ubah profile user')
@section('header-title',' Ubah profil user')


@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        <form action="{{route('update-profile')}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama') ?? $user->nama }}">
                @error('nama')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror

            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username') ?? $user->username}}">
                @error('username')
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
