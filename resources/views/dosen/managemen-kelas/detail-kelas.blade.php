@extends('layouts.app')

@section('content')
    @php
        $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
        $currentColor = $colors[$data->id % count($colors)];
    @endphp

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('manajement-kelas', ['filter_periode' => $filter_periode, 'filter_tahun' => $filter_tahun]) }}" class="btn btn-sm btn-light border mr-2 shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            {{ $title }}
        </h1>
        <div class="badge text-white bg-{{ $currentColor }} px-3 py-2 shadow-sm mt-3">
            <i class="fas fa-calendar-alt mr-1"></i> TA {{ $data->tahun_ajaran }}
        </div>
    </div>

    <div class="row">
        {{-- Kiri: Informasi Perkuliahan --}}
        <div class="col-xl-4 col-lg-5">
            {{-- Tambahkan cursor pointer dan onclik di card utama --}}
            <div class="card shadow mb-4 border-0 clickable-card" 
                onclick="window.location='{{ route('ubah-jadwal-manajement-kelas', $data->id) }}'" 
                style="cursor: pointer; transition: transform 0.2s ease-in-out;"
                onmouseover="this.style.transform='scale(1.02)';" 
                onmouseout="this.style.transform='scale(1)';"
                title="Klik untuk ubah jadwal">
                
                <div class="card-header py-3 bg-{{ $currentColor }} border-0 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-info-circle mr-2"></i>Informasi Perkuliahan</h6>
                    <i class="fas fa-edit text-white-50 small"></i> {{-- Icon pensil kecil di pojok --}}
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="icon-circle bg-{{ $currentColor }} text-white mb-3 shadow" style="width: 70px; height: 70px; font-size: 30px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;">
                            <i class="fas fa-university"></i>
                        </div>
                        <h4 class="font-weight-bold text-gray-800 mb-0">{{ $data->nama_matakuliah }}</h4>
                        <span class="badge badge-light text-white border bg-{{ $currentColor }} mt-2">{{ $data->kode_kelas }}</span>
                    </div>

                    <ul class="list-group list-group-flush">
                        {{-- Setiap list-group-item --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            <span class="text-muted"><i class="fas fa-calendar-day fa-fw mr-2"></i>Hari</span>
                            <span class="font-weight-bold text-dark">{{ $data->hari }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            <span class="text-muted"><i class="fas fa-clock fa-fw mr-2"></i>Waktu</span>
                            <span class="font-weight-bold text-dark">{{ date('H:i', strtotime($data->jam_mulai)) }} - {{ date('H:i', strtotime($data->jam_selesai)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            <span class="text-muted"><i class="fas fa-door-open fa-fw mr-2"></i>Ruangan</span>
                            <span class="font-weight-bold text-dark">{{ $data->ruangan ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            <span class="text-muted"><i class="fas fa-layer-group fa-fw mr-2"></i>Semester / SKS</span>
                            <span class="font-weight-bold text-dark">{{ $data->semester }} / {{ $data->jumlah_sks }} SKS</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent border-bottom-0">
                            <span class="text-muted"><i class="fas fa-redo-alt fa-fw mr-2"></i>Periode</span>
                            <span class="badge text-white bg-{{ $currentColor }}">{{ $data->periode }}</span>
                        </li>
                    </ul>

                    {{-- Tambahkan petunjuk kecil di bawah --}}
                    <hr class="my-2">
                    <div class="text-center">
                        <small class="text-primary font-italic"> Klik untuk ubah jadwal</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kanan: Menu Navigasi (Grid) --}}
        <div class="col-xl-8 col-lg-7">
            <div class="row text-center">          
                {{-- CARD 1: Anggota Kelas --}}
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-info shadow h-100 py-4 btn-light clickable-card" onclick="window.location='{{ route('anggota-group-index', $data->id) }}'" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x text-info mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Anggota Kelas</h5>
                            <p class="small text-muted px-3">Daftarkan mahasiswa ke dalam kelas ini untuk pertama kali.</p>
                            <a href="{{ route('anggota-group-index', $data->id) }}" class="btn btn-info btn-sm px-4 shadow-sm font-weight-bold">Kelola Mahasiswa</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: Presensi Mahasiswa --}}
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow h-100 py-4 btn-light clickable-card" onclick="window.location='{{ route('pertemuan-presensi-index', $data->id) }}'" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-user-check fa-3x text-primary mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Presensi & Log</h5>
                            <p class="small text-muted px-3">Buka absensi pertemuan harian dan rekap kehadiran.</p>
                            <a href="{{ route('pertemuan-presensi-index', $data->id) }}" class="btn btn-primary btn-sm px-4 shadow-sm font-weight-bold">Buka Absen</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 3: Nilai --}}
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-warning shadow h-100 py-4 btn-light clickable-card" onclick="window.location='#'" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-file-invoice fa-3x text-warning mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Rekap Nilai</h5>
                            <p class="small text-muted px-3">Lihat dan olah akumulasi nilai tugas, UTS, hingga UAS mahasiswa.</p>
                            <a href="{{route('rekap-nilai-index', $data->id)}}" class="btn btn-warning btn-sm px-4 shadow-sm font-weight-bold text-white">Lihat Nilai</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 4: Materi & Tugas --}}
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-success shadow h-100 py-4 btn-light clickable-card" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-file-upload fa-3x text-success mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Materi & Tugas</h5>
                            <p class="small text-muted px-3">Upload modul perkuliahan dan kumpulkan tugas mahasiswa.</p>
                            <a href="#" class="btn btn-success btn-sm px-4 shadow-sm font-weight-bold">Kelola Materi</a>
                        </div>
                    </div>
                </div>

                {{-- CARD 4: Edit Jadwal (Pindah ke sini, tetap merah) --}}
                {{-- <div class="col-md-6 mb-4">
                    <div class="card border-bottom-danger shadow h-100 py-4 btn-light clickable-card" onclick="window.location='{{ route('ubah-jadwal-manajement-kelas', $data->id) }}'" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-edit fa-3x text-danger mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Ubah Jadwal</h5>
                            <p class="small text-muted px-3">Ubah detail ruangan atau waktu jika terjadi perubahan.</p>
                            <a href="{{ route('ubah-jadwal-manajement-kelas', $data->id) }}" class="btn btn-danger btn-sm px-4 shadow-sm font-weight-bold">Ubah Jadwal</a>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .clickable-card {
        transition: all 0.3s ease;
        border: none;
    }
    .clickable-card:hover {
        transform: translateY(-8px);
        background-color: #ffffff !important;
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.15) !important;
    }
    .icon-circle {
        transition: all 0.3s ease;
    }
    .clickable-card:hover .icon-circle {
        transform: scale(1.1);
    }
</style>
@endsection