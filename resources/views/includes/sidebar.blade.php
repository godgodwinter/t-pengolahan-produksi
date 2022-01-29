<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">{{Fungsi::app_nama()}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">{{Fungsi::app_namapendek()}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Layout 0.1</li>


            <li {{ $pages == 'dashboard' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('dashboard') }}"><i
                class="fas fa-home"></i> <span>Dashboard</span></a></li>

@if((Auth::user()->tipeuser)=='admin')
<li
    class="nav-item dropdown {{ $pages == 'settings' || $pages == 'resetpassword' || $pages == 'passwordujian' ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
        <span>Pengaturan</span></a>
    <ul class="dropdown-menu">

        <li {{ $pages == 'settings' ? 'class=active' : '' }}><a class="nav-link" href="{{ route('settings') }}"><i
                    class="fas fa-cog"></i> <span>Aplikasi</span></a></li>
    </ul>
</li>

<li {{ $pages == 'users' ? 'class=active' : '' }}><a class="nav-link" href="{{route('users')}}"><i class="fas fa-flag-checkered"></i><span>Users </span></a></li>


<li {{ $pages == 'kategori' ? 'class=active' : '' }}><a class="nav-link" href="{{route('kategori')}}"><i class="fas fa-boxes"></i><span>Kelompok tani </span></a></li>


<li {{ $pages == 'bahan' ? 'class=active' : '' }}><a class="nav-link" href="{{route('bahan')}}"><i class="fas fa-building"></i><span>Bahan Produksi </span></a></li>

<li {{ $pages == 'pegawai' ? 'class=active' : '' }}><a class="nav-link" href="{{route('pegawai')}}"><i class="fas fa-cash-register"></i><span>Pegawai </span></a></li>
<li {{ $pages == 'petani' ? 'class=active' : '' }}><a class="nav-link" href="{{route('petani')}}"><i class="fas fa-cash-register"></i><span>Petani </span></a></li>


<li {{ $pages == 'produk' ? 'class=active' : '' }}><a class="nav-link" href="{{route('produk')}}"><i class="fas fa-cash-register"></i><span>Produk </span></a></li>


<li {{ $pages == 'hasilpanen' ? 'class=active' : '' }}><a class="nav-link" href="{{route('hasilpanen')}}"><i class="fas fa-screwdriver"></i><span>Pencatatan Hasil Panen </span></a></li>

<li {{ $pages == 'pengolahanbahan' ? 'class=active' : '' }}><a class="nav-link" href="{{route('pengolahanbahan')}}"><i class="fas fa-exclamation-triangle"></i><span>Pencatatan Bahan Produksi </span></a></li>

<li {{ $pages == 'produkrugilaba' ? 'class=active' : '' }}><a class="nav-link" href="{{route('produkrugilaba')}}"><i class="fas fa-screwdriver"></i><span>Rekap Rugi/Laba Produksi </span></a></li>

{{-- @include('includes.sidebar_admin') --}}

@elseif((Auth::user()->tipeuser)=='operator')

{{-- @include('includes.sidebar_pemain') --}}
<li {{ $pages == 'mesin' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.mesin')}}"><i class="fas fa-cash-register"></i><span>Mesin </span></a></li>


<li {{ $pages == 'monitoring' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.monitoring')}}"><i class="fas fa-cash-register"></i><span>Monitoring </span></a></li>

<li {{ $pages == 'pelaporankerusakan' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.pelaporankerusakan')}}"><i class="fas fa-exclamation-triangle"></i><span>Kerusakan </span></a></li>


<li {{ $pages == 'maintenance' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.maintenance')}}"><i class="fas fa-screwdriver"></i><span>Maintenance </span></a></li>


@else
{{-- kepalagedung --}}
{{-- @include('includes.sidebar_pelatih') --}}
<li {{ $pages == 'mesin' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.mesin')}}"><i class="fas fa-cash-register"></i><span>Mesin </span></a></li>


<li {{ $pages == 'monitoring' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.monitoring')}}"><i class="fas fa-cash-register"></i><span>Monitoring </span></a></li>

<li {{ $pages == 'pelaporankerusakan' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.pelaporankerusakan')}}"><i class="fas fa-exclamation-triangle"></i><span>Kerusakan </span></a></li>


<li {{ $pages == 'maintenance' ? 'class=active' : '' }}><a class="nav-link" href="{{route('operator.maintenance')}}"><i class="fas fa-screwdriver"></i><span>Maintenance </span></a></li>

@endif
        </ul>


    </aside>
</div>
