<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <style>
    .select-info {
      margin-left: 0.25rem;
    }
  </style>
  @stack('styles')
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    @include('includes.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        @include('includes.admin.navbar')
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
      <!-- End of Main Content -->
      @include('includes.admin.footer')
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Siap untuk pergi?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Pilih "Keluar" di bawah, jika kamu siap mengakhiri sesi saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  @include('sweetalert::alert')
  {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}
  <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
  @stack('scripts')
</body>

</html>
