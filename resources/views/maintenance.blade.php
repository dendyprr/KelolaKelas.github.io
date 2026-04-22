@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 

        {{-- dosen --}}
        {{-- 1. Logika Icon --}}
        @if(Route::is('dashboard') || Route::is('dashboard-mahasiswa'))
            <i class="fas fa-fw fa-tachometer-alt text-primary"></i>

        {{-- Halaman yang dipakai bersama atau mirip --}}
        @elseif(Route::is('jadwal-ngajar') || Route::is('mahasiswa-jadwal')) 
            <i class="fas fa-fw fa-calendar-check text-primary"></i>
        
        @elseif(Route::is('tugass-materi') || Route::is('mahasiswa-tugas'))
            <i class="fas fa-fw fa-book-open text-primary"></i>

        // dosen absen qr
        @elseif(Route::is('pertemuan-presensi-maintenance') )
            <i class="fas fa-fw fa-qrcode text-primary"></i>

        @elseif(Route::is('mahasiswa-nilai'))
            <i class="fas fa-fw fa-graduation-cap text-primary"></i>


        {{-- mahasiswa --}}

        {{-- Halaman KHUSUS Mahasiswa (Contoh: KRS atau Nilai) --}}
        @elseif(Route::is('KRS-maintenance'))
            <i class="fas fa-fw fa-book text-primary"></i>

        {{-- kelas saya --}}
        @elseif(Route::is('kelas-saya-maintenance'))
           <i class="fas fa-fw fa-chalkboard-teacher text-primary"></i>

        @elseif(Route::is('absen-maintenance'))
            <i class="fas fa-fw fa-qrcode text-primary"></i>

        {{-- materi dan tugas --}}
        @elseif(Route::is('tugas-materi-maintenance'))
            <i class="fas fa-fw fa-tasks text-primary"></i>

        {{-- nilai --}}
        @elseif(Route::is('nilai-maintenance'))
            <i class="fas fa-fw fa-graduation-cap text-primary"></i>

        {{-- pengumuman --}}
        @elseif(Route::is('pengumuman-maintenance'))
            <i class="fas fa-fw fa-bullhorn text-primary"></i>
        
        {{-- Halaman Profile & Settings (Biasanya sama untuk semua role) --}}
        @elseif(Route::is('profile-profile'))
            <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i> 
        @elseif(Route::is('profile-settings'))
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-primary"></i>

        @else
            {{-- Icon default jika route tidak terdaftar --}}
            <i class="fas fa-fw fa-circle-info text-primary"></i>
        @endif

        {{-- 2. Judul Halaman (Variabel dari Controller) --}}
        {{ $title }} 
    </h1>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    
                    <div class="animation-container">
                        <div class="gear-background"></div>
                        <i class="fas fa-tools main-icon"></i>
                        <div class="dot dot-1"></div>
                        <div class="dot dot-2"></div>
                        <div class="dot dot-3"></div>
                    </div>

                    <h1 class="display-4 font-weight-bold text-gray-800">Oops!</h1>
                    <h2 class="h4 text-primary mb-3">Website Sedang Dalam Perbaikan</h2>
                    <p class="text-muted mx-auto" style="max-width: 500px;">
                        Kami sedang melakukan pemeliharaan sistem rutin untuk meningkatkan layanan kami. 
                        Mohon maaf atas ketidaknyamanannya. Kami akan segera kembali online!
                    </p>
                    
                    <a href="javascript:location.reload();" class="btn btn-primary btn-icon-split mt-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync-alt"></i>
                        </span>
                        <span class="text">Coba Segarkan Halaman</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection