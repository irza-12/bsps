<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BSPS Desa Terjun Gajah</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --bg-color: #f8fafc;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            padding: 40px;
            border: 1px solid var(--border-color);
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: var(--primary);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .brand h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .brand p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .demo-account {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .demo-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 12px;
            text-align: center;
        }

        .demo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .demo-item {
            background: #f1f5f9;
            padding: 12px;
            border-radius: 8px;
            font-size: 12px;
            text-align: center;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .demo-item:hover {
            background: white;
            border-color: var(--border-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .demo-item strong {
            display: block;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .footer {
            margin-top: 32px;
            text-align: center;
            font-size: 12px;
            color: var(--text-secondary);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="brand">
            <div class="brand-logo">
                <i class="fas fa-home"></i>
            </div>
            <h1>Pendataan BSPS</h1>
            <p>Sistem Informasi Desa Terjun Gajah</p>
        </div>

        @if($errors->any())
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required
                    autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group" style="display: flex; align-items: center;">
                <input type="checkbox" id="remember" name="remember" style="margin-right: 8px;">
                <label for="remember" style="font-size: 13px; color: var(--text-secondary);">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                Sign In
            </button>
        </form>



        <div class="footer">
            &copy; 2026 Irza Mahendra Fhahlefi
        </div>
    </div>

    <script>
        function fillLogin(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</body>

</html>