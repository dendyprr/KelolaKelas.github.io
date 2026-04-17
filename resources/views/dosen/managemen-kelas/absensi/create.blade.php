@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-users mr-2 text-primary"></i>
        Manajemen Mahasiswa & Presensi
    </h1>

    <div class="card shadow mb-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="bg-primary p-2 rounded-top">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#" class="text-white">Data Mahasiswa</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Presensi & Daftar</li>
            </ol>
        </nav>
        
        <div class="card-header py-3 bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Filter & Pencarian</h6>
                <span class="badge badge-dark">Pertemuan Ke: 1 ({{ date('d M Y') }})</span>
            </div>
            <hr>
            <form action="#" method="GET" class="mb-0">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label small font-weight-bold">Cari Nama/NIM</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Contoh: Budi...">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label small font-weight-bold">Status Kehadiran Hari Ini</label>
                        <select class="form-control form-control-sm">
                            <option value="">Semua</option>
                            <option value="H">Sudah Absen</option>
                            <option value="B">Belum Absen</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="button" class="btn btn-info btn-sm mr-2 shadow-sm"><i class="fa fa-filter mr-1"></i> Filter</button>
                        <a href="#" class="btn btn-secondary btn-sm shadow-sm"><i class="fa fa-undo mr-1"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('detail-manajement-kelas', $kelas_id) }}" class="btn btn-sm btn-light border shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <div>
                    <button class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-check-double mr-1"></i> Absen Semua Hadir</button>
                    <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus mr-1"></i> Tambah Mahasiswa
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr class="text-center small font-weight-bold">
                            <th width="50">No</th>
                            <th>Info Mahasiswa</th>
                            <th width="250">Presensi Hari Ini (Klik Status)</th>
                            <th width="100">Status</th>
                            <th><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>       
                    <tbody>
                        {{-- Mahasiswa 1 --}}
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-primary">Budi Setiadi</div>
                                <div class="small text-muted">NIM: 20240001 | L</div>
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group btn-group-toggle shadow-sm">
                                    <label class="btn btn-outline-success btn-sm active" title="Hadir">
                                        <input type="radio" name="p1" checked> H
                                    </label>
                                    <label class="btn btn-outline-warning btn-sm" title="Izin">
                                        <input type="radio" name="p1"> I
                                    </label>
                                    <label class="btn btn-outline-info btn-sm" title="Sakit">
                                        <input type="radio" name="p1"> S
                                    </label>
                                    <label class="btn btn-outline-danger btn-sm" title="Alpa">
                                        <input type="radio" name="p1"> A
                                    </label>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <span class="badge badge-success px-3">Aktif</span>
                            </td>
                            <td class="text-center align-middle">
                                <button class="btn btn-light btn-sm border"><i class="fas fa-edit text-warning"></i></button>
                                <button class="btn btn-light btn-sm border"><i class="fas fa-trash text-danger"></i></button>
                            </td>
                        </tr>

                        {{-- Mahasiswa 2 --}}
                        <tr>
                            <td class="text-center align-middle">2</td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-primary">Siti Aminah</div>
                                <div class="small text-muted">NIM: 20240002 | P</div>
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group btn-group-toggle shadow-sm">
                                    <label class="btn btn-outline-success btn-sm" title="Hadir">
                                        <input type="radio" name="p2"> H
                                    </label>
                                    <label class="btn btn-outline-warning btn-sm active" title="Izin">
                                        <input type="radio" name="p2" checked> I
                                    </label>
                                    <label class="btn btn-outline-info btn-sm" title="Sakit">
                                        <input type="radio" name="p2"> S
                                    </label>
                                    <label class="btn btn-outline-danger btn-sm" title="Alpa">
                                        <input type="radio" name="p2"> A
                                    </label>
                                </div>
                            </td>
                            <td class="text-center align-middle">
                                <span class="badge badge-success px-3">Aktif</span>
                            </td>
                            <td class="text-center align-middle">
                                <button class="btn btn-light btn-sm border"><i class="fas fa-edit text-warning"></i></button>
                                <button class="btn btn-light btn-sm border"><i class="fas fa-trash text-danger"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>         
            </div>
        </div>
        <div class="card-footer bg-white border-top-0">
             <button class="btn btn-primary btn-block shadow-sm py-2 font-weight-bold">
                <i class="fas fa-save mr-2"></i> SIMPAN SEMUA PERUBAHAN PRESENSI
             </button>
        </div>
    </div>
@endsection