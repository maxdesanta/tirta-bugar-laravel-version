<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reset Password</title>
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <!-- link favicon -->
    <link rel="shortcut icon" href="{{asset('assets/logo-favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/admin/admin-new-pw.css')}}">
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="new-pw-title">Reset Your Password</h2>
        <form method="POST" action="/reset-password/submit">
            @csrf
            <input type="hidden" name="token" value="{{ request()->get('token') }}">
            <div class="form-new-pw container">
                <div class="form-group container">
                    <label for="password">Masukan password baru</label>
                    <div class="pw-group container">
                        <input type="password" name="password" id="password" required>
                        <img src="{{asset('assets/show-pw.svg')}}" alt="show-pw" onclick="showPassword('password')">
                    </div>
                </div>
                <div class="form-group container">
                    <label for="confirmation-password">Konfirmasi password baru</label>
                    <div class="pw-group container">
                        <input type="password" name="password_confirmation" id="confirmation-password" required>
                        <img src="{{asset('assets/show-pw.svg')}}" alt="show-pw" onclick="showPassword('confirmation-password')">
                    </div>
                </div>
                <div class="btn-group">
                    <button type="submit" name="submit" class="btn-new-pw">Confirm</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function showPassword(type) {
            let passwordInput = document.getElementById(type);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        @if (session('success'))
            alert("{{ session('success') }}");
        @endif

        @if (session('error'))
            alert("{{ session('error') }}");
        @endif
    </script>
</body>
</html>