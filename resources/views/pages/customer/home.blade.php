@extends('layouts.app')

@section('content')
  <div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Banner --}}
    <div id="banner" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner shadow rounded-3">
        <div class="carousel-item active position-relative">
          <svg class="d-block w-100 position-relative" width="600" height="300" xmlns="http://www.w3.org/2000/svg"
            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
            <rect width="100%" height="100%" fill="#85E3DE"></rect>
          </svg>
          <img src="{{ asset('img/pharmacy.png') }}" class="position-absolute d-none d-md-block" alt="..." width="300"
            height="271" style="bottom: 5%; right: 15%;">
          <div class="position-absolute" style="top: 35%;left: 15%;">
            <h3>Mau Beli Obat?</h3>
            <h1 class="fw-bold">Beli di Mediclo aja!</h1>
            <h5>Dijamin pasti lebih murah</h5>
          </div>
        </div>
        {{-- <div class="carousel-item">
          <svg class="d-block w-100" width="600" height="300" xmlns="http://www.w3.org/2000/svg" role="img"
            preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#85E3DE"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Second
              slide</text>
          </svg>
        </div>
        <div class="carousel-item">
          <svg class="d-block w-100" width="600" height="300" xmlns="http://www.w3.org/2000/svg" role="img"
            preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#85E3DE"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third
              slide</text>
          </svg>
        </div> --}}
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    {{-- Kategori Obat --}}
    <section class="container-fluid mt-5">
      <h2 class="fw-bold ms-0">Kategori Obat</h2>
      <div class="row mt-3">
        <div class="card col-2" style="width: 118px;height: 118px">
          <div class="card-body text-center">
            <a href="#" class="text-decoration-none text-reset"><i class="fas fa-pills fs-1 mt-2 text-primary"></i>
              <p>Obat Bebas</p>
            </a>
          </div>
        </div>
        <div class="card col-2 ms-3" style="width: 118px;height: 118px">
          <div class="card-body text-center">
            <a href="#" class="text-decoration-none text-reset">
              <i class="fas fa-receipt fs-1 mt-2 text-warning"></i>
              <p>Obat Resep</p>
            </a>
          </div>
        </div>
        <div class="card col-2 ms-3" style="width: 118px;height: 118px">
          <div class="card-body text-center">
            <a href="#" class="text-decoration-none text-reset">
              <i class="fas fa-virus fs-1 mt-2 text-danger"></i>
              <p>Covid Related</p>
            </a>
          </div>
        </div>
      </div>
    </section>

    {{-- Produk Rekomendasi --}}
    <section class="container-fluid mt-5">
      <h2 class="fw-bold ms-0 mb-3">Produk Rekomendasi</h2>
      <div id="productRecommendation" class="carousel slide position-relative carousel-product" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container overflow-hidden">
              <div class="row justify-content-center">
                <div class="card product-recommendation-item col-2 me-1">
                  <img src="{{ asset('img/drugs/1 - acpulsif_5_mg_tablet.png') }}" class="card-img-top" alt="..."
                    height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/1 - acpulsif_5_mg_tablet.png') }}" class="card-img-top" alt="..."
                    height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/1 - acpulsif_5_mg_tablet.png') }}" class="card-img-top" alt="..."
                    height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/1 - acpulsif_5_mg_tablet.png') }}" class="card-img-top" alt="..."
                    height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/1 - acpulsif_5_mg_tablet.png') }}" class="card-img-top" alt="..."
                    height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 ms-1">
                  <img src="{{ asset('img/drugs/1 - acpulsif_5_mg_tablet.png') }}" class="card-img-top" alt="..."
                    height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container overflow-hidden">
              <div class="row justify-content-center">
                <div class="card product-recommendation-item col-2 me-1">
                  <img src="{{ asset('img/drugs/2 - actapin-5-mg_box_30_tablet.png') }}" class="card-img-top"
                    alt="..." height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/2 - actapin-5-mg_box_30_tablet.png') }}" class="card-img-top"
                    alt="..." height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/2 - actapin-5-mg_box_30_tablet.png') }}" class="card-img-top"
                    alt="..." height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/2 - actapin-5-mg_box_30_tablet.png') }}" class="card-img-top"
                    alt="..." height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 mx-1">
                  <img src="{{ asset('img/drugs/2 - actapin-5-mg_box_30_tablet.png') }}" class="card-img-top"
                    alt="..." height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
                <div class="card product-recommendation-item col-2 ms-1">
                  <img src="{{ asset('img/drugs/2 - actapin-5-mg_box_30_tablet.png') }}" class="card-img-top"
                    alt="..." height="150">
                  <div class="card-body">
                    <div class="card-title fw-bold">Obat 1</div>
                    <p class="card-text">Rp 17.000</p>
                    <a href="#" class="btn btn-primary">Lihat rincian</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle" type="button"
          data-bs-target="#productRecommendation" data-bs-slide="prev">
          <span class="carousel-control-prev-icon control-custom bg-secondary rounded-circle" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next position-absolute top-50 start-100 translate-middle" type="button"
          data-bs-target="#productRecommendation" data-bs-slide="next">
          <span class="carousel-control-next-icon control-custom bg-secondary rounded-circle" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    {{-- Jaminan Untuk Anda --}}
    <section class="container-fluid mt-5">
      <h2 class="fw-bold ms-0 mb-3">
        Jaminan Untuk Anda
      </h2>
      <div class="row g-4 pt-5 row-cols-1 row-cols-lg-3">
        <div class="col d-flex align-items-start">
          <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            <img src="{{ asset('img/icon-jaminan-1.png') }}" alt="Jaminan 1" class="img-fluid" width="120">
          </div>
          <div>
            <h2>100 % Obat Asli</h2>
            <p>Semua obat yang kami jual 100% dijamin kualitas terbaik dan berkhasiat.</p>
          </div>
        </div>
        <div class="col d-flex align-items-start">
          <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            <img src="{{ asset('img/icon-jaminan-2.png') }}" alt="Jaminan 2" class="img-fluid" width="120">
          </div>
          <div>
            <h2>Lebih Murah</h2>
            <p>Semua di aplikasi ini dijamin lebih murah daripada aplikasi lain.</p>
          </div>
        </div>
        <div class="col d-flex align-items-start">
          <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            <img src="{{ asset('img/icon-jaminan-3.png') }}" alt="Jaminan 3" class="img-fluid" width="120">
          </div>
          <div>
            <h2>Gratis Ongkir</h2>
            <p>100% gratis ongkir hingga ke alamat penerima.</p>
          </div>
        </div>
      </div>
    </section>

    {{-- Metode Pembayaran --}}
    <section class="container-fluid mt-5">
      <h2 class="fw-bold ms-0 mb-3">Metode Pembayaran</h2>
      <div class="row">
        <div class="col"><img src="{{ asset('img/metode-pembayaran/bca-thumb.png') }}" alt=""
            class="img-fluid" width="100"></div>
        <div class="col"><img src="{{ asset('img/metode-pembayaran/bni-thumb.png') }}" alt=""
            class="img-fluid" width="100"></div>
        <div class="col"><img src="{{ asset('img/metode-pembayaran/mandiri-thumb.png') }}" alt=""
            class="img-fluid" width="100"></div>
        <div class="col"><img src="{{ asset('img/metode-pembayaran/permata.png') }}" alt=""
            class="img-fluid" width="100"></div>
      </div>
    </section>

    {{-- Partner Pengiriman --}}
    <section class="container-fluid mt-5">
      <h2 class="fw-bold ms-0 mb-3">Partner Pengiriman</h2>
      <div class="row">
        <div class="col"><img src="{{ asset('img/partner-pengiriman/partner-kurir-7.png') }}" alt=""
            class="img-fluid" width="100"></div>
        <div class="col"><img src="{{ asset('img/partner-pengiriman/partner-kurir-8.png') }}" alt=""
            class="img-fluid" width="100"></div>
        <div class="col"><img src="{{ asset('img/partner-pengiriman/partner-kurir-9.png') }}" alt=""
            class="img-fluid" width="100"></div>
        <div class="col"><img src="{{ asset('img/partner-pengiriman/partner-kurir-10.png') }}" alt=""
            class="img-fluid" width="100"></div>
      </div>
    </section>

    <footer class="pt-4 mt-md-3 mb-md-1 pt-md-5 border-top">
      <div class="row">
        <div class="col-12 col-md">
          <img class="mb-2" src="{{ asset('img/mediclo-logo.png') }}" alt="" width="160">
          <div class="row g-2 row-cols-1">
            <div class="col d-flex align-items-start">
              <div class="flex-shrink-0 me-3">
                <i class="fab fa-whatsapp fs-2 text-dark"></i>
              </div>
              <div>
                <h5>WhatsApp</h5>
                <p>0897654321</p>
              </div>
            </div>
            <div class="col d-flex align-items-start">
              <div class="flex-shrink-0 me-3">
                <i class="fas fa-envelope fs-2 text-dark"></i>
              </div>
              <div>
                <h5>Email</h5>
                <p>mediclo@gmail.com</p>
              </div>
            </div>
            <div class="col d-flex align-items-start">
              <div class="flex-shrink-0 me-3">
                <i class="fas fa-phone-volume fs-2 text-dark"></i>
              </div>
              <div>
                <h5>Call Center</h5>
                <p>0897654321</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md">
          <h5>Bantuan</h5>
          <ul class="list-unstyled text-small">
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Tentang kami</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Kebijakan Privasi</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Tim Kesehatan</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Pemesanan dan Pembayaran</a>
            </li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Pengiriman</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">FAQ</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Syarat dan Ketentuan</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Media Sosial</h5>
          <ul class="list-unstyled text-small">
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Instagram</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Facebook</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Youtube</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Linked In</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Twitter</a></li>
            <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Whatsapp</a></li>
          </ul>
        </div>
        <div class="col-12">
          <p class="d-block mb-3 text-muted text-center">© {{ date('Y') }} All Right Reserved {{ env('APP_NAME') }}</p>
        </div>
      </div>
    </footer>
  </div>
@endsection
@push('scripts')
@endpush
