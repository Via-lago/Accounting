@extends('layouts.default')
@section('title','Reset password user')
@section('header-title','Reset password user')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        <form action="{{route('users.update-password', $user->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kata-sandi-baru">Kata sandi baru</label>
                <input type="password" name="kata_sandi_baru" class="form-control @error('kata_sandi_baru') is-invalid @enderror" value="{{old('kata_sandi_baru')}}">
                @error('kata_sandi_baru')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Reset</button>
        </form>

    </div>
</div>
@endsection

@push('after-script')
@include('sweetalert::alert')
@endpush
