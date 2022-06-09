@extends('layouts.admin')

@section('title', 'Admin Panel Mediclo | Daftar Pembelian')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Pembelian Obat</li>
        <li class="breadcrumb-item active">Daftar Pembelian Obat</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-12 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">
            Daftar Pembelian Obat
          </h6>
          <button type="button" class="btn btn-secondary me-2" data-bs-toggle="modal"
            data-bs-target="#filterPurchaseModal">
            <i class="fas fa-filter"></i>
            Filter
          </button>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="filterPurchaseModal" tabindex="-1" aria-labelledby="filterPurchaseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterPurchaseModalLabel">Filter Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Filter data berdasarkan:</h6>
          <form action="{{ route('admin.purchases.index') }}" method="GET" id="formFilter">
            <div class="mb-3">
              <label for="selectStatus" class="form-label">Status</label>
              <select class="form-control form-select" name="status" id="selectStatus">
                <option value="all">semua status</option>
                @foreach (config('const')['purchase_statuses'] as $item)
                  <option value="{{ $item }}" {{ request()->status == $item ? 'selected' : '' }}>
                    {{ $item }}</option>
                @endforeach
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
  <script>
    $(() => {
      let purchasesTable = window.LaravelDataTables['purchases-table'];
      $("#purchases-table_wrapper").addClass('table-responsive');
    })

    $("#btnSubmit").on("click", function(e) {
      $("#formFilter").submit();
    });
  </script>
@endpush
