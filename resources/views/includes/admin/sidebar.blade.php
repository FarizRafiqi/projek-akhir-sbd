<!-- Sidebar -->
<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('img/mediclo-logo.png') }}" alt="Mediclo Logo" class="img-fluid" width="180">
    </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->
  <div class="sidebar-heading">Main Navigation</div>

  <!-- Nav Item - Menu Obat -->
  @can('drug_access')
    <li class="nav-item {{ Route::is('admin.drugs.*') ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#collapseTwo" data-bs-toggle="collapse">
        <i class="fas fa-fw fa-pills"></i>
        <span>Obat</span>
      </a>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded accordion-body">
          {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
          <a class="collapse-item" href="{{ route('admin.drugs.index') }}">Daftar Obat</a>
          <a class="collapse-item" href="#">Kategori Obat</a>
          <a class="collapse-item" href="#">Bentuk Obat</a>
        </div>
      </div>
    </li>
  @endcan

  <!-- Nav Item - Menu Brand -->
  @can('brand_access')
    <li class="nav-item {{ Route::is('admin.brands.*') ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-trademark"></i>
        <span>Merek</span>
      </a>
    </li>
  @endcan

  <!-- Nav Item - Menu Pembelian Obat -->
  @can('purchase_access')
    <li class="nav-item {{ Route::is('admin.purchases.*') ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#">
        <i class="fas fa-fw fa-shopping-bag"></i>
        <span>Pembelian Obat</span>
      </a>
    </li>
  @endcan

  <!-- Nav Item - Menu Manajemen User -->
  @can('user_access')
    <li class="nav-item {{ Route::is('admin.users.*') ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#manajemenUser">
        <i class="fas fa-fw fa-users-cog"></i>
        <span>Manajemen User</span>
      </a>
      <div id="manajemenUser" class="collapse" data-bs-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="#">User</a>
          <a class="collapse-item" href="#">Hak Akses</a>
          <a class="collapse-item" href="#">Peran</a>
          <a class="collapse-item" href="#">Log Aktivitas</a>
        </div>
      </div>
    </li>
  @endcan

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block" />

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->
