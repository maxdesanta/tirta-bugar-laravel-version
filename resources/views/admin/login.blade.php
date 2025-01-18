<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- link css -->
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-login.css')}}" rel="stylesheet">
    <!-- link favicon -->
    {{-- <link rel="shortcut icon" href="assets/logo-favicon.png" type="image/x-icon"> --}}
    <!-- link captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="login-title">Login</h2>
        <form method="POST">
            <div class="form-login container">
                <div class="form-group container">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="form-group container">
                    <label for="password">Password</label>
                    <div class="pw-group container">
                        <input type="password" name="password" id="password">
                        <img src="{{asset('assets/show-pw.svg')}}" alt="show-pw" onclick="showPassword()">
                    </div>
                    <a class="auth-link" href="admin-forgot-password.php" target="_blank">Forgot Password</a>
                </div>
                <div class="btn-group container">
                    {{-- <div class="g-recaptcha" data-sitekey="6LfEookqAAAAABXcqRQj72oB7pPTR4JC121z5DmZ"></div>
                    <br/> --}}
                    <button type="submit" name="submit" class="btn-login">Login</button>
                    <p>Don’t have account? <a class="auth-link" href="/admin/register">Register</a></p>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
