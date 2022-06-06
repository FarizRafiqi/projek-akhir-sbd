@extends('layouts.admin')

@section('title', 'Ubah Peran')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}"
            class="text-decoration-none text-reset">Daftar Peran</a></li>
        <li class="breadcrumb-item active">Ubah Peran</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="row justify-content-center">
              <div class="col-md-4 col-12">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Peran</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $role->name) }}" placeholder="Masukkan nama peran/role">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="permissions" class="form-label">Hak Akses</label>
                  <select
                    class="selectpicker form-control @error('permissions') is-invalid @enderror @error('permissions.*') is-invalid @enderror"
                    id="permissions" name="permissions[]" data-actions-box="true" data-live-search="true" multiple>
                    @foreach ($permissions as $item)
                      <option value="{{ $item->id }}"
                        {{ in_array($item->id, $role->permissions->pluck("id")->all()) ? 'selected' : '' }}>
                        {{ $item->title }}
                      </option>
                    @endforeach
                  </select>
                  @error('permissions')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  @error('permissions.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="text-end">
                  <a href="{{ route('admin.roles.index') }}" class="btn btn-danger">Batal</a>
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
