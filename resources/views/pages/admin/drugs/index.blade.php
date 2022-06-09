@extends('layouts.admin')

@section('title', 'Admin Panel Mediclo | Daftar Obat')
@push('styles')
  <style>
    .select-info {
      margin-left: 0.25rem;
    }
  </style>
@endpush
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Obat</li>
        <li class="breadcrumb-item active">Daftar Obat</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    @if (request()->action)
      <div class="col-12">
        <div class="alert alert-primary" role="alert">
          @if (isset($priceAvg))
            Rata-rata harga obat : @rupiah($priceAvg)
          @elseif(isset($priceMax))
            Harga obat termahal : @rupiah($priceMax)
          @endif
        </div>
      </div>
    @endif
    <div class="col-xl-12 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold">
            Daftar Obat
          </h6>
          <div>
            <button type="button" class="btn btn-secondary me-2" data-bs-toggle="modal"
              data-bs-target="#filterDrugModal">
              <i class="fas fa-filter"></i>
              Filter
            </button>
            <a href="{{ route('admin.drugs.create') }}" class="btn btn-primary">
              <i class="fas fa-plus"></i>
              Tambah
            </a>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="filterDrugModal" tabindex="-1" aria-labelledby="filterDrugModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterDrugModalLabel">Filter Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>Filter data berdasarkan:</h6>
          <form action="{{ route('admin.drugs.index') }}" method="GET" id="formFilter">
            <ul class="list-group">
              <li class="list-group-item">
                <a href="#" class="text-decoration-none text-reset btn-filter" id="filterObat1">
                  Obat dengan harga
                  <span class="text-danger"><i class="fas fa-chevron-right"></i></span> rata-rata
                </a>
                <button type="submit" class="d-none" name="action" value="filter_1">
              </li>
              <li class="list-group-item">
                <a href="#" class="text-decoration-none text-reset btn-filter" id="filterObat2">
                  Obat dengan harga
                  <span class="text-danger">
                    <i class="fas fa-chevron-left"></i>
                  </span>
                  rata-rata
                </a>
                <button class="d-none" name="action" value="filter_2">
              </li>
              <li class="list-group-item">
                <a href="#" class="text-decoration-none text-reset btn-filter" id="filterObat3">
                  Obat dengan harga termahal
                </a>
                <button class="d-none" name="action" value="filter_3">
              </li>
            </ul>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
  <script>
    $(function() {
      let drugsTable = window.LaravelDataTables['drugs-table'];
      $("#drugs-table_wrapper").addClass('table-responsive')
      $("#drugs-table").on("click.dt", "#dataTablesCheckbox", function() {
        if ($(this).is(':checked')) {
          drugsTable.rows().select();
          $("input[type='checkbox']").prop("checked", true)
        } else {
          drugsTable.rows().deselect();
        }
      });

      drugsTable.on("deselect", function(e, dt, type, index) {
        if (type === 'row') {
          let rowSelected = dt.rows({
            selected: true
          }).count();
          if (rowSelected === 0) {
            $("input[type='checkbox']").prop("checked", false)
          }
        }
      })

      $("#drugs-table").on("click.dt", ".btn-delete", function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data obat ini akan dihapus.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0d6efd',
          cancelButtonColor: '#bb2d3b',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            $(e.target).parent().submit();
          }
        })
      });

      $("#massDeleteDrug").on("click", function(e) {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data-data obat ini akan dihapus.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0d6efd',
          cancelButtonColor: '#bb2d3b',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            massDeleteDrug();
          }
        })
      });

      function massDeleteDrug() {
        let ids = $.map(drugsTable.rows({
          selected: true
        }).data(), function(entry) {
          return entry.id;
        });

        if (ids.length === 0) {
          Swal.fire({
            title: 'Tidak ada data yang dipilih.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
          })
          return;
        }

        $.ajax({
          headers: {
            "x-csrf-token": "{{ csrf_token() }}"
          },
          method: 'POST',
          url: "{{ route('admin.drugs.massDestroy') }}",
          data: {
            ids: ids,
            _method: 'DELETE'
          }
        }).done(function() {
          Swal.fire({
            title: 'Data-data obat berhasil dihapus.',
            icon: 'success',
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          })
        });
      }

      $(".btn-filter").on("click", function(e) {
        $(this).next().click();
      });
    })
  </script>
@endpush
