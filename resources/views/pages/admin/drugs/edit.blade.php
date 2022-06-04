@extends('layouts.admin')

@section('title', 'Ubah Obat ' . $drug->id)

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
                <img src="{{ $drug->image ? Storage::url("/img/drugs/".$drug->image) : asset('img/no-img.jpg') }}"
                  class="img-thumbnail" alt="{{ $drug->name }}" width="300" height="300">
              </div>
              <div class="col-md-9 col-12">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                      <label for="name" class="form-label">Nama</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('drug_name', $drug->name) }}" name="name">
                      @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="drugType" class="form-label">Tipe Obat</label>
                      <select class="form-select @error('drug_type_id') is-invalid @enderror" id="drugType"
                        name="drug_type_id" data-placeholder="Pilih Tipe Obat">
                        <option></option>
                        @foreach ($drug_types as $item)
                          <option value="{{ $item->id }}"
                            {{ $item->id == old('drug_type_id', $drug->drug_type_id) ? 'selected' : '' }}>
                            {{ $item->type }}
                          </option>
                        @endforeach
                      </select>
                      @error('drug_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="drugForm" class="form-label">Bentuk Obat</label>
                      <select class="form-select @error('drug_form_id') is-invalid @enderror" id="drugForm"
                        name="drug_form_id" data-placeholder="Pilih Bentuk Obat">
                        <option></option>
                        @foreach ($drug_forms as $item)
                          <option value="{{ $item->id }}"
                            {{ $item->id == old('drug_form_id', $drug->drug_form_id) ? 'selected' : '' }}>
                            {{ $item->form }}
                          </option>
                        @endforeach
                      </select>
                      @error('drug_form_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                      <label for="price" class="form-label">Harga</label>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                          value="{{ old('price', $drug->price) }}" name="price">
                        @error('price')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="stock" class="form-label">Stok</label>
                      <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                        value="{{ $drug->stock }}" name="stock">
                      @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="image" class="form-label">Gambar</label>
                      <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
                        value="{{ $drug->image }}">
                      @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label for="brand" class="form-label">Merek Obat</label>
                  <select class="form-select @error('brand_id') is-invalid @enderror" id="brand" name="brand_id"
                    data-placeholder="Pilih Merek Obat">
                    <option></option>
                    @foreach ($drug_brands as $item)
                      <option value="{{ $item->id }}"
                        {{ $item->id == old('brand_id', $drug->brand_id) ? 'selected' : '' }}>
                        {{ $item->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('brand_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="description" class="form-label">Deskripsi</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30"
                    rows="5" placeholder="Masukkan deskripsi">{{ old('description', $drug->description) }}</textarea>
                  @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
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
@push('scripts')
  <script>
    const previewImg = (target, imgPreviewPlace, labelPlace) => {
      const input = document.querySelector(target)
      if (input.files && input.files[0]) {
        // ini buat mengganti preview 
        const reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = (e) => $(imgPreviewPlace).attr("src", e.target.result);
      }
    }

    $("#image").on("change", () => previewImg("#image", "#previewDrugImage"));

    $("#brand").select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    })

    $("#drugType").select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    })

    $("#drugForm").select2({
      theme: "bootstrap-5",
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      placeholder: $(this).data('placeholder'),
    })
  </script>
@endpush
