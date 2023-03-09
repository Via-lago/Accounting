<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('beranda')}}">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-book"></i> --}}
            <i class="fas fa-balance-scale"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Cashflow</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('beranda')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><b>Dashboard</b></span>
        </a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('coa.index')}}">
            <i class="fas fa-arrow-right"></i>
            <span><b>COA</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('target.index')}}">
            <i class="fas fa-arrow-right"></i>
            <span><b>Target Penjualan </b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('index.index')}}">
            <i class="fas fa-arrow-right"></i>
            <span><b>index</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('transaksi.index')}}">
            <i class="fas fa-exchange-alt"></i>
            <span><b>Transaksi penjualan & pembelian</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('operasional.index')}}">
            <i class="fas fa-exchange-alt"></i>
            <span><b>Transaksi Operasional</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('hutang.index')}}">
            <i class="fas fa-exchange-alt"></i>
            <span><b>Transaksi Utang</b></span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('piutang.index')}}">
            <i class="fas fa-exchange-alt"></i>
            <span><b>Transaksi Piutang</b></span></a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{route('cashflow.index')}}">
            <i class="fas fa-file"></i>
            <span><b>Cashflow</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('planning.index')}}">
            <i class="fas fa-file"></i>
            <span><b>Cashflow Planning</b></span></a>
    </li>   
    @can('isAdminOrBendahara', App\Transaksi::class)
    <li class="nav-item">
        <a class="nav-link" href="{{route('transaksi.laporan')}}">
            <i class="fa fa-file"></i>
            <span><b>Laporan</b></span></a>
    </li>
    @endcan




    @can('isAdmin', App\User::class)
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span><b>User</b></span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('instansi.index')}}">
            <i class="fas fa-building"></i>
            <span><b>Instansi</b></span></a>
    </li> --}}
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
