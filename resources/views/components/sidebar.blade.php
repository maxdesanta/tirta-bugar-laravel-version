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
                    <a href="/admin" class="menu-item container">
                        <div class="menu container">
                            <img src="{{asset('assets/home.svg')}}" alt="dashboard-nav">    
                            Beranda
                        </div>
                        @if(Route::is())
                            <img src="{{asset('assets/active-menu.svg')}}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/tambah-member" class="menu-item">
                        <div class="menu container">
                            <img src="{{asset('assets/plus.svg')}}" alt="tambah-nav">    
                            Tambah Member
                        </div>
                        @if(Route::is('admin.add-member'))
                            <img src="{{asset('assets/active-menu.svg')}}" alt="active-icon">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/admin/paket-member" class="menu-item">
                        <div class="menu container">
                            <img src="{{asset('assets/note.svg')}}" alt="paket-nav">
                            Daftar Paket
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/admin/transaksi" class="menu-item">
                        <div class="menu container">
                            <img src="{{asset('assets/transaction.svg')}}" alt="transaction-nav">    
                            Transaksi
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/admin/setting" class="menu-item">
                        <div class="menu container">
                            <img src="{{asset('assets/setting.svg')}}" alt="setting-nav">    
                            Pengaturan Akun
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/admin/absen-harian" class="menu-item">
                        <div class="menu container">
                            <img src="{{asset('assets/calendar.svg')}}" alt="calendar-nav">    
                            Absensi Harian
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- sidebar log out -->
    <a href="logout.php" class="log-out container">
        <img src="{{asset('assets/log-out.svg')}}" alt="log-out">
        <h3>Log Out</h3>
    </a>
</div>