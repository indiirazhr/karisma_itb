<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="shortcut icon" href="{{ asset('modernize/assets/images/logos/favicon.png') }}" type="image/png" />
  <link rel="stylesheet" href="{{ asset('modernize/assets/css/styles.css') }}" />
  <title>Akun Belum Diverifikasi</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f4f8;
      margin: 0;
      padding: 0;
    }

    #main-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      width: 90%;
      max-width: 500px;
      padding: 20px;
      text-align: center;
    }

    .container h2 {
      color: #333;
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .container p {
      color: #666;
      font-size: 16px;
      margin-bottom: 30px;
    }

    .btn-primary {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .alert-warning {
      background-color: #fff3cd;
      color: #856404;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        width: 90%;
        padding: 15px;
      }
    }
  </style>
</head>

<body>
  <div id="main-wrapper">
    <div class="container">
      <h2>Akun Belum Diverifikasi 👋</h2>
      <p>Terima kasih telah mendaftar. Akun Anda sedang menunggu verifikasi dari Staff Karisma ITB.</p>
      <p>Silakan kembali beberapa saat lagi.</p>

      <!-- Session Alert -->
      @if(session('status'))
        <div class="alert alert-warning">
          {{ session('status') }}
        </div>
      @endif

      <!-- Button Kembali -->
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-primary">Kembali</button>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('modernize/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('modernize/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ asset('modernize/assets/js/theme/app.init.js') }}"></script>
  <script src="{{ asset('modernize/assets/js/theme/theme.js') }}"></script>
  <script src="{{ asset('modernize/assets/js/theme/app.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
