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
          <dl class="row">
            <dt class="col-sm-3">Nama Pelanggan</dt>
            <dd class="col-sm-9">{{ $purchase->user->name }}</dd>
            <dt class="col-sm-3">Obat yang Dibeli</dt>
            <dd class="col-sm-9">
              <ul>
                @foreach ($purchase->details as $item)
                  <li>{{ $item->drug->name }} x {{ $item->quantity }}</li>
                @endforeach
              </ul>
            </dd>
            <dt class="col-sm-3">Jumlah Obat</dt>
            <dd class="col-sm-9">{{ $purchase->details()->sum('quantity') }}</dd>
            <dt class="col-sm-3">Total Harga</dt>
            <dd class="col-sm-9">{{ $purchase->formatted_total_price }}</dd>
            <dt class="col-sm-3">Dibayar</dt>
            <dd class="col-sm-9">{{ $purchase->formatted_paid }}</dd>
            <dt class="col-sm-3">Kembalian</dt>
            <dd class="col-sm-9">{{ $purchase->formatted_change }}</dd>
            <dt class="col-sm-3">Tanggal Beli</dt>
            <dd class="col-sm-9">{{ date("d-m-Y H:i:s", strtotime($purchase->buy_date)) }}</dd>
            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
              <span class="badge rounded-pill bg-{{ $state }}">{{ $purchase->status }}</span>
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
@endsection
