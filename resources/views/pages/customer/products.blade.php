@extends('layouts.app')

@section('content')
  <div class="container">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
      aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-reset">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Katalog Obat</li>
      </ol>
    </nav>
    <div class="row mt-5">
      <div class="col-12">
        <div class="row">
          <div class="col col-md-3 ms-auto me-2">
            <div class="row">
              <label for="sortProduct" class="col col-form-label text-end fw-bold">Sort</label>
              <select id="sortProduct" class="form-control col">
                <option value="">Nama Produk (A-Z)</option>
                <option value="">Nama Produk (Z-A)</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <!-- Filter -->
      <div class="col-lg-3 col-md-4 d-lg-inline-block d-md-inline-block d-none px-xl-0 pe-0 mb-5">
        <div class="filter">
          <div class="filter-header row mb-3 align-items-center">
            <div class="col-6">
              <span>Filter</span>
            </div>
            <a class="btn col-6 text-end pt-0 text-primary" id="btnReset">
              RESET
            </a>
          </div>
          <div class="filter-body">
            <div class="accordion" id="filterAccordion">
              {{-- Filter Harga --}}
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#priceFilter">
                    Harga
                  </button>
                </h2>
                <div id="priceFilter" class="accordion-collapse collapse show" data-bs-parent="#filterAccordion">
                  <div class="accordion-body text-end">
                    <div class="input-group mb-3">
                      <span class="input-group-text">Rp</span>
                      <input type="number" class="form-control" id="minPrice" placeholder="Min">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Rp</span>
                      <input type="number" class="form-control" id="maxPrice" placeholder="Max">
                    </div>
                    <button class="btn btn-primary btn-sm" id="btnPriceFilter">Terapkan</button>
                  </div>
                </div>
              </div>

              {{-- Filter Merek --}}
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#brandFilter">
                    Merek
                  </button>
                </h2>
                <div id="brandFilter" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                  <div class="accordion-body">
                    @foreach ($brands as $brand)
                      @if ($loop->iteration <= 5)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="{{ $brand->id }}"
                            id="{{ $brand->name }}">
                          <label class="form-check-label" for="{{ $brand->name }}">
                            {{ $brand->name }}
                          </label>
                        </div>
                      @endif
                    @endforeach

                    @if ($brands->count() > 5)
                      <a class="text-decoration-none" data-bs-toggle="modal" href="#brandModal">
                        Lihat lebih lengkap
                      </a>

                      <!-- Modal -->
                      <div class="modal fade" id="brandModal" data-bs-backdrop="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title me-2" id="exampleModalLabel">Merek</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('search-product') }}" method="POST">
                                @csrf
                                <select id="selectBrand" class="selectpicker form-control" data-live-search="true"
                                  data-actions-box="true" multiple>
                                  @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                  @endforeach
                                </select>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="button" class="btn btn-primary" id="btnSubmitBrand">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Filter Kategori Obat --}}
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#drugTypeFilter">
                    Kategori Obat
                  </button>
                </h2>
                <div id="drugTypeFilter" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                  <div class="accordion-body">
                    @foreach ($drugTypes as $item)
                      @if ($loop->iteration <= 5)
                        <div class="form-check">
                          @if (isset($drugType))
                            <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                              id="{{ $item->type }}" {{ $drugType->id == $item->id ? 'checked' : '' }}>
                          @else
                            <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                              id="{{ $item->type }}" checked>
                          @endif

                          <label class="form-check-label" for="{{ $item->type }}">
                            {{ $item->type }}
                          </label>
                        </div>
                      @endif
                    @endforeach

                    @if ($drugTypes->count() > 5)
                      <a class="text-decoration-none" data-bs-toggle="modal" href="#drugTypesModal">
                        Lihat lebih lengkap
                      </a>

                      <!-- Modal -->
                      <div class="modal fade" id="drugTypesModal" data-bs-backdrop="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title me-2">Kategori Obat</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="#">
                                <select id="selectDrugType" class="selectpicker form-control" data-live-search="true"
                                  data-actions-box="true" multiple>
                                  @foreach ($drugTypes as $item)
                                    <option value="{{ $item->id }}"
                                      {{ $drugType->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                  @endforeach
                                </select>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="button" class="btn btn-primary" id="btnSubmitDrugType">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Filter Bentuk Obat --}}
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#drugFormFilter">
                    Bentuk Obat
                  </button>
                </h2>
                <div id="drugFormFilter" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                  <div class="accordion-body">
                    @foreach ($drugForms as $drugForm)
                      @if ($loop->iteration <= 5)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="{{ $drugForm->id }}"
                            id="{{ $drugForm->type }}">
                          <label class="form-check-label" for="{{ $drugForm->form }}">
                            {{ $drugForm->form }}
                          </label>
                        </div>
                      @endif
                    @endforeach

                    @if ($drugTypes->count() > 5)
                      <a class="text-decoration-none" data-bs-toggle="modal" href="#drugFormsModal">
                        Lihat lebih lengkap
                      </a>

                      <!-- Modal -->
                      <div class="modal fade" id="drugFormsModal" data-bs-backdrop="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title me-2">Bentuk Obat</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="#">
                                <select id="selectDrugForm" class="selectpicker form-control" data-live-search="true"
                                  data-actions-box="true" multiple>
                                  @foreach ($drugForms as $drugForm)
                                    <option value="{{ $drugForm->id }}">{{ $drugForm->form }}</option>
                                  @endforeach
                                </select>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="button" class="btn btn-primary" id="btnSubmitDrugForm">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Filter -->

      <div class="col-lg-9 col-md-8 ps-4">
        <span>Menampilkan <span class="fw-bold" id="totalProduct">{{ $drugs->count() }}</span> obat.</span>
        <div class="row mt-4" id="product-list">
          @forelse ($drugs as $drug)
            <div class="col col-md-3">
              <a href="{{ route('product-detail', $drug->slug) }}" class="text-decoration-none text-reset"
                title="{{ $drug->name }}">
                <div class="card mb-3 shadow-sm">
                  <img src="{{ $drug->image ? Storage::url('/img/drugs/' . $drug->image) : asset('img/no-img.jpg') }}"
                    class="card-img-top">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">{{ \Str::limit($drug->name, 20) }}</h5>
                    <p class="card-text fs-5 text-danger">{{ $drug->formatted_price }}</p>
                  </div>
                </div>
              </a>
            </div>
          @empty
            <span class="col-12 text-center empty-text">Hasil Tidak Ditemukan.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    let selectedFilter = {
      "brands": [],
      "drug_forms": [],
      "drug_types": [],
    }

    $("#drugTypeFilter input:checked").each(function() {
      selectedFilter["drug_types"].push($(this).val());
    });

    $("#btnPriceFilter").on("click", function() {
      const minPrice = parseInt($("#minPrice").val());
      const maxPrice = parseInt($("#maxPrice").val());

      selectedFilter["price"] = {
        "min": minPrice,
        "max": maxPrice
      }

      setTimeout(() => {
        filterProduct(selectedFilter);
      }, 1000);
    });

    $("#brandFilter .form-check-input").on("click", function() {
      const val = $(this).val();
      if ($(this).is(":checked")) {
        if (selectedFilter["brands"].indexOf(val) === -1) {
          selectedFilter["brands"].push(val);
        }
      } else {
        const idx = selectedFilter["brands"].indexOf(val);
        if (idx > -1) {
          selectedFilter["brands"].splice(idx, 1);
        }
      }
      setTimeout(() => {
        filterProduct(selectedFilter);
      }, 1000);
    });

    $("#drugTypeFilter .form-check-input").on("click", function() {
      const val = $(this).val();
      if ($(this).is(":checked")) {
        if (selectedFilter["drug_types"].indexOf(val) === -1) {
          selectedFilter["drug_types"].push(val);
        }
      } else {
        const idx = selectedFilter["drug_types"].indexOf(val);
        console.log(selectedFilter)
        if (idx > -1) {
          selectedFilter["drug_types"].splice(idx, 1);
        }
      }
      console.log(selectedFilter)
      setTimeout(() => {
        filterProduct(selectedFilter);
      }, 1000);
    });

    $("#drugFormFilter .form-check-input").on("click", function() {
      const val = $(this).val();
      if ($(this).is(":checked")) {
        if (selectedFilter["drug_forms"].indexOf(val) === -1) {
          selectedFilter["drug_forms"].push(val);
        }
      } else {
        const idx = selectedFilter["drug_forms"].indexOf(val);
        if (idx > -1) {
          selectedFilter["drug_forms"].splice(idx, 1);
        }
      }

      setTimeout(() => {
        filterProduct(selectedFilter);
      }, 1000);
    });

    $("#selectBrand").on("shown.bs.select", function() {
      const selectedBrand = [...new Set(selectedFilter["brands"])];
      $("#selectBrand").selectpicker("val", selectedBrand);
    });

    $("#selectBrand").on("changed.bs.select", function() {
      selectedFilter["brands"] = $(this).val();
    });

    $("#btnSubmitBrand").on("click", function(e) {
      e.preventDefault();
      $("#brandModal").modal('hide');
      const selectedBrand = [...new Set(selectedFilter["brands"])];
      $("#brandFilter .form-check-input").val(selectedBrand);
      setTimeout(() => {
        filterProduct(selectedFilter);
      }, 1000);
    })

    $("#btnReset").on("click", function() {
      $("#minPrice").val(null);
      $("#maxPrice").val(null);
      $("#brandFilter .form-check-input").val([]);
      $("#drugTypeFilter .form-check-input").val([]);
      $("#drugFormFilter .form-check-input").val([]);

      selectedFilter = {
        "brands": [],
        "drug_forms": [],
        "drug_types": [],
      }

      setTimeout(() => {
        filterProduct(selectedFilter);
      }, 1000);
    });

    function filterProduct(data) {
      data["brands"] = [...new Set(data["brands"])];

      $("#product-list").html('');
      $.ajax({
        headers: {
          "x-csrf-token": "{{ csrf_token() }}"
        },
        method: 'POST',
        url: "{{ route('search-product') }}",
        data,
        success: (result, status, xhr) => {
          if (result) {
            const totalData = parseInt(result.length);
            $("#totalProduct").text(totalData);
            if (totalData === 0) {
              $("#product-list").append(`<span class="col-12 text-center empty-text">Hasil Tidak Ditemukan.</span>`)
            }

            $.each(result, function(i, data) {
              let name = data.name.substr(0, 20) + '...';
              let price = new Intl.NumberFormat('id-ID', {
                'style': 'currency',
                'currency': 'IDR',
                'minimumFractionDigits': 0
              }).format(data.price);

              let url = "{{ route('product-detail', ':id') }}";
              url = url.replace(":id", data.slug)
              
              $("#product-list").append(`
                <div class="col col-md-3">
                  <a href=${url} class="text-decoration-none text-reset" title="${data.name}">
                    <div class="card mb-3 shadow-sm">
                      <img src="${data.image ? `{{ Storage::url('/img/drugs/${data.image}') }}` : `{{ asset('img/no-img.jpg') }}`}"
                        class="card-img-top">
                      <div class="card-body">
                        <h5 class="card-title fw-bold">${name}</h5>
                        <p class="card-text fs-5 text-danger">${price}</p>
                      </div>
                    </div>
                  </a>
                </div>
              `)
            });
          }
        },
      })
    }
  </script>
@endpush
