@extends('layouts.default')
@section('title','Data Transaksi Hutang')
@section('header-title','Data Transaksi Hutang')

@section('content')
    <div class="card shadow mb-4">
       
        <div class="card-body">
                    <a href="{{route('hutang.create')}}" class="btn btn-success mb-4">
                       <b>Tambah</b>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
        </div>
        <div class="card-body">
            <form action="{{route('hutang.cari')}}" method="GET">
                <input type="hidden" name="keterangan" value="transaksi">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="">Tanggal Awal</label>
                        <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal" value="{{old('tanggal_awal')}}">
                        @error('tanggal_awal')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" value="{{old('tanggal_akhir')}}">
                        @error('tanggal_akhir')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success"><b>Cari</b></button>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Data Transaksi Hutang</h6>
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
                            <th>Tanggal Transaksi</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Keterangan</th>
                            <th>Jumlah (Rp)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hutang as $h)
                        <tr>
                            <td>{{ $h->tanggaltransaksi_hutang }}</td>
                            <td>{{ $h->jatuhtempo_hutang }}</td>
                            <td>{{ $h->keterangan }}</td>
                            <td>{{ $h->jumlah }}</td> 
                            <td>{{ $h->status }}</td>
                            <td>
                                <a class="btn btn-info btn-sm d-inline mr-1 mb-1" href="{{route('hutang.edit', $h->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Ubah
                                </a>
                                <form action="{{route('hutang.destroy', $h->id)}}" method="post" class="d-inline" id="{{'form-hapus-transaksi-'.$h->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm btn-hapus" data-id="{{$h->id}}" type="submit">
                                        <i class="fas fa-trash">
                                        </i>
                                        Hapus
                                    </button>
                                </form>
                                <form action="{{route('hutang.pembayaran', $h->id)}}" method="post" class="d-inline" id="{{'form-hapus-transaksi-'.$h->id}}">
                                    {{-- @method('DELETE') --}}
                                    @csrf
                                    <button class="btn  btn-sm btn-success" data-id="{{$h->id}}" type="submit">
                                        
                                        Done
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty 
                    @endforelse
                </tbody>
                <tfoot>
                    @forelse ($sal as $s)
                    <tr>
                        <th colspan="2" class="text-center"><b>Saldo</b></th>
                        <th colspan="2" ><b>{{ "Rp " .number_format($s->total,2,',','.') }}</b></th>
                    </tr>
                    @empty 
                    @endforelse
                </tfoot>
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
