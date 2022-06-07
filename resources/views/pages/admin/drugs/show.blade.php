@extends('layouts.admin')

@section('title', 'Detail Obat')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Obat</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.drugs.index') }}"
            class="text-decoration-none text-reset">Daftar Obat</a></li>
        <li class="breadcrumb-item active">Detail Obat {{ $drug->id }}</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-md-3 col-12 text-center text-md-start">
              <img src="{{ $drug->image ? Storage::url("/img/drugs/".$drug->image) : asset('img/no-img.jpg') }}"
                class="img-thumbnail" alt="{{ $drug->name }}" width="300" height="300">
            </div>
            <div class="col-9">
              <dl>
                <dt>Nama</dt>
                <dd>{{ $drug->name }}</dd>
                <dt>Tipe Obat</dt>
                <dd>{{ $drug->drugType->type }}</dd>
                <dt>Bentuk Obat</dt>
                <dd>{{ $drug->drugForm->form }}</dd>
                <dt>Harga</dt>
                <dd>{{ $drug->formatted_price }}</dd>
                <dt>Stok</dt>
                <dd>{{ $drug->stock }}</dd>
              </dl>
            </div>
            <div class="col-12">
              <dl>
                <dt>Slug</dt>
                <dd>{{ $drug->slug }}</dd>
                <dt>Deskripsi</dt>
                <dd>{{ $drug->description }}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
