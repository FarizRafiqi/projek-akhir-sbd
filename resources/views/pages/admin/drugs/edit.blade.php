@extends('layouts.admin')

@section('title', 'Edit Obat' . $drug->id)

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Obat</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.drugs.index') }}"
            class="text-decoration-none text-reset">Daftar Obat</a></li>
        <li class="breadcrumb-item active">Ubah Obat {{ $drug->id }}</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <form action="{{ route('admin.drugs.update', $drug->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gy-3">
              <div class="col-md-3 col-12 text-md-start text-center">
                <img src="{{ $drug->image ? Storage::url($drug->image) : asset('img/no-img.jpg') }}"
                  class="img-thumbnail" alt="{{ $drug->name }}" width="300" height="300">
              </div>
              <div class="col-md-9 col-12">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                      <label for="name" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="name" value="{{ $drug->name }}" name="name">
                    </div>
                    <div class="mb-3">
                      <label for="drugType" class="form-label">Tipe Obat</label>
                      <select class="form-select" id="drugType" name="drug_type_id">
                        @foreach ($drug_types as $item)
                          <option {{ $drug->drug_type_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                            {{ $item->type }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="drugForm" class="form-label">Bentuk Obat</label>
                      <select class="form-select" id="drugForm" name="drug_form_id">
                        @foreach ($drug_forms as $item)
                          <option {{ $drug->drug_form_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                            {{ $item->form }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                      <label for="price" class="form-label">Harga</label>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input type="number" class="form-control" id="price" value="{{ $drug->price }}" step="50"
                          name="price">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="stock" class="form-label">Stok</label>
                      <input type="number" class="form-control" id="stock" value="{{ $drug->stock }}" name="stock">
                    </div>
                    <div class="mb-3">
                      <label for="image" class="form-label">Gambar</label>
                      <input class="form-control" type="file" id="image" name="image" value="{{ $drug->image }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="description" class="form-label">Deskripsi</label>
                  <textarea class="form-control" name="description" id="description" cols="30"
                    rows="5">{{ $drug->description }}</textarea>
                </div>
              </div>
              <div class="col-12 text-end">
                <a href="{{ route('admin.drugs.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
