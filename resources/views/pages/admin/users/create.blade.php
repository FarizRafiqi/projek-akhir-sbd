@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
            class="text-decoration-none text-reset">Daftar User</a></li>
        <li class="breadcrumb-item active">Tambah User</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gy-3">
              <div class="col-md-3 col-12 text-md-start text-center">
                <img src="{{ asset('img/no-img.jpg') }}" class="img-thumbnail" alt="" width="240"
                  id="previewUserImage">
              </div>
              <div class="col-md-9 col-12">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                      <label for="name" class="form-label">Nama</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Masukkan nama pengguna">
                      @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="role" class="form-label">Peran</label>
                      <select class="form-select @error('role_id') is-invalid @enderror" id="role" name="role_id">
                        <option selected disabled>Pilih Peran</option>
                        @foreach ($roles as $role)
                          @if ($role->id > 1)
                            <option value="{{ $role->id }}" {{ $role->id == old('role_id') ? 'selected' : '' }}>
                              {{ $role->name }}
                            </option>
                          @endif
                        @endforeach
                      </select>
                      @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="phone_num" class="form-label">No. Telepon</label>
                      <input type="text" class="form-control @error('phone_num') is-invalid @enderror" id="phone_num"
                        name="phone_num" value="{{ old('phone_num') }}" placeholder="Masukkan nomor telepon">
                      @error('phone_num')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-3">
                      <label for="sex" class="form-label">Jenis Kelamin</label>
                      <div class="form-control ps-0 border-0 bg-transparent">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="sex" id="male" value="male" {{ old("sex") == "male" ? "checked" : "" }}>
                          <label class="form-check-label" for="male">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="sex" id="female" value="female" {{ old("sex") == "female" ? "checked" : "" }}>
                          <label class="form-check-label" for="female">Perempuan</label>
                        </div>
                      </div>
                      @error('sex')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Masukkan password">
                      @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar</label>
                  <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="address" class="form-label">Alamat</label>
                  <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30" rows="5"
                    placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-12 text-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Batal</a>
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

    $("#image").on("change", () => previewImg("#image", "#previewUserImage"));
  </script>
@endpush
