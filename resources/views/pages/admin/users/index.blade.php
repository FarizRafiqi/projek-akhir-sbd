@extends('layouts.admin')

@section('title', 'Admin Panel Mediclo | Daftar User')
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
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item active">Daftar User</li>
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
            Daftar User
          </h6>
          <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
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
      let usersTable = window.LaravelDataTables['users-table'];
      $("#users-table_wrapper").addClass('table-responsive')
      usersTable.on("click.dt", "#dataTablesCheckbox", function() {
        if ($(this).is(':checked')) {
          usersTable.rows().select();
          $("input[type='checkbox']").prop("checked", true)
        } else {
          usersTable.rows().deselect();
        }
      });

      // Untuk memberikan properti checked ketika rownya diselect
      usersTable.on("select", (e, dt, type, index) => {
        usersTable[type](index).nodes().to$().find("td.select-checkbox > input[type='checkbox']").prop("checked",
          true)
      });

      usersTable.on("deselect", (e, dt, type, index) => {
        usersTable[type](index).nodes().to$().find("td.select-checkbox > input[type='checkbox']").prop("checked",
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

      usersTable.on("click.dt", ".btn-delete", (e) => {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data user ini akan dihapus.",
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

      $("#massDeleteUser").on("click", (e) => {
        e.preventDefault();
        Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Data-data user ini akan dihapus.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0d6efd',
          cancelButtonColor: '#bb2d3b',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            massDeleteUser();
          }
        })
      });

      const massDeleteUser = () => {
        let ids = $.map(usersTable.rows({
          selected: true
        }).data(), (entry) => {
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
          url: "{{ route('admin.users.massDestroy') }}",
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
              title: 'Data-data user berhasil dihapus.',
              icon: 'success',
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            })
          }
        })
      }

      // $("#users-table").on("click.dt", ".btn-edit", function(e){
      //   e.preventDefault();
      //   let id = $(this).data('id');
      //   $("#modalEditUser").modal('toggle');
      //   Livewire.emit('edit', id);
      // });
    })
  </script>
@endpush
