<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-tambah.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-detail.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-packet.css')}}"  rel="stylesheet">
    <link href="{{asset('css/admin/tambah-paket.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-transaksi.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-absen.css')}}" rel="stylesheet">
    <!-- link favicon -->
    <link rel="shortcut icon" href="{{asset('assets/logo-favicon.png')}}" type="image/x-icon">
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        @include('components.sidebar')
        <div class="content">
            <!-- header -->
            <header>
                @if(request()->is('admin')) 
                    <x-header titleHeader="Beranda" :userName="$admin->username"></x-header>
                @elseif(request()->is('admin/tambah-member')) 
                    <x-header titleHeader="Tambah Member" :userName="$admin->username" ></x-header>
                @elseif(isset($detailMember) && (request()->is('admin/member/' . $detailMember['id_member'] . '/edit'))) 
                    <x-header titleHeader="Edit Member" :userName="$admin->username"></x-header> 
                @elseif(isset($detailMember) && (request()->is('admin/member/' . $detailMember['id_member']))) 
                    <x-header titleHeader="Detail Member" :userName="$admin->username"></x-header> 
                @elseif(request()->is('admin/paket-member'))
                    <x-header titleHeader="Daftar Paket" :userName="$admin->username"></x-header>
                @elseif(request()->is('admin/tambah-paket-member'))
                    <x-header titleHeader="Tambah Paket" :userName="$admin->username"></x-header>
                @elseif(isset($detailPaket) && (request()->is('admin/paket-member/' . $detailPaket['id_paket'] . '/edit')))
                    <x-header titleHeader="Edit Paket" :userName="$admin->username"></x-header>
                @elseif(request()->is('admin/transaksi/'))
                    <x-header titleHeader="Transaksi" :userName="$admin->username"></x-header>
                @else
                    <x-header titleHeader="Pengaturan Akun" :userName="$admin->username"></x-header>
                @endif
            </header>
            
            <!-- Pop-Up Notification -->
            <div id="notification-popup" class="popup hidden">
                <div class="popup-content">
                    <span id="close-popup" class="close">&times;</span>
                    <ul id="notification-list"></ul>
                </div>
            </div>
        
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/notification.js')}}"></script>
</body>
</html>