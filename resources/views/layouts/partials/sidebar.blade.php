<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIAKAD PRO</div>
    </a>

    <hr class="sidebar-divider my-0">

    @if(Auth::user()->role_id == 1)
        <li class="nav-item {{ $activeDashboard ?? '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Perkuliahan</div>

        <li class="nav-item {{ $activeManagemen ?? '' }}">
            <a class="nav-link" href="{{ route('manajement-kelas') }}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Manajement Kelas</span>
            </a>
        </li>

        <li class="nav-item {{ $activeJadwal ?? '' }}">
            <a class="nav-link" href="{{ route('jadwal-ngajar') }}">
                <i class="fas fa-fw fa-calendar-check"></i>
                <span>Jadwal Ngajar</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Akademik</div>

        <li class="nav-item {{ $activePresensiQRCode ?? '' }}">
            <a class="nav-link" href="{{ route('pertemuan-presensi-maintenance') }}">
                <i class="fas fa-fw fa-qrcode"></i>
                <span>Absensi QrCode</span>
            </a>
        </li>

        {{-- <li class="nav-item {{ $activeRekapNilai ?? '' }}">
            <a class="nav-link" href="{{ route('rekap-nilai-maintenance') }}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Rekap Nilai</span>
            </a>
        </li>

        <li class="nav-item {{ $activeMateriTugas ?? '' }}">
            <a class="nav-link" href="{{ route('tugass-materi') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Tugas Dan Materi</span>
            </a>
        </li> --}}

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Informasi & Laporan</div>

        <li class="nav-item {{ $activePengumuman ?? '' }}">
            <a class="nav-link" href="{{ route('pengumuman') }}">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>Pengumuman</span>
            </a>
        </li>

        <li class="nav-item {{ $activeLaporanPresensi ?? '' }}">
            <a class="nav-link" href="{{ route('laporan-presensi') }}">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Laporan Presensi</span>
            </a>
        </li>

        {{-- Khusus Admin Sistem --}}
        @if(Auth::user()->role_id == 1)
            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">Sistem</div>
            <li class="nav-item {{ $activeManagemenUser ?? '' }}">
                <a class="nav-link" href="{{ route('manajement-user-index') }}">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Manajemen User</span>
                </a>
            </li>
        @endif
    @endif

    @if(Auth::user()->role_id == 3)
        {{-- Dashboard --}}
        <li class="nav-item {{ $activeDashboard ?? '' }}">
            <a class="nav-link" href="{{route('dashboard-mahasiswa')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Akademik</div>

        {{-- KRS Online --}}
        <li class="nav-item {{ $activeKRS ?? '' }}">
            <a class="nav-link" href="{{route('KRS-maintenance')}}">
                <i class="fas fa-fw fa-book"></i>
                <span>KRS Online</span>
            </a>
        </li>

        {{-- Kelas Saya --}}
        <li class="nav-item {{ $activeKelasSaya ?? '' }}">
            <a class="nav-link" href="{{route('kelas-saya-maintenance')}}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Kelas Saya</span>
            </a>
        </li>

        {{-- Absensi QR --}}
        <li class="nav-item {{ $activeAbsen ?? '' }}">
            <a class="nav-link" href="{{route('absen-maintenance')}}">
                <i class="fas fa-fw fa-qrcode"></i>
                <span>Absensi QrCode</span>
            </a>
        </li>

        {{-- Tugas & Materi --}}
        <li class="nav-item {{ $activeTugasDanMateri ?? '' }}">
            <a class="nav-link" href="{{route('tugas-materi-maintenance')}}">
                <i class="fas fa-fw fa-tasks"></i>
                <span>Materi Dan Tugas</span>
            </a>
        </li>

        {{-- Nilai --}}
        <li class="nav-item {{ $activeNilai ?? '' }}">
            <a class="nav-link" href="{{route('nilai-maintenance')}}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Nilai</span>
            </a>
        </li>

        {{-- Pengumuman --}}
        <li class="nav-item {{ $activePengumuman ?? '' }}">
            <a class="nav-link" href="{{route('pengumuman-mahasiswa-index')}}">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>Pengumuman</span>
            </a>
        </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

{{-- @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
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
                <span>Kelas Saya</span>
            </a>
        </li>

        <li class="nav-item {{$activeJadwal ?? ''}}">
            <a class="nav-link" href="{{route('jadwal-ngajar')}}">
                <i class="fas fa-fw fa-calendar-check"></i>
                <span>Jadwal Kuliah</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">Akademik</div>

        <li class="nav-item {{$activePresensiQRCode ?? ''}}">
            <a class="nav-link" href="{{route('pertemuan-presensi-maintenance')}}">
                <i class="fas fa-fw fa-qrcode"></i>
                <span>AbsensiQrCode</span>
            </a>
        </li>

        <li class="nav-item {{$activeRekapNilai ?? ''}}">
            <a class="nav-link" href="{{route('rekap-nilai-maintenance')}}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Tugas Prioritas</span>
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
@endif --}}