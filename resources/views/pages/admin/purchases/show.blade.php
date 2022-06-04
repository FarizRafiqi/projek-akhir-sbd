@extends('layouts.admin')

@section('title', 'Detail Pembelian Obat')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Pembelian Obat</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.purchases.index') }}"
            class="text-decoration-none text-reset">Daftar Pembelian Obat</a></li>
        <li class="breadcrumb-item active">Detail Pembelian Obat {{ $purchase->id }}</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <dl>
                <dt>Nama User</dt>
                <dd>{{ $purchase->user->name }}</dd>
                <dt>Obat yang Dibeli</dt>
                <dd>
                  <ul>
                    @foreach ($purchase->details as $item)
                      <li>{{ $item->drug->name }} x {{ $item->quantity }}</li>
                    @endforeach
                  </ul>
                </dd>
                <dt>Jumlah Obat</dt>
                <dd>{{ $purchase->details()->sum('quantity') }}</dd>
                <dt>Total Harga</dt>
                <dd>{{ $purchase->formatted_total_price }}</dd>
                <dt>Dibayar</dt>
                <dd>{{ $purchase->formatted_paid }}</dd>
                <dt>Kembalian</dt>
                <dd>{{ $purchase->formatted_change }}</dd>
                <dt>Tanggal Beli</dt>
                <dd>{{ $purchase->buy_date }}</dd>
                <dt>Status</dt>
                <dd>
                  <span class="badge rounded-pill bg-{{ $state }}">{{ $purchase->status }}</span>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
