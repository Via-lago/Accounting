@extends('layouts.default')
@section('title','Cashflow')
@section('header-title','Cashflow')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black"><center>CV. Okta Viva Jaya</center></h6>
            <h6 class="m-0 font-weight-bold text-black">
                {{-- <center>Laporan Cashflow Periode {{ $angka_periode }}<br>
                    ({{ $nama_periode }}) 
                </center></h6> --}}
        </div>
        <form action="{{ route('cashflow.cari') }}" method="POST" class="form-group">
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
            <h6 class="m-0 font-weight-bold text-black"><center>Laporan Cashflow Per Bulan </center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session()->has('info'))
                    <div class="alert alert-info">
                        {{ session()->get('info') }}
                    </div>
                @endif
                    <thead>
                        <caption><b>Arus Kas Dari Kegiatan Operasional </b></caption>
                        <table class="table table-striped table-bordered" id="dataTable">
                            <tr>
                                <th colspan="4">Keterangan</th>
                                <th colspan="4">Pemasukan (Rp)</th>
                                <th colspan="4">Pengeluaran (Rp)</th>
                            </tr>
                            @php
                                $grandtotal=0;
                            @endphp
                        @foreach ($coa as $c)
                            @php
                            $total =0;
                            $jenis ='a';
                            @endphp
                            @foreach($transaksi as $t)
                                @if($c->id == $t->id_coa)
                                @php
                                    $total = $total + $t->jumlah;
                                    $jenis = $t->jenis;
                                    
                                @endphp
                                
                                @endif   
                            @endforeach

                            @foreach($operasional as $o)
                            @if($c->id == $o->id_coa)
                            @php
                                $total = $total + $o->jumlah;
                                $jenis = $o->jenis;
                                
                            @endphp
                            @endif   
                            @endforeach
                            
                            @foreach($hutang as $h)
                            @if ($h->status == "Sudah Bayar")
                            @if($c->id == $h->id_coa)
                            @php
                                $total = $total + $h->jumlah;
                                $jenis = $h->jenis;
                            @endphp
                            @endif    
                            @endif
                            @endforeach 
                            
                            <tr>
                                @if ($c->index == 1)
                                <th colspan="4" class="text-left">{{ $c->nama_coa }}</th>
                                <th colspan="4" class="text-left">
                                    @if ($jenis == 'pemasukan')
                                    @php
                                        $grandtotal=$grandtotal + $total;
                                    @endphp
                                    {{ "Rp " . number_format($total,2,',','.') }}
                                    @else
                                        Rp.0
                                    @endif 
                                </th>
                                <th colspan="4" class="text-left">
                                    @if ($jenis == 'pengeluaran')
                                    @php
                                    $grandtotal=$grandtotal - $total;
                                    @endphp
                                    {{ "Rp " . number_format($total,2,',','.') }}
                                    @else
                                        Rp.0
                                    @endif
                                </th>
                                @endif 
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="1" class="text-left"><b>Total kas kegiatan Operasional</b></th>
                            <th colspan="8" class="text-center">
                                {{ "Rp " . number_format($grandtotal,2,',','.') }}
                            </th>
                            </tr> 
                        </table>
                        <caption><b>Arus Kas Dari Kegiatan Investasi </b></caption>
                        <table class="table table-striped table-bordered" id="dataTable">
                            <tr>
                                <th colspan="4">Keterangan</th>
                                <th colspan="4">Pemasukan (Rp)</th>
                                <th colspan="4">Pengeluaran (Rp)</th>
                            </tr>
                            @php
                                $grandtotal=0;
                                $kastotal =0;
                            @endphp
                            @foreach ($coa as $c)
                            @php
                            $total =0;
                            $jenis ='a';
                            @endphp
                            @foreach($transaksi as $t)
                                @if($c->id == $t->id_coa)
                                @php
                                    $total = $total + $t->jumlah;
                                    $jenis = $t->jenis;
                                @endphp
                                @endif   
                            @endforeach
                            @foreach($operasional as $o)
                            @if($c->id == $o->id_coa)
                            @php
                                $total = $total + $o->jumlah;
                                $jenis = $o->jenis;
                                
                            @endphp
                            @endif   
                            @endforeach 

                            @foreach($hutang as $h)
                            @if($c->id == $h->id_coa)
                            @php
                                $total = $total + $h->jumlah;
                                $jenis = $h->jenis;
                                
                            @endphp
                            @endif   
                            @endforeach 
                            <tr>
                                @if ($c->index == 2)
                                <th colspan="4" class="text-left">
                                        {{ $c->nama_coa }}
                                     
                                </th>
                                <th colspan="4" class="text-left">
                                    @php
                                        $grandtotal=$grandtotal + $total;
                                    @endphp
                                    @if ($jenis == 'pemasukan')
                                    {{ "Rp " . number_format($total,2,',','.') }}
                                    @else
                                        Rp.0
                                    @endif 
                                </th>
                                <th colspan="4" class="text-left">
                                    @php
                                        $grandtotal=$grandtotal - $total;
                                    @endphp
                                    @if ($jenis == 'pengeluaran')
                                    {{ "Rp " . number_format($total,2,',','.') }}
                                    @else
                                        Rp.0
                                    @endif
                                </th>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="1" class="text-left"><b>Total kas kegiatan Inventasi</b></th>
                            <th colspan="8" class="text-center">
                                {{ "Rp " . number_format($grandtotal,2,',','.') }}
                            </th>
                            </tr>  
                        </table>

                        <caption><b>Arus Kas Dari Kegiatan Pendanaan </b></caption>
                        <table class="table table-striped table-bordered" id="dataTable">
                            <tr>
                                <th colspan="4">Keterangan</th>
                                <th colspan="4">Pemasukan (Rp)</th>
                                <th colspan="4">Pengeluaran (Rp)</th>
                            </tr>
                            @php
                            $grandtotal=0;
                            @endphp
                            @foreach ($coa as $c)
                            @php
                            $total =0;
                            $jenis ='a';
                            @endphp 
                            @foreach($transaksi as $t)
                                @if($c->id == $t->id_coa)
                                @php
                                    $total = $total + $t->jumlah;
                                    $jenis = $t->jenis;
                                    
                                @endphp
                                @endif   
                            @endforeach  
                            @foreach($operasional as $o)
                            @if($c->id == $o->id_coa)
                            @php
                                $total = $total + $o->jumlah;
                                $jenis = $o->jenis;
                                
                            @endphp
                            @endif   
                            @endforeach
                            
                            @foreach($hutang as $h)
                            @if($c->id == $h->id_coa)
                            @php
                                $total = $total + $h->jumlah;
                                $jenis = $h->jenis;
                                
                            @endphp
                            @endif   
                            @endforeach 
                            <tr>
                                @if ($c->index == 3)
                                <th colspan="4" class="text-left">{{ $c->nama_coa }}</th>
                                <th colspan="4" class="text-left">
                                    @if ($jenis == 'pemasukan')
                                    @php
                                        $grandtotal=$grandtotal + $total;
                                    @endphp
                                    {{ "Rp " . number_format($total,2,',','.') }}
                                    @else
                                        Rp.0
                                    @endif 
                                </th>
                                <th colspan="4" class="text-left">
                                    @if ($jenis == 'pengeluaran')
                                    @php
                                        $grandtotal=$grandtotal - $total;
                                    @endphp
                                    {{ "Rp " . number_format($total,2,',','.') }}
                                    @else
                                        Rp.0
                                    @endif
                                </th>
                                @endif 
                            </tr>
                        @endforeach
                        <tr>
                        <th colspan="1" class="text-left"><b>Total kas kegiatan Pendanaan</b></th>
                        <th colspan="8" class="text-center">
                            {{ "Rp " . number_format($grandtotal,2,',','.') }}
                        </th>
                        </tr>
                        </table>
                        <caption><b>Kenaikan atau Penurunan Kas Akhir Periode </b></caption>
                        <table class="table table-striped table-bordered" id="dataTable">
                            @forelse ($sal as $s)
                        <tr>
                            <th colspan="4" class="text-left">Kenaikan atau Penurunan Kas</th>
                            <th colspan="8" class="text-center">
                                {{"Rp " . number_format($s->total,2,',','.') }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-left">Saldo Kas Akhir</th>
                            <th colspan="8" class="text-center">
                                {{ "Rp " .number_format($s->total,2,',','.') }}
                            </th>
                        </tr>
                        @empty 
                        @endforelse
                        </table>
                    </thead>
                    <tfoot>
                    </tfoot>
            </div>
        </div>
    </div>
@endsection

