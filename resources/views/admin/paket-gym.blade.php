<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin-packet.css')}}">
    <!-- link favicon -->
    <link rel="shortcut icon" href="assets/logo-favicon.png" type="image/x-icon">
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="notifications.js"></script>

</head>
<body>
    <div class="container">
        @include('components.sidebar')
        <div class="content">
            <header>
                <div class="container">
                    <div class="title-page">
                        <h2>Daftar Paket</h2>
                    </div>
                    <div class="account">
            <!-- notif account -->
            <div id="notification-container" class="notification-container">
                <div class="notification-icon-wrapper">
                    <img src="{{asset('assets/notification.svg')}}" alt="notification" id="notificationIcon">
                    <span class="notification-badge hidden"></span>
                </div>
            </div>
            <div class="account-profile">
                <!-- icon account -->
                <img src="{{asset('assets/profile.svg')}}" alt="profile">
                <h3>Admin</h3>
            </div>
        </div>
            </div>
                </header>
        
            <!-- Pop-Up Notification -->
        <div id="notification-popup" class="popup hidden">
            <div class="popup-content">
                <span id="close-popup" class="close">&times;</span>
                <ul id="notification-list"></ul>
            </div>
        </div>
            <main>
                <!-- paket list -->
                <section class="packet-table">
                    <div style="text-align: right; margin-top: 10px;">
                        <a href="/admin/tambah-paket-member" class="button">Tambah Paket</a>
                    </div>
                    <table>
                        <!-- head table -->
                        <thead>
                            <tr>
                                <td>Nama Paket</td>
                                <td>Harga</td>
                                <td>Durasi</td>
                                <td>Keterangan Fasilitas</td>
                                <td>Kunjungan Private</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paketMember as $paket)
                                <tr>
                                    <td>{{$paket->nama_paket}}</td>
                                    <td>{{'Rp ' . number_format($paket->harga,0,',','.')}}</td>
                                    <td>{{$paket->keterangan_durasi}}</td>
                                    <td>{{$paket->keterangan_fasilitas}}</td>
                                    @if ($paket->keterangan_private == null)
                                        <td>-</td>
                                    @else
                                        <td>{{$paket->keterangan_private}}</td>
                                    @endif
                                    <td class="action">
                                        <div class="container" style=" width: 100%;align-items: center;justify-content: center;gap: 10px;">
                                            <a href="/admin/paket-member/{{$paket->id_paket}}/edit" class="btn-edit">Edit</a>
                                            <form action="/admin/paket-member/{{$paket->id_paket}}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-hapus">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
</body>
</html>