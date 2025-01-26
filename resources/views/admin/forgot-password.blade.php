<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin-forgot-pw.css')}}" rel="stylesheet">
    <!-- link favicon -->
    {{-- <link rel="shortcut icon" href="assets/logo-favicon.png" type="image/x-icon"> --}}
    <!-- link google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="forgot-layout container">
        <h2 class="forgot-title">Forgot Password</h2>
        <form method="POST" action="/forgot-password/submit">
            @csrf
            <div class="form-forgot container">
                <div class="form-group container">
                    <label for="email">Masukkan Email anda :</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="btn-group">
                    <button type="submit" name="submit" class="btn-forgot">Send Email</button>
                </div>
            </div>
        </form>
    </div>
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