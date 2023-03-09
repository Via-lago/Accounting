@extends('layouts.default')
@section('title','Edit password')
@section('title-page','Edit Password')

@section('content')
    <div class="card shadow mb-4 col-lg-6">
        <div class="card-body">
            <form action="{{route('update-password')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="sandiLama">Sandi lama</label>
                    <input type="password" name="sandi_lama" id="sandiLama" class="form-control @error('sandi_lama') is-invalid @enderror" value="{{old('sandi_lama')}}">
                    @error('sandi_lama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sandiBaru">Sandi baru</label>
                    <input type="password" name="sandi_baru" id="sandiBaru" class="form-control @error('sandi_baru') is-invalid @enderror">
                    @error('sandi_baru')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="konfirmasiSandiBaru">Konfirmasi sandi baru</label>
                    <input type="password" name="sandi_baru_confirmation" id="konfirmasiSandiBaru" class="form-control @error('sandi_baru_confirmation') is-invalid @enderror">
                </div>
                <button type="submit" class="btn btn-success">
                    UBAH SANDI
                </button>
            </form>
        </div>
    </div>
@endsection

@push('after-script')
@include('sweetalert::alert')
@endpush
