@extends('layouts.default')
@section('title','Ubah user')
@section('header-title','Ubah user')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        <form action="{{route('users.update', $user->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Nama</label>
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

            <div class="form-group">
                <label for="">Level</label>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="bendahara" name="level" value="bendahara" class="custom-control-input" {{ (old('level') ?? $user->level) == 'bendahara' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="bendahara">Bendahara</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="user" name="level" value="user" class="custom-control-input" {{ (old('level') ?? $user->level) == 'user' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="user">User</label>
                    </div>
                </div>
                @error('level')
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

@push('after-script')
@include('sweetalert::alert')
@endpush
