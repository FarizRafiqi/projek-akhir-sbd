@extends('layouts.admin')

@section('title', 'Admin Panel Mediclo | Dashboard')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i>
      Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Jumlah Pelanggan -->
    @can('user_access')
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                  Pelanggan
                </div>
                <div class="h5 mb-0 fw-bold text-gray-800">
                  0
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endcan

    <!-- Obat Terjual -->
    @can('drug_access')
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs fw-bold text-success text-uppercase mb-1">
                  Obat Terjual (Bulanan)
                </div>
                <div class="h5 mb-0 fw-bold text-gray-800">
                  0
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-capsules fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endcan

    <!-- Pendapatan Bulanan -->
    @can('purchase_access')
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs fw-bold text-success text-uppercase mb-1">
                  Pendapatan (Bulanan)
                </div>
                <div class="h5 mb-0 fw-bold text-gray-800">
                  IDR 0
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endcan

    <!-- Kategori Obat -->
    @can('drug_type_access')
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col me-2">
                <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                  Kategori Obat
                </div>
                <div class="h5 mb-0 fw-bold text-gray-800">
                  0
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-book-medical fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endcan
  </div>
@endsection
