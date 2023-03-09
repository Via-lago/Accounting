@extends('layouts.default')
@section('title','Data COA')
@section('header-title','Data COA')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="{{route('coa.create')}}" class="btn btn-success mb-4">
           <b>Tambah</b>
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
</div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Data COA</h6>
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
                            <th>Nomor COA</th>
                            <th>Nama COA</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coa as $c)
                        <tr>
                            <td>{{ $c->nomor_coa }}</td>
                            <td>{{ $c->nama_coa }}</td>
                            <td>
                                {{-- <a class="btn btn-info btn-sm d-inline mr-1 mb-1" href="{{route('coa.edit', $c->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Ubah
                                </a> --}}
                                <form action="{{route('coa.destroy', $c->id)}}" method="post" class="d-inline" id="{{'form-hapus-transaksi-'.$c->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm btn-hapus" data-id="{{$c->id}}" type="submit">
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
    <script>
        // $('.btn-hapus').on('click', function(e){
        //     e.preventDefault();
        //     let id = $(this).data('id');
        //     let form = $('#form-hapus-transaksi-'+id);
        //     let jumlah = $(this).data('jumlah');

        //     Swal.fire({
        //     title: 'Apakah anda yakin?',
        //     text: 'Pemasukan sebesar '+ jumlah +' akan dihapus',
        //     icon: 'warning',
        //     showCancelButton: true,
        //     cancelButtonColor: '#5bc0de',
        //     confirmButtonColor: '#d9534f ',
        //     confirmButtonText: 'Ya, hapus!',
        //     cancelButtonText: 'Batal',
        //     reverseButtons: true,
        //     }).then((result) => {
        //         if (result.value) {
        //             form.submit();
        //         }
        //     })

        // });
    </script>
@endpush
