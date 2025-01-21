<div class="container">
    <div class="title-page">
        <h2>{{$titleHeader}}</h2>
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
            <h3>{{$userName}}</h3>
        </div>
    </div>
</div>