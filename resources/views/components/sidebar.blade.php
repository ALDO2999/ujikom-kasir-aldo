<aside id="sidebar" class="sidebar">

{{-- 
    @php
        $role = auth()->user()->role;
    @endphp --}}




    {{-- @if ($role === 'admin') --}}
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? '' : 'collapsed' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.product.index') ? '' : 'collapsed' }}"
                    href="{{ route('admin.product.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Produk</span>
                </a>
            </li>


            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pembelian.index') ? '' : 'collapsed' }}"
                    href="{{ route('admin.pembelian.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Penjualan</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.index') ? '' : 'collapsed' }}"
                    href="{{ route('user.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>User</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('logout') ? '' : 'collapsed' }}"
                    href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>
    {{-- @endif --}}


    {{-- @if ($role === 'petugas') --}}
        <ul class="sidebar-nav" id="sidebar-nav">
{{-- 
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? '' : 'collapsed' }}"
                    href="{{ route('petugas.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li> --}}


            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.product.index') ? '' : 'collapsed' }}"
                    href="{{ route('petugas.product.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Produk</span>
                </a>
            </li> --}}


            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.pembelian.index') ? '' : 'collapsed' }}"
                    href="{{ route('petugas.pembelian.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Penjualan</span>
                </a>
            </li> --}}

            {{-- <li>
                <a class="nav-link {{ request()->routeIs('logout') ? '' : 'collapsed' }}"
                    href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li> --}}


        </ul>
    {{-- @endif --}}




</aside><!-- End Sidebar-->
