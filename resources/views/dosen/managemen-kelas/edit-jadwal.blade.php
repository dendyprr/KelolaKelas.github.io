@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit mr-2 text-success"></i> {{ $title }} 
        </h1>
    </div>

    {{-- Pesan Sukses Setelah Hapus --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row d-flex flex-column flex-lg-row">
         {{-- Sidebar Info --}}
        <div class="col-lg-4 order-1 order-lg-2">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h5 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-2"></i>Mode Ubah</h5>
                    <p class="small text-muted">
                        Anda sedang mengubah data kelas <strong>{{ $data->nama_matakuliah }}</strong>. Pastikan semua perubahan sudah sesuai sebelum menekan tombol update.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-8 order-2 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Formulir Ubah Data Kelas</h6>
                </div>
                <div class="card-body">
                    {{-- Gunakan method PUT untuk proses Update --}}
                    <form action="{{route('ubah-jadwal-proccess-manajement-kelas', $data->id)}}" method="POST" class="p-3">
                        @csrf
                        @method('PUT')

                        <div class="row">
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark">Kode Kelas</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-qrcode"></i></span>
                                    </div>
                                    <input type="text" name="kode_kelas" class="form-control" value="{{ old('kode_kelas', $data->kode_kelas) }}">
                                </div>
                            </div>
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Nama Mata Kuliah</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror" value="{{ old('nama_matakuliah', $data->nama_matakuliah) }}">
                                </div>
                                @error('nama_matakuliah')
                                    <small class="text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Periode</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-redo-alt"></i></span>
                                    </div>
                                    <select name="periode" class="form-control @error('periode') is-invalid @enderror">
                                        <option value="Ganjil" {{ old('periode', $data->periode) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                        <option value="Genap" {{ old('periode', $data->periode) == 'Genap' ? 'selected' : '' }}>Genap</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Tahun Ajaran</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-calendar-check"></i></span>
                                    </div>
                                    {{-- Pakai type text agar input 2023/2024 tidak error --}}
                                    <input type="number" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $data->tahun_ajaran) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Semester</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-layer-group"></i></span>
                                    </div>
                                    <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester', $data->semester) }}" min="1">
                                </div>
                            </div>
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"> Jumlah SKS</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-award"></i></span>
                                    </div>
                                    <input type="number" name="jumlah_sks" class="form-control" value="{{ old('jumlah_sks', $data->jumlah_sks) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Hari</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-calendar-day"></i></span>
                                    </div>
                                    <select name="hari" class="form-control @error('hari') is-invalid @enderror">
                                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                                            <option value="{{ $h }}" {{ old('hari', $data->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark">Ruangan</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-door-open"></i></span>
                                    </div>
                                    <input type="text" name="ruangan" class="form-control" value="{{ old('ruangan', $data->ruangan) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Jam Mulai</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-clock"></i></span>
                                    </div>
                                    {{-- Format H:i diperlukan agar input time HTML bisa membaca data --}}
                                    <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', date('H:i', strtotime($data->jam_mulai))) }}">
                                </div>
                            </div>
                             <div class="col-12 col-md-6 mb-3 mb-md-3">
                                <label class="font-weight-bold text-dark"><span class="text-danger">*</span> Jam Selesai</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-hourglass-end"></i></span>
                                    </div>
                                    <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', date('H:i', strtotime($data->jam_selesai))) }}">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('detail-manajement-kelas', $data->id) }}" class="btn btn-secondary btn-block shadow-sm">
                                    Batal
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-success btn-block shadow-sm font-weight-bold">
                                    <i class="fas fa-save mr-2"></i> Update Jadwal Kelas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection