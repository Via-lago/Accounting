@extends('layouts.default')
@section('title','Cashflow')
@section('header-title','Cashflow')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="card-body">
            <a href="{{ route('cashflow.print')}}" class="btn btn-sm btn-danger" method="POST"> Print</a>
        </div>
    </div>
</div>

@endsection
@push('after-script')
<script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endpush


