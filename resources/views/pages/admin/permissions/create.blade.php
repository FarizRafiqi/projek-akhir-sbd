@extends('layouts.admin')

@section('title', 'Tambah Hak Akses')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}"
            class="text-decoration-none text-reset">Daftar Hak Akses</a></li>
        <li class="breadcrumb-item active">Tambah Hak Akses</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            <div class="row justify-content-center">
              <div class="col-md-4 col-12">
                <div class="mb-3">
                  <label for="title" class="form-label">Nama Hak Akses</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" placeholder="Masukkan hak akses">
                  @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="text-end">
                  <a href="{{ route('admin.permissions.index') }}" class="btn btn-danger">Batal</a>
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
