@extends('layouts.default')
@section('title','Data Index')
@section('header-title','Data Index')

@section('content')
{{-- <div class="card shadow mb-4">
    <div class="card-body">
        <a href="{{route('index.create')}}" class="btn btn-success mb-4">
           <b>Tambah</b>
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
</div> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Data Index</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session()->has('info'))
                    <div class="alert alert-info">
                        {{ session()->get('info') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nomor Index</th>
                            <th>Nama Index</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($index as $i)
                        <tr>
                            <td>{{ $i->nomor_index}}</td>
                            <td>{{ $i->nama_index }}</td>
                            
                        </tr>
                    @empty 
                    @endforelse
                </tbody>
                    
                </table>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
        <!-- Custom styles for this page -->
        <link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@push('after-script')
    <!-- Page level plugins -->
    <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
@endpush
