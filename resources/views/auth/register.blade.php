@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10 col-md-8 col-lg-4">
        <div class="card">
          <div class="card-header text-center p-3">
            <img src="{{ asset('img/mediclo-logo.png') }}" alt="Mediclo Logo" class="img-fluid" width="150">
          </div>
          <div class="card-body p-5">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-3">
                <label for="name">Nama</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="text-md-end">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="text-md-end">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password-confirm" class="text-md-end">Konfirmasi Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                  autocomplete="new-password">
              </div>

              <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary w-100 rounded-pill">
                  Daftar
                </button>
              </div>

              <div class="mb-0 text-center">
                <div>Sudah punya akun?</div>
                <a href="{{ route('login') }}">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
