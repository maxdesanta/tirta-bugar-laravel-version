<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-absen.css')}}" rel="stylesheet">
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
                        <h2>Absensi Harian</h2>
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
                <!-- filtering absen -->
                <section class="filtering-absen">
                    <div class="container">
                        <form method="GET">
                            <!-- search absen -->
                            <div class="search-absen container">
                                <input type="text" name="search" id="search" placeholder="Search">
                                <img src="{{asset('assets/search.svg')}}" alt="search">
                            </div>
                        </form>
                    </div>
                </section>
                <section class="absen-table">
                    <table>
                        <!-- head table -->
                        <thead>
                            <tr>
                                <td style="text-align: center;width: 15%;">Tanggal Datang</td>
                                <td style="text-align: center; width: 20%;">nama</td>
                                <td style="text-align: center; width: 10%;">Durasi</td>
                                <td style="text-align: center; width: 15%;">Tanggal Berlaku</td>
                                <td style="text-align: center; width: 15%;">Keterangan Member</td>
                                <td style="text-align: center; width: 15%;">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absen as $a)
                                <tr>
                                    <td>{{$a->tanggal_datang}}</td>
                                    <td style="text-align: center;">{{$a->nama_member}}</td>
                                    <td style="text-align: center;">{{$a->keterangan_durasi}}</td>
                                    <td style="text-align: center;">{{$a->tanggal_berakhir}}</td>
                                    <td style="text-align: center;">{{$a->keterangan_fasilitas}}</td>
                                    <td style="text-align: center;">{{$a->keterangan_absen}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                <!-- Pagination -->
                <section class="pagination">
                    <div class="container">
                        <ul>
                        </ul>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>