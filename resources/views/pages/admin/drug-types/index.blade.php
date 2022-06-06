@extends('layouts.admin')

@section('title', 'Admin Panel Mediclo | Daftar Tipe Obat')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Obat</li>
        <li class="breadcrumb-item active">Daftar Kategori Obat</li>
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
            Daftar Kategori Obat
          </h6>
          <a href="{{ route('admin.drug-types.create') }}" class="btn btn-primary">
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
    $(function() {
      let drugTypesTable = window.LaravelDataTables['drugTypesTable'];
      $('#drugTypesTable_wrapper').addClass('table-responsive')
      $("#drugTypesTable").on("click.dt", "#dataTablesCheckbox", function() {
        if ($(this).is(':checked')) {
          drugTypesTable.rows().select();
          $("input[type='checkbox']").prop("checked", true)
        } else {
          drugTypesTable.rows().deselect();
        }
      });

      drugTypesTable.on("deselect", (e, dt, type, index) => {
        if (type === 'row') {
          let rowSelected = dt.rows({
            selected: true
          }).count();
          if (rowSelected === 0) {
            $("input[type='checkbox']").prop("checked", false)
          }
        }
      })

      $("#drugTypesTable").on("click.dt", ".btn-delete", (e) => {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data kategori obat ini akan dihapus.",
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

      $("#massDeleteDrugType").on("click", (e) => {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data-data kategori obat ini akan dihapus.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0d6efd',
          cancelButtonColor: '#bb2d3b',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            massDeleteDrugType();
          }
        })
      });

      function massDeleteDrugType() {
        let ids = $.map(drugTypesTable.rows({
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
          url: "{{ route('admin.drug-types.massDestroy') }}",
          data: {
            ids: ids,
            _method: 'DELETE'
          }
        }).done(() => {
          Swal.fire({
            title: 'Data-data kategori obat berhasil dihapus.',
            icon: 'success',
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          })
        });
      }
    })
  </script>
@endpush
