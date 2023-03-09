@extends('layouts.default')
@section('title','Tambah user')
@section('header-title','Tambah user')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        <form action="{{route('users.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}">
                @error('nama')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}">
                @error('username')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Level</label>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="bendahara" name="level" value="bendahara" class="custom-control-input" {{ old('level') == 'bendahara' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="bendahara">Bendahara</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="user" name="level" value="user" class="custom-control-input" {{ old('level') == 'user' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="user">User</label>
                    </div>
                </div>
                @error('level')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">
                @error('password')
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

@push('after-script')
@include('sweetalert::alert')
@endpush
