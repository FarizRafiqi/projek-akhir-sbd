<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Transaksi Berhasil</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="h-100">
  <div class="section-success d-flex align-items-center justify-content-center h-100">
    <div class="text-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="#28b7ca" class="bi bi-check-circle-fill"
        viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </svg>
      <h1>Pembayaran Anda Berhasil!</h1>
      <p>
        Terima kasih untuk pembayaran Anda.
      </p>
      <a href="{{ route('home') }}" class="btn btn-secondary mt-3 px-5">Kembali ke halaman utama</a>
    </div>
  </div>
</body>

</html>
