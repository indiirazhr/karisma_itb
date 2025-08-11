<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website KARISMA ITB">
    <meta name="author" content="KARISMA ITB">

    {{-- <link href="/admin/assets/img/logo/logo.png" rel="icon"> --}}
    <link href="assets/img/logo.jpeg" rel="icon">
    <title>Register - Website KARISMA</title>

    <link href="/admin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/assets/css/ruang-admin.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
        }
        .card {
            border-radius: 1rem;
        }
        .form-control {
            border-radius: 0.5rem;
        }
        .text-danger {
            font-size: 0.875rem;
        }
        .login-brand {
            font-weight: bold;
            color: #4e73df;
            font-size: 1.3rem;
        }
    </style>
</head>

<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body px-4 py-5">
                    <div class="text-center mb-4">
                         <img src="assets/img/logo.jpeg" alt="Logo KARISMA" class="img-fluid" width="60">
                        <h4 class="mt-2 text-primary">REGISTER</h4>
                        <div class="login-brand">Website KARISMA ITB</div>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <input type="hidden" name="role_id" value="4">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input id="password-confirm" type="password"
                                   class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus me-1"></i> Daftar
                            </button>
                        </div>

                        <div class="text-center mt-2">
                            <a href="{{ route('login') }}" class="small">Sudah punya akun? Login</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3 text-muted small">
                &copy; {{ date('Y') }} KARISMA ITB
            </div>
        </div>
    </div>

    <script src="/admin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/admin/assets/js/ruang-admin.min.js"></script>
</body>
</html>
