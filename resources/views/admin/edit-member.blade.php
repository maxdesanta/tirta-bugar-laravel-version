<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet" >
    <link href="{{asset('css/admin/admin-tambah.css')}}" rel="stylesheet">
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

        <!-- content -->
        <div class="content">
        <header>
                <div class="container">
                    <div class="title-page">
                        <h2>Edit Member</h2>
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
                <!-- form tambah member -->
                <section class="tambah-member">
                    <form class="form-tambah container" action="/admin/member/{{$detailMember->id_member}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="id" value="{{ $detailMember->id_member }}">
                        <div class="form-group container">
                            <label for="nama">Nama (Sesuai KTP)</label>
                            <input type="text" name="nama" id="nama" class="input-tambah" value="{{ $detailMember->nama_member }}">
                        </div>
                        <div class="form-group container">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="input-tambah" value="{{ $detailMember->email }}">
                        </div>
                        <div class="form-group container">
                            <label for="nomor-telepon">Nomor Telepon</label>
                            <input type="text" name="nomor-telepon" id="nomor-telepon" class="input-tambah" value="{{ $detailMember->nomor_telepon }}">
                        </div>
                        <div class="form-group container">
                            <label for="durasi">Pilihan Paket</label>
                            <select name="durasi" id="durasi" class="input-tambah" onchange="updateEndDate()">
                                <option value="1" {{ $detailMember->id_paket == 1 ? 'selected' : ''}}>Regullar - 1 Bulan 8x Fitness</option>
                                <option value="2" {{ $detailMember->id_paket == 2 ? 'selected' : ''}}>Regullar - 1 Bulan Fitness Sepuasnya</option>
                                <option value="3" {{ $detailMember->id_paket == 3 ? 'selected' : ''}}>Regullar - 3 Bulan Fitness Sepuasnya</option>
                                <option value="4" {{ $detailMember->id_paket == 4 ? 'selected' : ''}}>Regullar - 1 Bulan Sepuasnya + 4x Private Fitness</option>
                            </select>
                        </div>
                        <div class="form-group container">
                            <label for="tanggal-awal">Tanggal Perpanjangan</label>
                            <input type="date" name="tanggal-awal" id="tanggal-awal" class="input-tambah" onchange="updateEndDate()" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group container">
                            <label for="tanggal-akhir">Tanggal Berakhir</label>
                            <input type="date" name="tanggal-akhir" id="tanggal-akhir" class="input-tambah" value="{{ $detailMember->tanggal_berakhir }}">
                        </div>
                        <div class="btn-group container">
                            <button type="submit" name="submit" class="btn-tambah">Edit Member</button>
                            <a href="/admin/member/{{$detailMember->id_member}}" class="btn-cancell">Batalkan</a>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>
    <script src={{asset('js/admin/main.js')}}></script>
</body>
</html>