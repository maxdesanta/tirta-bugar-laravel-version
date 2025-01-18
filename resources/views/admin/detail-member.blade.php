<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin-detail.css')}}">
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
        <!-- sidebar -->
        @include('components.sidebar')
        <div class="content">
            <header>
                <div class="container">
                    <div class="title-page">
                        <h2>Detail Member</h2>
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
                <!-- detail member -->
                <section class="detail-member">
                    <!-- detail member layout -->
                    <div class="container">
                        <div class="detail-member-group container">
                            <p class="label-nama">Nama</p>
                            <p>:</p>
                            <p id="nama-member">{{$detailMember['nama_member']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-phone">Nomor Telepon</p>
                            <p>:</p>
                            <p id="nomor-telepon">{{$detailMember['nomor_telepon']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-email">Email</p>
                            <p>:</p>
                            <p id="email">{{$detailMember['email']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-password">Password</p>
                            <p>:</p>
                            <p id="password">{{$detailMember['password']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-paket">Jenis Paket</p>
                            <p>:</p>
                            <p id="paket">{{$detailMember['nama_paket']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-durasi">Durasi</p>
                            <p>:</p>
                            <p id="durasi">{{$detailMember['keterangan_durasi']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-date-start">Tanggal Awal</p>
                            <p>:</p>
                            <p id="date-start">{{$detailMember['tanggal_awal']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-date-end">Tanggal Akhir</p>
                            <p>:</p>
                            <p id="date-end">{{$detailMember['tanggal_berakhir']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-keterangan">Keterangan</p>
                            <p>:</p>
                            <p id="keterangan">{{$detailMember['keterangan_fasilitas']}}</p>
                        </div>
                        <div class="detail-member-group container">
                            <p class="label-keterangan">Private Fitness</p>
                            <p>:</p>
                            <p id="private">{{$detailMember['keterangan_private']}}</p>
                        </div>
                    </div>
                    <div class="btn-group container">
                        <a href="/admin/member/{{$detailMember['id_member']}}/edit" class="btn-edit">Edit Member</a>
                        <a href="/admin" class="btn-delete">Batalkan</a>
                    </div>      
                </section>
            </main>
        </div>
    </div>
</body>
</html>