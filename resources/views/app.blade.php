<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <!-- link favicon -->
    <!-- <link rel="shortcut icon" href="assets/logo-favicon.png" type="image/x-icon"> -->
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="content">
            @include('components.sidebar')
            <div>
                <!-- header -->
                <header>
                    <div class="container">
                        <div class="title-page">
                            <h2>Beranda</h2>
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
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>