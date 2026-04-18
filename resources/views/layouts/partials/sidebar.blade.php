<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIAKAD PRO</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{$activeDashboard ?? ''}}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Perkuliahan</div>

    <li class="nav-item {{$activeManagemen ?? ''}}">
        <a class="nav-link" href="{{route('manajement-kelas')}}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Manajemen Kelas</span>
        </a>
    </li>

    <li class="nav-item {{$activeJadwal ?? ''}}">
        <a class="nav-link" href="{{route('jadwal-ngajar')}}">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Jadwal Mengajar</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Akademik</div>

    <li class="nav-item {{$activePresensiQRCode ?? ''}}">
        <a class="nav-link" href="{{route('pertemuan-presensi-maintenance')}}">
            <i class="fas fa-fw fa-qrcode"></i>
            <span>Presensi QR Code</span>
        </a>
    </li>

    <li class="nav-item {{$activeRekapNilai ?? ''}}">
        <a class="nav-link" href="{{route('rekap-nilai-maintenance')}}">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Rekap Nilai</span>
        </a>
    </li>

    <li class="nav-item {{$activeMateriTugas ?? ''}}">
        <a class="nav-link" href="{{route('tugass-materi')}}">
            <i class="fas fa-fw fa-book-open"></i>
            <span>Materi & Tugas</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Informasi & Laporan</div>

    <li class="nav-item {{$activePengumuman ?? ''}}">
        <a class="nav-link" href="{{route('pengumuman')}}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengumuman</span>
        </a>
    </li>

    <li class="nav-item {{$activeLaporanPresensi ?? ''}}">
        <a class="nav-link" href="{{route('laporan-presensi')}}">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Laporan Presensi</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Sistem
    </div>

    <li class="nav-item {{$activeManagemenUser ?? ''}}">
        <a class="nav-link collapsed" href="{{route('manajement-user-index')}}">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Manajemen User</span>
        </a>
    </li>
    
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>