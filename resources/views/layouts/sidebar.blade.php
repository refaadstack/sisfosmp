<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('assets/img/logo.png') }}" style="width: 40px; height: 40px" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">  SIAKAD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    {{-- start admin --}}
    @if(auth()->user()->role == 'admin')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengumuman</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Buat Pengumuman</h6>
                <a class="collapse-item" href="/pengumuman">Buat Pengumuman</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
  
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data</h6>
                <a class="collapse-item" href="{{ route('siswa.index') }}">Siswa</a>
                <a class="collapse-item" href="{{ route('guru.index') }}">Guru</a>
                <a class="collapse-item" href="#">Mata Pelajaran</a>
                <a class="collapse-item" href="#">Jurusan</a>
                <a class="collapse-item" href="{{ route('kelas.index') }}">Kelas</a>
            </div>
        </div>
    </li>
    @endif
    {{-- endadmin --}}
    {{-- start siswa --}}
    @if(auth()->user()->role == 'siswa')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-graduation-cap"></i>
            <span>Nilai</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Mata Pelajaran:</h6>
                <a class="collapse-item" href="#">Matematika</a>
                <a class="collapse-item" href="#">IPA</a>
                <a class="collapse-item" href="#">IPS</a>
                <a class="collapse-item" href="#">Other</a>
            </div>
        </div>
    </li>
    @endif

    {{-- end siswa --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>