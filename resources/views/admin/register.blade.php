<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Register</title>
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-register.css')}}" rel="stylesheet">
    <!-- link favicon -->
    <link rel="shortcut icon" href="{{asset('assets/logo-favicon.png')}}" type="image/x-icon">
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="register-title">Register</h2>
        <form method="POST" action="/register/submit">
            @csrf
            <div class="container">
                <div class="form-group container">
                    <label for="username">Username</label>
                    <input type="username" name="username" id="username">
                    @error('username')
                            <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group container">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group container">
                    <label for="password">Password</label>
                    <div class="pw-group container">
                        <input type="password" name="password" id="password">
                        <img src="{{asset('assets/show-pw.svg')}}" alt="show-pw" onclick="showPassword()">
                    </div>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" name="submit" class="btn-register">Register</button>
                    <p class="text-login">Sudah Punya Akun? <a href="{{url('login')}}">Login</a></p>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('js/main.js')}}"></script>
    <!-- Alert untuk Flash Message -->
    <script>
        @if (session('success'))
            alert("{{ session('success') }}");
        @endif

        @if (session('error'))
            alert("{{ session('error') }}");
        @endif
    </script>
</body>
</html>