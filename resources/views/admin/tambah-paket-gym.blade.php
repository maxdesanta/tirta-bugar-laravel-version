<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/tambah-paket.css')}}">
    <!-- Link favicon -->
    <link rel="shortcut icon" href="assets/logo-favicon.png" type="image/x-icon">
    <!-- Link Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        @include('components.sidebar')   
        <div class="content">
            <header>
                <div class="container">
                    <div class="title-page">
                        <h2>Tambah Paket Baru</h2>
                    </div>
                    <div class="account">
                        <img src="{{asset('assets/notification.svg')}}" alt="notifivation">
                        <div class="account-profile">
                            <img src="{{asset('assets/profile.svg')}}" alt="profile">
                            <h3>Admin</h3>
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <!-- form tambah paket -->
                <section class="edit-paket">
                    <form method="POST" action='/admin/create-paket-member' class="form-edit container">
                        <div class="form-group container">
                            <label for="nama_paket">Nama Paket</label>
                            <input type="text" name="nama_paket" id="nama_paket" class="input-edit" required>
                        </div>
                        
                        <div class="form-group container">
                            <label for="keterangan_fasilitas">Keterangan Fasilitas</label>
                            <input type="text" name="keterangan_fasilitas" id="keterangan_fasilitas" class="input-edit" required>
                        </div>

                        <div class="form-group container">
                            <label for="keterangan_durasi">Keterangan Durasi</label>
                            <input type="text" name="keterangan_durasi" id="keterangan_durasi" class="input-edit" required>
                        </div>

                        
                        <div class="form-group container">
                            <label for="keterangan-private">Keterangan Private</label>
                            <input type="text" name="keterangan-private" id="keterangan-private" class="input-edit">
                        </div>

                        <div class="form-group container">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="input-edit">
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