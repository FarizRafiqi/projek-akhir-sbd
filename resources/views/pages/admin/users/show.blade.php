@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <nav
      style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Manajemen User</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"
            class="text-decoration-none text-reset">Daftar User</a></li>
        <li class="breadcrumb-item active">Detail User {{ $user->id }}</li>
      </ol>
    </nav>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-3 col-12 text-center text-md-start">
              <img
                src="{{ $user->image ? Storage::url('/img/avatar/' . $user->id . '/' . $user->image) : asset('img/no-img.jpg') }}"
                class="img-thumbnail" alt="{{ $user->name }}" width="300" height="300">
            </div>
            <div class="col-9">
              <dl class="row">
                <div class="col-3">
                  <dt>Nama</dt>
                  <dd>{{ $user->name }}</dd>
                  <dt>Peran</dt>
                  <dd>{{ $user->role->name }}</dd>
                  <dt>Email</dt>
                  <dd>{{ $user->email }}</dd>
                  <dt>No. Telepon</dt>
                  <dd>{{ $user->phone_num }}</dd>
                  <dt>Jenis Kelamin</dt>
                  <dd>{{ $user->sex == 'male' ? 'L' : 'P' }}</dd>
                </div>
                <div class="col-9">
                  <dt>Alamat</dt>
                  <dd>{{ $user->address ?? '-' }}</dd>
                  <dt>Bergabung Pada</dt>
                  <dd>
                    @if ($user->created_at)
                      {{ $user->created_at->locale('id')->dayName . $user->created_at->format(', d ') . $user->created_at->locale('id')->monthName . date(' Y') }}
                    @else
                      -
                    @endif
                  </dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
