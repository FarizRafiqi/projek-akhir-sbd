@extends('layouts.app')

@section('content')
  <div class="container">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
      aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-reset">Home</a></li>
        <li class="breadcrumb-item active">
          <a href="{{ route('show-by-category', $drug->drugType->slug) }}" class="text-decoration-none text-reset">
            Katalog Obat
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $drug->name }}</li>
      </ol>
    </nav>
    <div class="row justify-content-center mt-5">
      <div class="col-4">
        <img src="{{ $drug->image ? Storage::url('/img/drugs/' . $drug->image) : asset('img/no-img.jpg') }}"
          class="img-thumbnail" alt="{{ $drug->name }}" width="340" height="340">
      </div>
      <div class="col-4">
        <h4 class="fw-bold">{{ $drug->name }}</h4>
        <dl class="row gy-2 mt-3">
          <dt class="col-4">Tipe Obat</dt>
          <dd class="col-8">{{ $drug->drugType->type }}</dd>
          <dt class="col-4">Bentuk Obat</dt>
          <dd class="col-8">{{ $drug->drugForm->form }}</dd>
          <dt class="col-4">Harga</dt>
          <dd class="col-8 fw-bold text-danger">{{ $drug->formatted_price }}</dd>
          <dt class="col-4">Stok</dt>
          <dd class="col-8">{{ $drug->stock }}</dd>
          <dt class="col-4">Jumlah</dt>
          <dd class="col-8">
            <div class="w-75">
              <input type="number" name="quantity" id="quantity" value="1" min="1">
            </div>
          </dd>
        </dl>
        <form action="{{ route('keranjang.store') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $drug->id }}">
          <input type="hidden" name="name" value="{{ $drug->name }}">
          <input type="hidden" name="price" value="{{ $drug->price }}">
          <input type="hidden" name="quantity" value="{{ $drug->quantity }}">
          <input type="hidden" name="image" value="{{ $drug->image }}">
          <input type="hidden" name="slug" value="{{ $drug->slug }}">
          <button type="submit" class="btn btn-primary" id="btnAddToCart"><i class="fas fa-cart-plus"></i>
            Masukkan Keranjang
          </button>
        </form>
      </div>
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-8">
        <h5 class="fw-bold mb-4">Deskripsi</h5>
        <p>{{ $drug->description }}</p>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $("#quantity").inputSpinner({
      decrementButton: "<i class='fas fa-minus'></i>",
      incrementButton: "<i class='fas fa-plus'></i>",
      buttonsClass: "btn-outline-success",
    });

    $("#btnAddToCart").on("click", function(e) {
      const data = {
        "id": $("input[name='id']").val(),
        "name": $("input[name='name']").val(),
        "price": $("input[name='price']").val(),
        "quantity": $("input[name='quantity']").val(),
        "image": $("input[name='image']").val(),
        "slug": $("input[name='slug']").val(),
      }

      e.preventDefault();
      $.ajax({
        headers: {
          "x-csrf-token": "{{ csrf_token() }}"
        },
        method: 'POST',
        url: "{{ route('keranjang.store') }}",
        data,
        success: (result, status, xhr) => {
          Swal.fire({
            title: xhr.responseText,
            icon: 'success',
            html: `<a href="{{ route('keranjang.index') }}" class="text-decoration-none">Lihat Keranjang</a>`,
          })
        },
        error: (xhr, status, error) => {
          // jika belum login arahkan pelanggan ke halaman login
          if (xhr.status == 401) {
            window.location.href = "{{ route('login') }}"
          }
        }
      })
    })
  </script>
@endpush
