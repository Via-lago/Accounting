@extends('layouts.laporan')
@section('title',"Laporan Transaksi $periode")
@section('content')
<table>
    <tr>
        <td>Hal</td>
        <td>: Laporan Transaksi</td>
    </tr>
    <tr>
        <td>Periode</td>
        <td>: {{ $periode }}</td>
    </tr>
</table>
<table class="tabel-info">
    <thead>
        <tr>
            <th>Tanggal Transaksi</th>
            <th>Keterangan</th>
            <th>Pemasukan (Rp)</th>
            <th>Pengeluaran (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transaksi as $t)
            <tr>
                <td>{{ $t->tanggal_transaksi }}</td>
                <td>{{ $t->keterangan }}</td>   
                <td>
                    @if ($t->jenis == 'pemasukan')
                            {{ "Rp " . number_format($t->jumlah,2,',','.') }}
                            @else
                            Rp.0
                            @endif 
                    </td> 
                    <td>
                        @if ($t->jenis == 'pengeluaran')
                                {{ "Rp " . number_format($t->jumlah,2,',','.') }}
                                @else
                                Rp.0
                                @endif 
                    </td>   
            </tr>    
        @empty
        @endforelse
    </tbody>
    <tfoot>
        @forelse ($sal as $s)
        <tr>
            <th colspan="2" class="text-center"><b>Saldo Kas Akhir</b></th>
            <th colspan="2"><b>{{ number_format($s->total,2,',','.') }}</b></th>
        </tr>
        @empty 
        @endforelse
    </tfoot>
</table>
@endsection
