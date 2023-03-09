@extends('layouts.default')
@section('title','Dashboard')
@section('header-title','Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        @forelse ($saldo as $s)
                        <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                            Saldo</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ "Rp " . number_format($s->total ?? 0,2,',','.') }}</div>
                        <p class="text-gray mt-2">
                            {{ $tanggal }}
                        </p>
                    </div>
                    @empty 
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
@push('after-script')
    <!-- Page level plugins -->
    <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
@endpush
