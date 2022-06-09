@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link {{ request()->status ? '' : 'active' }}" id="v-pills-profile-tab"
                    data-bs-toggle="pill" href="#v-pills-profile">Profil</a>
                  <a class="nav-link {{ request()->status ? 'active' : '' }}" id="v-pills-home-tab" data-bs-toggle="pill"
                    href="#v-all-transaction">Semua
                    Transaksi
                  </a>
                </div>
              </div>
              <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade {{ request()->status ? '' : 'show active' }}" id="v-pills-profile">
                    <div class="row">
                      <div class="col-4 text-center text-md-start">
                        <img
                          src="{{ auth()->user()->image ? Storage::url('/img/avatar/' . auth()->user()->image) : asset('img/no-img.jpg') }}"
                          class="img-thumbnail" alt="{{ auth()->user()->name }}" width="250" height="250">
                      </div>
                      <div class="col-8">
                        <dl>
                          <dt>Nama</dt>
                          <dd>{{ auth()->user()->name }}</dd>
                          <dt>Jenis Kelamin</dt>
                          <dd>{{ auth()->user()->sex == 'male' ? 'Laki-laki' : 'Perempuan' }}</dd>
                          <dt>Nomor Telepon</dt>
                          <dd>{{ auth()->user()->phone_num }}</dd>
                          <dt>Email</dt>
                          <dd>{{ auth()->user()->email }}</dd>
                          <dt>Alamat</dt>
                          <dd>{{ auth()->user()->address }}</dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade {{ request()->status ? 'show active' : '' }}" id="v-all-transaction">
                    <div class="row">
                      <div class="col-1">Status</div>
                      <div class="col-11">
                        <form action="">
                          <ul class="nav nav-pills mb-3" id="pills-tab">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link {{ request()->status == 'success' ? 'active' : '' }}" id="pills-success-tab" data-bs-toggle="pill"
                                href="#pills-success">Sukses</a>
                              <button type="submit" class="d-none" name="status" value="success"></button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link {{ request()->status == 'pending' ? 'active' : '' }}"
                                id="pills-pending-tab" data-bs-toggle="pill" href="#pills-pending">Menunggu</a>
                              <button type="submit" class="d-none" name="status" value="pending"></button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link {{ request()->status == 'failed' ? 'active' : '' }}"
                                id="pills-failed-tab" data-bs-toggle="pill" href="#pills-failed">Gagal</a>
                              <button type="submit" class="d-none" name="status" value="failed"></button>
                            </li>
                          </ul>
                        </form>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-success">
                            @if (isset($count))
                              <div class="mb-3">
                                Total Pembelian Sukses : {{ $count }}
                              </div>
                            @endif
                            {{ $dataTable->table(['table table-bordered table-striped']) }}
                          </div>
                          <div class="tab-pane fade" id="pills-pending">
                            @if (isset($count))
                              <div class="mb-3">
                                Total Pembelian Menunggu : {{ $count }}
                              </div>
                            @endif
                            {{ $dataTable->table(['table table-bordered table-striped']) }}
                          </div>
                          <div class="tab-pane fade" id="pills-failed">
                            @if (isset($count))
                              <div class="mb-3">
                                Total Pembelian Gagal : {{ $count }}
                              </div>
                            @endif
                            {{ $dataTable->table(['table table-bordered table-striped']) }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  {{ $dataTable->scripts() }}
  <script>
    $("#v-all-transaction .nav-pills .nav-link").on("click", function() {
      $(this).next().click();
    });
  </script>
@endpush
