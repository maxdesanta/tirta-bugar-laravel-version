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
                        <img src="assets/notification.svg" alt="notification" id="notificationIcon">
                        <span class="notification-badge hidden"></span>
                    </div>
                </div>
                <div class="account-profile">
                    <!-- icon account -->
                    <img src="assets/profile.svg" alt="profile">
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