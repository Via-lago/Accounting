<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
<Body>
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Daftar Cashflow</h6>
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
                    <caption><b>Arus Kas Dari Kegiatan Operasional </b></caption>
                        @php
                            $grandtotal=0;
                        @endphp
                    @foreach ($akun as $a)
                        @php
                        $total =0;
                        $jenis ='a';
                        @endphp
                        @foreach($transaksi as $t)
                            @if($a->id == $t->id_akun)
                            @php
                                $total = $total + $t->jumlah;
                                $jenis = $t->jenis;
                                
                            @endphp
                            
                            @endif   
                        @endforeach 
                        <tr>
                            @if ($a->index == 2)
                            <th colspan="4" class="text-left">{{ $a->nama_akun }}</th>
                            <th colspan="4" class="text-left">
                                @if ($jenis == 'debit')
                                @php
                                    $grandtotal=$grandtotal + $total;
                                @endphp
                                {{ "Rp " . number_format($total,2,',','.') }}
                                @else
                                    Rp.0
                                @endif 
                            </th>
                            <th colspan="4" class="text-left">
                                @if ($jenis == 'kredit')
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
                </thead>
                    </table>
                

            </div>
        </div>
    </div>
</Body>
</html>
