@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus-circle mr-2 text-primary"></i> {{ $title }} 
        </h1>
    </div>

    <div class="row d-flex flex-column flex-lg-row">
        <div class="col-lg-4 order-1 order-lg-2">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h5 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-2"></i>Informasi</h5>
                    <p class="small text-muted">
                        Pastikan <strong>Kode Kelas</strong> unik dan belum digunakan oleh kelas lain. Data yang Anda simpan akan otomatis terhubung dengan akun Anda sebagai Dosen Pengampu.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-2 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Data Kelas</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('tambah-manajement-kelas')}}" method="POST" class="p-3" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark">Kode Kelas</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-qrcode"></i></span>
                                    </div>
                                    <input type="text" name="kode_kelas" class="form-control" placeholder="INF-A1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Nama Mata Kuliah</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" placeholder="Masukkan Nama Matkul" value="{{old('nama_matakuliah')}}">
                                </div>
                                @error('nama_matakuliah')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Periode</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-redo-alt"></i></span>
                                    </div>
                                    <select name="periode" class="form-control @error('hari') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Periode...</option>
                                        <option>Ganjil</option>
                                        <option>Genap</option>
                                    </select>
                                </div>
                                @error('periode')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Tahun Ajaran</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-check"></i></span>
                                    </div>
                                    <input type="number" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" placeholder="Contoh: 2023/2024">
                                </div>
                                @error('tahun_ajaran')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Semester</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-layer-group"></i></span>
                                    </div>
                                    <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" placeholder="Contoh: 3" min="1" max="14">
                                </div>
                                @error('semester')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"> Jumlah SKS</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-award"></i></span>
                                    </div>
                                    <input type="number" name="jumlah_sks" class="form-control" placeholder="Contoh: 3" min="1" max="6">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Hari</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-day"></i></span>
                                    </div>
                                    <select name="hari" class="form-control @error('hari') is-invalid @enderror">
                                        <option value="" selected disabled>Pilih Hari...</option>
                                        <option>Senin</option><option>Selasa</option><option>Rabu</option>
                                        <option>Kamis</option><option>Jumat</option><option>Sabtu</option>
                                    </select>
                                </div>
                                @error('hari')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark">Ruangan</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-door-open"></i></span>
                                    </div>
                                    <input type="text" name="ruangan" class="form-control" placeholder="Contoh: Lab 1 / R.302">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Jam Mulai</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror">
                                </div>
                                @error('jam_mulai')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Jam Selesai</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-hourglass-end"></i></span>
                                    </div>
                                    <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror">
                                </div>
                                @error('jam_selesai')
                                    <small class="text-danger font-weight-bold">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{route('manajement-kelas')}}" class="btn btn-secondary btn-block shadow-sm">
                                    Kembali
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary btn-block shadow-sm">
                                    <i class="fas fa-save mr-2"></i> Simpan Jadwal Kelas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection