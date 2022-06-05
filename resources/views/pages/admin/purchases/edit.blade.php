@extends('layouts.admin')

@section('title', 'Ubah Pembelian Obat')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Pembelian Obat</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.purchases.index') }}"
            class="text-decoration-none text-reset">Daftar Pembelian Obat</a></li>
        <li class="breadcrumb-item active">Ubah Pembelian Obat {{ $purchase->id }}</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <form action="{{ route('admin.purchases.update', $purchase->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
              <div class="col-md-4 col-12">
                <div class="mb-3">
                  <label for="status" class="form-label">Status Pembelian</label>
                  <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option selected disabled>Pilih Status Pembelian</option>
                    @foreach (config('const')['purchase_statuses'] as $status)
                      <option value="{{ $status }}"
                        {{ $status == old('status', $purchase->status) ? 'selected' : '' }}>
                        {{ $status }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="text-end">
                  <a href="{{ route('admin.purchases.index') }}" class="btn btn-danger">Batal</a>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
