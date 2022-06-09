@extends('layouts.app')

@section('content')
  <div class="container w-75">
    <div class="row mt-4">
      <div class="{{ session('cart') ? 'col-md-7 col-lg-8' : 'col-12' }}">
        <ul class="list-group">
          @if (session('cart'))
            <div class="list-group-item bg-transparent border-top-0 border-start-0 border-end-0">
              <div class="d-flex justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="selectAll">
                  <label class="form-check-label" for="selectAll">
                    Pilih Semua
                  </label>
                </div>
                <div>
                  <a href="#modalWarning" class="text-decoration-none text-danger col text-end" data-bs-toggle="modal"
                    id="btnDeleteSelectedItem">Hapus</a>
                </div>
              </div>
            </div>
            @forelse (session('cart') as $id => $cart)
              <li class="list-group-item {{ count(session('cart')) > 1 && !$loop->last ? 'border-bottom-0' : '' }}">
                <div class="d-flex align-items-start mt-3">
                  <input class="form-check-input checkbox-item me-3" type="checkbox" value="{{ $id }}">
                  <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
                    <a href="{{ route('product-detail', $cart['slug']) }}">
                      <img
                        src="{{ $cart['image'] ? Storage::url('/img/drugs/' . $cart['image']) : asset('img/no-img.jpg') }}"
                        class="img-fluid" width="120">
                    </a>
                  </div>
                  <div>
                    <h5 class="fw-bold">{{ $cart['name'] }}</h5>
                    <p class="product-price fs-5 text-danger">Rp {{ number_format($cart['price'], 0, ',', '.') }}</p>
                  </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                  <a href="#modalWarning" class="text-center me-4 text-secondary btn-delete-product"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus dari keranjang"
                    data-id="{{ $id }}">
                    <i class="fas fa-trash fs-5"></i>
                  </a>
                  <div style="width: 120px;">
                    <input type="number" name="quantity" class="quantity-input" value="{{ $cart['quantity'] }}" min="1"
                      data-id={{ $id }}>
                  </div>
                </div>
              </li>
            @empty
              Keranjang kosong
            @endforelse
          @else
            <li class="list-group-item text-center p-5">
              <h5 class="fw-bold">Ayo Belanja!</h5>
              <p>Keranjangmu masih kosong. <br>Ayo isi dengan produk-produk terbaik {{ env('APP_NAME') }}!</p>
              <a href="{{ route('home') }}" class="btn btn-primary w-25">Belanja</a>
            </li>
          @endif
        </ul>
      </div>

      @if (session('cart'))
        <div class="{{ session('cart') ? 'col-md-5 col-lg-4 mt-3' : 'd-none' }}">
          <h5 class="mb-3">
            Ringkasan Belanja
          </h5>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">Total Harga ({{ count(session('cart')) }} produk)</h6>
              <span class="text-muted">
                @if (isset($subTotal))
                  @rupiah($subTotal)
                @endif
              </span>
            </li>
            <li class="list-group-item">
              <h6 class="my-0">Biaya lainnya</h6>
              <ul>
                <li>
                  <div class="d-flex justify-content-between">
                    <span>Biaya Admin</span>
                    <span class="text-muted">
                      @if (isset($adminFee))
                        @rupiah($adminFee)
                      @endif
                    </span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between">
                    <span>Ongkir</span>
                    <span class="text-muted">
                      Gratis
                    </span>
                  </div>
                </li>
              </ul>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (IDR)</span>
              <strong>
                @if (isset($totalPayment))
                  @rupiah($totalPayment)
                @endif
              </strong>
            </li>
            <li class="list-group-item p-0">
              <a href="{{ route('checkout') }}" class="btn btn-primary w-100">Checkout</a>
            </li>
          </ul>
        </div>
      @endif
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalWarning">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Semua Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <b>Apakah kamu yakin akan menghapus semua produk terpilih?</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" id="btnAgree">Yakin</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(".quantity-input").inputSpinner({
      decrementButton: "<i class='fas fa-minus'></i>",
      incrementButton: "<i class='fas fa-plus'></i>",
      buttonsClass: "btn-outline-success",
    });

    $(".quantity-input").on("change", function() {
      const qty = $(this).val();
      const id = $(this).data('id');

      setTimeout(() => {
        updateCart(qty, id);
      }, 1000);
    });

    function updateCart(qty, id) {
      let url = "{{ route('keranjang.update', ':id') }}";
      url = url.replace(":id", id);
      $.ajax({
        headers: {
          "x-csrf-token": "{{ csrf_token() }}"
        },
        method: 'POST',
        url: url,
        data: {
          quantity: qty,
          _method: 'PUT',
        },
        success: (result, status, xhr) => {
          console.log(result)
        },
        error: (xhr, status, error) => {

        }
      })
    }

    let selectedItems = [];
    $(".checkbox-item").on("click", function() {
      if ($(this).is(":checked")) {
        const val = $(this).val();
        if (selectedItems.indexOf(val) === -1) {
          selectedItems.push(val);
        }
      }
    });

    $("li.list-group-item input:checked").each(function() {
      selectedItems.push($(this).val());
    });

    $("#selectAll").on("click", function(e) {
      if ($(this).is(":checked")) {
        $("input[type='checkbox']").prop("checked", true);
        $("li.list-group-item input:checked").each(function() {
          selectedItems.push($(this).val());
        });
      } else {
        $("input[type='checkbox']").prop("checked", false);
      }
    });

    $(".btn-delete-product").on("click", function() {
      const id = $(this).data('id');
      $("#modalWarning").modal("show");
      $("#modalWarning .modal-title").html("Hapus Produk");
      $("#modalWarning .modal-body").html("<b>Apakah kamu yakin ingin menghapus produk ini?</b>");

      let url = "{{ route('keranjang.destroy', ':id') }}";
      url = url.replace(":id", id);

      $("#modalWarning #btnAgree").on("click", function() {
        $.ajax({
          headers: {
            "x-csrf-token": "{{ csrf_token() }}"
          },
          method: 'POST',
          url: url,
          data: {
            _method: 'DELETE',
          },
          success: (result, status, xhr) => {
            Swal.fire({
              title: xhr.responseText,
              icon: 'success',
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            })
          },
          error: (xhr, status, error) => {

          }
        })
      })
    })

    $("#btnDeleteSelectedItem").on("click", function() {
      let deleteAll = false;
      if($("#selectAll").is(":checked")) {
        deleteAll = true
      }
      $("#modalWarning .modal-title").html("Hapus Semua Produk");
      $("#modalWarning .modal-body").html("<b>Apakah kamu yakin akan menghapus semua produk terpilih?</b>");
     
      let data = {
        "selected_items": selectedItems,
        "_method": 'DELETE',
        "delete_all": deleteAll
      };
      
      $("#modalWarning #btnAgree").on("click", function() {
        $.ajax({
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          method: 'POST',
          url: "{{ route('keranjang.massDestroy') }}",
          data,
          success: (result, status, xhr) => {
            Swal.fire({
              title: xhr.responseText,
              icon: 'success',
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            })
          },
          error: (xhr, status, error) => {

          }
        })
      })
    })
  </script>
@endpush
