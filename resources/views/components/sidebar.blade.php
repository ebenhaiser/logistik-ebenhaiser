<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Logistik</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('index') ? 'active' : '' }}">
            <a href="{{ route('index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Barang Masuk</span></li>
        <li class="menu-item {{ request()->routeIs('incomingItems.list') ? 'active' : '' }}">
            <a href="{{ route('incomingItems.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-arrow-to-right"></i>
                <div data-i18n="Basic">Daftar Barang Masuk</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('incomingItems.form') ? 'active' : '' }}">
            <a href="{{ route('incomingItems.form') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-arrow-to-right"></i>
                <div data-i18n="Basic">Pencatatan Barang Masuk</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Barang Keluar</span></li>
        <li class="menu-item {{ request()->routeIs('outgoingItems.list') ? 'active' : '' }}">
            <a href="{{ route('outgoingItems.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-arrow-from-right"></i>
                <div data-i18n="Basic">Daftar Barang Keluar</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('outgoingItems.form') ? 'active' : '' }}">
            <a href="{{ route('outgoingItems.form') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-arrow-from-right"></i>
                <div data-i18n="Basic">Pencatatan Barang Keluar</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Stok Barang</span></li>
        <li class="menu-item {{ request()->routeIs('itemList.view') ? 'active' : '' }}">
            <a href="{{ route('itemList.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Basic">Daftar Stok Barang</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
