@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <a href="{{ route('jadwal-ngajar') }}" class="btn btn-sm btn-light border mr-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $title }}
        </h1>
        <div class="badge badge-primary px-3 py-2 shadow-sm">
            <i class="fas fa-calendar-alt mr-1"></i> TA {{ $data->tahun_ajaran }}
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-info-circle mr-2"></i>Informasi Perkuliahan</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="icon-circle bg-primary text-white mb-3" style="width: 70px; height: 70px; font-size: 30px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;">
                            <i class="fas fa-university"></i>
                        </div>
                        <h4 class="font-weight-bold text-gray-800 mb-0">{{ $data->nama_matakuliah }}</h4>
                        <span class="badge badge-light border text-primary">{{ $data->kode_kelas }}</span>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted"><i class="fas fa-calendar-day fa-fw mr-2"></i>Hari</span>
                            <span class="font-weight-bold text-dark">{{ $data->hari }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted"><i class="fas fa-clock fa-fw mr-2"></i>Waktu</span>
                            <span class="font-weight-bold text-dark">{{ date('H:i', strtotime($data->jam_mulai)) }} - {{ date('H:i', strtotime($data->jam_selesai)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted"><i class="fas fa-door-open fa-fw mr-2"></i>Ruangan</span>
                            <span class="font-weight-bold text-dark">{{ $data->ruangan ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted"><i class="fas fa-layer-group fa-fw mr-2"></i>Semester / SKS</span>
                            <span class="font-weight-bold text-dark">{{ $data->semester }} / {{ $data->jumlah_sks }} SKS</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted"><i class="fas fa-redo-alt fa-fw mr-2"></i>Periode</span>
                            <span class="badge badge-info">{{ $data->periode }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow h-100 py-4 btn-light clickable-card" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-user-check fa-3x text-primary mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Presensi Mahasiswa</h5>
                            <p class="small text-muted">Kelola daftar hadir mahasiswa setiap pertemuan.</p>
                            <a href="#" class="btn btn-primary btn-sm px-4 shadow-sm">Buka Absen</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-success shadow h-100 py-4 btn-light clickable-card" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-file-upload fa-3x text-success mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Materi & Tugas</h5>
                            <p class="small text-muted">Upload modul perkuliahan dan kumpulkan tugas mahasiswa.</p>
                            <a href="#" class="btn btn-success btn-sm px-4 shadow-sm">Kelola Materi</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-warning shadow h-100 py-4 btn-light clickable-card" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-star fa-3x text-warning mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Input Nilai</h5>
                            <p class="small text-muted">Input nilai UTS, UAS, dan Tugas harian mahasiswa.</p>
                            <a href="#" class="btn btn-warning btn-sm px-4 shadow-sm text-white">Buka Nilai</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-danger shadow h-100 py-4 btn-light clickable-card" style="cursor: pointer;">
                        <div class="card-body">
                            <i class="fas fa-edit fa-3x text-danger mb-3"></i>
                            <h5 class="font-weight-bold text-gray-800">Edit Jadwal</h5>
                            <p class="small text-muted">Ubah detail ruangan atau waktu jika terjadi perubahan.</p>
                            <a href="#" class="btn btn-danger btn-sm px-4 shadow-sm">Ubah Jadwal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .clickable-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        background-color: #f8f9fc !important;
    }
</style>
@endsection