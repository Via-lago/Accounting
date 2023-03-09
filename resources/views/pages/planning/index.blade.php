@extends('layouts.default')
@section('title','Data Cashflow Planning')
@section('header-title','Data Cashflow Planning')

@section('content')
    <div class="card-header py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="fa fa-info-circle" aria-hidden="true"> Jika Saldo Akhir Bulan sama atau kurang dari Saldo yang dibutuhkan, maka harus menambahkan pemasukkan anda!</i>
            </ol>
          </nav>
    </div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black"><center>CV. Okta Viva Jaya</center></h6>
            <h6 class="m-0 font-weight-bold text-black">
                <center>Laporan Cashflow Planning <br>
                </center></h6>
        </div>
        <form action="{{ route('planning.cari') }}" method="POST" class="form-group">
            {{ csrf_field() }}
            <select style="cursor:pointer;margin-top:1.5em;margin-bottom:1.5em;" 
            class="form-control" id="tag_select" name="cbperiode">
            <option value="0" selected disabled> Pilih Bulan</option>
            <option value="01"> Januari</option>
            <option value="02"> Februari</option>
            <option value="03"> Maret</option>
            <option value="04"> April</option>
            <option value="05"> Mei</option>
            <option value="06"> Juni</option>
            <option value="07"> Juli</option>
            <option value="08"> Agustus</option>
            <option value="09"> September</option>
            <option value="10"> Oktober</option>
            <option value="11"> November</option>
            <option value="12"> Desember</option>
            </select>

            <select  class="form-control" id="tag_select" name="cbtahun">
            <option value="0" selected disabled> Pilih Tahun</option>
            <?php 
                $year = date('Y');
                $min = $year - 60;
                $max = $year;
                for( $i=$max; $i>=$min; $i-- ) {
                    echo '<option value='.$i.'>'.$i.'</option>';
                }
            ?>
            </select>
            <br>
            <input class="btn btn-success" name="submit" type="submit" value="Cari Data"/>
        </form>
    </div>
</div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black"><center>CV. Okta Viva Jaya</center></h6>
            <h6 class="m-0 font-weight-bold text-black">
                <center>Laporan Cashflow Planning <br>
                </center></h6>
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
                        <caption><b>Pemasukan</b></caption>
                        <table class="table table-striped table-bordered" id="dataTable">
                            @forelse ($target as $t)
                            <tr>
                                <td>{{ $t->keterangan }}</td>
                                <td>{{ "Rp " . number_format ($t->jumlah,2,',','.') }}</td>
                            </tr>
                            @empty
                            @endforelse
                        </table>
                        <caption><b>Pengeluaran</b></caption>
                        <table class="table table-striped table-bordered" id="dataTable">
                            @forelse ($hutang as $h)
                            <tr>
                                <td>{{ $h->nama_coa }}</td>
                                <td>{{ "Rp " . number_format ($h->jumlah,2,',','.') }}</td>
                            </tr>
                            @empty
                            @endforelse

                            @forelse ($operasional as $o)
                            <tr>
                                <td>{{ $o->nama_coa }}</td>
                                <td>{{ "Rp " . number_format ($o->jumlah,2,',','.') }}</td>
                            </tr>
                            @empty
                            @endforelse

                            {{-- @forelse ($transaksi as $t)
                            <tr>
                                <td>{{ $t->nama_coa }}</td>
                                <td>{{ "Rp " . number_format ($->jumlah,2,',','.') }}</td>
                            </tr>
                            @empty
                            @endforelse --}}
                            <tr>
                                <th colspan="1" class="text-left"><b>Total pengeluaran</b></th>
                                <th colspan="2"><b>{{ "Rp " . number_format($totalpengeluaran,2,',','.') }}</b></th>
                            </tr>
                        </table>
                    </thead>
                    <tfoot>
                        <table class="table table-striped table-bordered" id="dataTable">
                        <tr>
                            <th colspan="1" class="text-left"><b>Selisih pemasukan dan pengeluaran</b></th>
                            <th colspan="2"><b>{{ "Rp " . number_format($selisih,2,',','.') }}</b></th>
                        </tr>
                        @forelse ($sal as $s)
                        <tr>
                            <th colspan="1" class="text-left"><b>Saldo Awal Bulan </b></th>
                            <th colspan="2"><b>{{ "Rp " . number_format($s->total,2,',','.') }}</b></th>
                        </tr>
                        @empty 
                        @endforelse
                        <tr>
                            <th colspan="1" class="text-left"><b>Saldo Sekarang </b></th>
                            <th colspan="2"><b>{{ "Rp " . number_format($saldo_sekarang,2,',','.') }}</b></th>
                        </tr>
                        @forelse ($butuh as $b)
                        <tr>
                            <th colspan="1" class="text-left"><b>Saldo Yang dibutuhkan </b></th>
                            <th colspan="2"><b>{{ "Rp " . number_format($b->Jumlah,2,',','.') }}</b></th>
                        </tr>
                        @empty 
                        @endforelse
                        <tr>
                            <th colspan="1" class="text-left"><b>Saldo Akhir Bulan</b></th>
                            <th colspan="2"><b>{{ "Rp " . number_format($saldo_akhir,2,',','.') }}</b></th>
                        </tr>
                    </tfoot>
                        </tr> 
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
