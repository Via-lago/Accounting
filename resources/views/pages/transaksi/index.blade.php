@extends('layouts.default')
@section('title','Data Transaksi')
@section('header-title','Data Transaksi')

@section('content')
    <div class="card shadow mb-4">
       
        <div class="card-body">
                    <a href="{{route('transaksi.create')}}" class="btn btn-success mb-4">
                       <b>Tambah</b>
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
        </div>
        <div class="card-body">
            <form action="{{route('transaksi.cari')}}" method="GET">
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
            <h6 class="m-0 font-weight-bold text-black">Data Transaksi</h6>
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
                            <th>Keterangan</th>
                            <th>Pemasukan (Rp)</th>
                            <th>Pengeluaran (Rp)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_pemasukan = 0;
                        $total_pengeluaran = 0;
                        @endphp
                        @forelse ($transaksi as $t)
                        <tr>
                            <td>{{ $t->tanggal_transaksi }}</td>
                            <td>{{ $t->keterangan }}</td>
                            <td>
                            @if ($t->jenis == 'pemasukan')
                                {{ "Rp " . number_format($t->jumlah,2,',','.') }}
                                @php
                                    $total_pemasukan += $t->jumlah;
                                @endphp
                            @else
                                Rp.0
                            @endif 
                            </td> 
                            <td>
                                @if ($t->jenis == 'pengeluaran')
                                    {{ "Rp " . number_format($t->jumlah,2,',','.') }}
                                    @php
                                        $total_pengeluaran += $t->jumlah;
                                    @endphp
                                @else
                                    Rp.0
                                @endif 
                                </td>        
                            <td>
                                <a class="btn btn-info btn-sm d-inline mr-1 mb-1" href="{{route('transaksi.edit', $t->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Ubah
                                </a>
                                <form action="{{route('transaksi.destroy', $t->id)}}" method="post" class="d-inline" id="{{'form-hapus-transaksi-'.$t->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm btn-hapus" data-id="{{$t->id}}" type="submit">
                                        <i class="fas fa-trash">
                                        </i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty 
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center"><b>Total</b></th>
                        <th colspan="1"><b>{{ "Rp " . number_format($total_pemasukan,2,',','.') }}</b></th>
                        <th colspan="1"><b>{{ "Rp " . number_format($total_pengeluaran,2,',','.') }}</b></th>
                    </tr>
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
@endpush
