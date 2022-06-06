@extends('layouts.admin')

@section('title', 'Admin Panel Mediclo | Daftar Peran')
@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item active">Daftar Peran</li>
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
            Daftar Peran
          </h6>
          <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
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
      let rolesDataTable = window.LaravelDataTables['rolesDataTable'];
      $('#rolesDataTable_wrapper').addClass('table-responsive')
      $("#rolesDataTable").on("click.dt", "#dataTablesCheckbox", function() {
        if ($(this).is(':checked')) {
          rolesDataTable.rows().select();
          $("input[type='checkbox']").prop("checked", true)
        } else {
          rolesDataTable.rows().deselect();
        }
      });

      // Untuk memberikan properti checked ketika rownya diselect
      rolesDataTable.on("select", (e, dt, type, index) => {
        rolesDataTable[type](index).nodes().to$().find("td.select-checkbox > input[type='checkbox']").prop(
          "checked",
          true)
      });

      rolesDataTable.on("deselect", (e, dt, type, index) => {
        rolesDataTable[type](index).nodes().to$().find("td.select-checkbox > input[type='checkbox']").prop(
          "checked",
          false)
        if (type === 'row') {
          let rowSelected = dt.rows({
            selected: true
          }).count();
          if (rowSelected === 0) {
            $("input[type='checkbox']").prop("checked", false)
          }
        }
      })

      rolesDataTable.on("click.dt", ".btn-delete", (e) => {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data peran-peran ini akan dihapus.",
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

      $("#massDeleteRole").on("click", (e) => {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data-data peran ini akan dihapus.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0d6efd',
          cancelButtonColor: '#bb2d3b',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            massDeleteRole();
          }
        })
      });

      function massDeleteRole() {
        let ids = $.map(rolesDataTable.rows({
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
            url: "{{ route('admin.roles.massDestroy') }}",
            data: {
              ids: ids,
              _method: 'DELETE'
            },
            error: (xhr, status, error) => {
              Swal.fire({
                title: xhr.responseText,
                icon: 'error',
              })
            },
            success: (result, status, xhr) => {
              Swal.fire({
                title: 'Data-data role berhasil dihapus.',
                icon: 'success',
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })
            }
          })
      }
    })
  </script>
@endpush
