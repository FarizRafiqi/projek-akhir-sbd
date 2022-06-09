@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Keranjangmu</span>
          <span class="badge bg-primary rounded-pill">{{ count(session('cart')) }}</span>
        </h4>
        <ul class="list-group mb-3">
          @forelse (session('cart') as $id => $cart)
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0 text-break" title="{{ $cart['name'] }}">{{ $cart['name'] }}</h6>
                <small class="text-muted">Jumlah x{{ $cart['quantity'] }}</small>
              </div>
              <span class="text-muted">@rupiah($cart['price'])</span>
            </li>
          @empty
            Keranjang kosong
          @endforelse
          <li class="list-group-item d-flex justify-content-between">
            <span>Total</span>
            <strong>@rupiah(session('detail.total_payment'))</strong>
          </li>
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
      </div>
      <div class="col-md-7 col-lg-8">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3">Checkout</h4>
            <form class="needs-validation" action="{{ route('process-purchase') }}" method="POST">
              @csrf
              <input type="hidden" name="total_payment" value="{{ session('detail.total_payment') }}">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="Masukkan nama" name="name" value="{{ auth()->user()->name }}">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="col-sm-6">
                  <label for="phoneNum" class="form-label">No. Telepon</label>
                  <input type="text" class="form-control @error('phone_num') is-invalid @enderror" id="phoneNum"
                    placeholder="Masukkan nomor telepon" name="phone_num" value="{{ auth()->user()->phone_num ?? '' }}">
                  @error('phone_num')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Alamat Pengiriman</label>
                  <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                    placeholder="Contoh: Gg. Lestari 2"></textarea>
                  @error('address')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <hr class="my-4">

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="same-address">
                <label class="form-check-label" for="same-address">Alamat pengiriman sama dengan alamat tagihan</label>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="save-info">
                <label class="form-check-label" for="save-info">Simpan informasi untuk lain waktu</label>
              </div>

              <hr class="my-4">

              <h4 class="mb-3">Metode Pembayaran</h4>

              <div class="my-3">
                <div class="form-check">
                  <input id="bca" name="payment_method" type="radio" class="form-check-input">
                  <label class="form-check-label" for="bca">BCA</label>
                </div>
                <div class="form-check">
                  <input id="bni" name="payment_method" type="radio" class="form-check-input">
                  <label class="form-check-label" for="bni">BNI</label>
                </div>
                <div class="form-check">
                  <input id="mandiri" name="payment_method" type="radio" class="form-check-input">
                  <label class="form-check-label" for="mandiri">Mandiri</label>
                </div>
                <div class="form-check">
                  <input id="permata" name="payment_method" type="radio" class="form-check-input">
                  <label class="form-check-label" for="permata">Permata</label>
                </div>
                <div class="form-check">
                  <input id="ovo" name="payment_method" type="radio" class="form-check-input">
                  <label class="form-check-label" for="ovo">Ovo</label>
                </div>
                <div class="form-check">
                  <input id="gopay" name="payment_method" type="radio" class="form-check-input">
                  <label class="form-check-label" for="gopay">Gopay</label>
                </div>
              </div>

              <hr class="my-4">
              <h4 class="mb-3">Bayar</h4>
              <div class="mb-3">
                <input type="number" class="form-control @error('paid') is-invalid @enderror" id="paid"
                  placeholder="Masukkan jumlah uang Anda." name="paid" value="">
                @error('paid')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <button class="w-100 btn btn-primary btn-lg" type="submit">Bayar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $("#same-address").on("click", function() {
      if ($(this).is(":checked")) {
        $("#address").text("{{ auth()->user()->address }}")
      } else {
        $("#address").text("")
      }
    })
  </script>
@endpush
