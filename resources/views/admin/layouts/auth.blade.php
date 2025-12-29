<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin Login') - Golden Wave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #f3f6fb 0%, #ffffff 100%);
            font-family: 'Poppins', sans-serif;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .brand img {
            height: 40px;
        }

    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="card-body p-4 p-md-5">
                <div class="brand">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo">
                    <div>
                        <h4 class="mb-0">Golden Wave</h4>
                        <small class="text-muted">Admin Panel</small>
                    </div>
                </div>

                @yield('content')

                <div class="mt-4 text-center text-muted small">
                    &copy; {{ date('Y') }} Golden Wave
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
