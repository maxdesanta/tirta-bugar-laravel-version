<!-- sidebar -->
<div class="sidebar container">
    <!-- sidebar layout -->
    <div class="navbar-menu">
        <!-- sidebar logo -->
        <div class="logo-sidebar">
            <h1>TB</h1>
        </div>
        <!-- sidebar menu -->
        <nav>
            <ul>
                <li>
                    <a href="/admin" class="menu-item {{ request()->is('admin') || (isset($detailMember) && (request()->is('admin/member/' . $detailMember['id_member']) || request()->is('admin/member/' . $detailMember['id_member'] . '/edit'))) ? 'container' : ''}}">
                        <div class="menu container">
                            <img src="{{asset('assets/home.svg')}}" alt="dashboard-nav">    
                            Beranda
                        </div>
                        @if(request()->is('admin') || (isset($detailMember) && (request()->is('admin/member/' . $detailMember['id_member']) || request()->is('admin/member/' . $detailMember['id_member'] . '/edit'))))
                            <img src="{{ asset('assets/active-menu.svg') }}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/tambah-member" class="menu-item {{ request()->is('admin/tambah-member') ? 'container' : ''}}">
                        <div class="menu container">
                            <img src="{{asset('assets/plus.svg')}}" alt="tambah-nav">    
                            Tambah Member
                        </div>
                        @if(request()->is('admin/tambah-member'))
                            <img src="{{ asset('assets/active-menu.svg') }}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/paket-member" class="menu-item {{ request()->is('admin/paket-member') || request()->is('admin/tambah-paket-member') || (isset($detailPaket) && (request()->is('admin/paket-member/' . $detailPaket['id_paket'] . '/edit'))) ? 'container' : ''}} ? 'container' : ''}}">
                        <div class="menu container">
                            <img src="{{asset('assets/note.svg')}}" alt="paket-nav">
                            Daftar Paket
                        </div>
                        @if(request()->is('admin/paket-member')|| request()->is('admin/tambah-paket-member') || (isset($detailPaket) && request()->is('admin/paket-member/' . $detailPaket['id_paket'] . '/edit')))
                        <img src="{{ asset('assets/active-menu.svg') }}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/transaksi" class="menu-item {{ request()->is('admin/transaksi') ? 'container' : ''}}">
                        <div class="menu container">
                            <img src="{{asset('assets/transaction.svg')}}" alt="transaction-nav">    
                            Transaksi
                        </div>
                        @if(request()->is('admin/transaksi'))
                            <img src="{{ asset('assets/active-menu.svg') }}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/setting" class="menu-item {{ request()->is('admin/setting') ? 'container' : ''}}">
                        <div class="menu container">
                            <img src="{{asset('assets/setting.svg')}}" alt="setting-nav">    
                            Pengaturan Akun
                        </div>
                        @if(request()->is('admin/setting'))
                            <img src="{{ asset('assets/active-menu.svg') }}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/absen-harian" class="menu-item {{ request()->is('admin/absen-harian') ? 'container' : ''}}">
                        <div class="menu container">
                            <img src="{{asset('assets/calendar.svg')}}" alt="calendar-nav">    
                            Absensi Harian
                        </div>
                        @if(request()->is('admin/absen-harian'))
                        <img src="{{ asset('assets/active-menu.svg') }}" alt="active-icon">
                    @endif
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- sidebar log out -->
    <form action="/logout" method="post">
        @csrf
        <button type="submit" name="submit" class="log-out container">
            <img src="{{asset('assets/log-out.svg')}}" alt="log-out">
            <h3 style="color: white;">Log Out</h3>
        </button>
    </form>
</div>