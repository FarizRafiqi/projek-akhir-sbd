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
          <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Tambah
          </a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
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

      // $("#purchases-table").on("click.dt", ".btn-delete", function(e) {
      //   e.preventDefault();
      //   Swal.fire({
      //     title: 'Apakah kamu yakin?',
      //     text: "Data merek obat ini akan dihapus!",
      //     icon: 'warning',
      //     showCancelButton: true,
      //     confirmButtonColor: '#0d6efd',
      //     cancelButtonColor: '#bb2d3b',
      //     confirmButtonText: 'Ya',
      //     cancelButtonText: 'Batal'
      //   }).then((result) => {
      //     if (result.isConfirmed) {
      //       $(e.target).parent().submit();
      //     }
      //   })
      // });
    })
  </script>
@endpush
