<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket</title>
    <!-- Link CSS -->
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-edit-paket.css')}}" rel="stylesheet">
    <!-- Link favicon -->
    <link rel="shortcut icon" href="assets/logo-favicon.png" type="image/x-icon">
    <!-- Link Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src= notifications.js></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        @include('components.sidebar');
        
        <div class="content">
            <header>
                <div class="container">
                    <div class="title-page">
                        <h2>Edit Paket</h2>
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
                <!-- form edit paket -->
                <section class="edit-paket">
                    <form class="form-edit container" action="/admin/paket-member/{{$detailPaket->id_paket}}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id_paket" value="{{ $detailPaket->id_paket}}">
                        <div class="form-group container">
                            <label for="nama_paket">Nama Paket</label>
                            <input type="text" name="nama_paket" id="nama_paket" class="input-edit" value="{{$detailPaket->nama_paket}}" required>
                        </div>
                        
                        <div class="form-group container">
                            <label for="keterangan_fasilitas">Keterangan Fasilitas</label>
                            <input type="text" name="keterangan_fasilitas" id="keterangan_fasilitas" class="input-edit" value="{{ $detailPaket->keterangan_fasilitas}}" required>
                        </div>

                        <div class="form-group container">
                            <label for="keterangan_durasi">Keterangan Durasi (berapa pertemuan)</label>
                            <input type="text" name="keterangan_durasi" id="keterangan_durasi" class="input-edit" value="{{ $detailPaket->keterangan_durasi}}" required>
                        </div>

                        
                        <div class="form-group container">
                            <label for="keterangan_private">Keterangan Private (berapa pertemuan)</label>
                            <input type="text" name="keterangan_private" id="keterangan_private" value="{{ $detailPaket->keterangan_private}}" class="input-edit">
                        </div>

                        <div class="form-group container">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="input-edit" value="{{$detailPaket->harga}}" required>
                        </div>

                        <div class="btn-group container">
                            <button type="submit" name="submit" class="btn-edit">Simpan</button>
                            <a href="/admin/paket-member" class="btn-cancell">Kembali</a>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
