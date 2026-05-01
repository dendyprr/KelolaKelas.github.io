@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center mb-4">
        {{-- 1. Tombol Kembali (Paling Kiri) --}}
        <a href="{{ route('pengumuman') }}" class="btn btn-sm btn-white shadow-sm mr-3 border rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-arrow-left text-success"></i>
        </a>
        
        {{-- 2. Judul Halaman dengan Icon Bullhorn --}}
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold"> 
            <i class="fas fa-bullhorn mr-2 text-success"></i>
            {{ $title }} 
        </h1>
    </div>

    <div class="card shadow mb-4 border-left-success">
        <div class="card-body text-dark">
            <form action="{{ route('pengumuman.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Judul Pengumuman</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $item->judul) }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Isi Pengumuman</label>
                            <textarea name="isi" class="form-control" rows="12" required>{{ old('isi', $item->isi) }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="p-3 bg-light rounded border border-success">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold small">Target Audience</label>
                                <select name="target" class="form-control form-control-sm">
                                    <option value="0" {{ $item->target == 0 ? 'selected' : '' }}>Semua User</option>
                                    <option value="1" {{ $item->target == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $item->target == 2 ? 'selected' : '' }}>Dosen</option>
                                    <option value="3" {{ $item->target == 3 ? 'selected' : '' }}>Mahasiswa</option>
                                </select>
                            </div>

                            <div class="form-group mb-3 text-center">
                                <label class="font-weight-bold small d-block text-left">Lampiran Saat Ini</label>
                                @if($item->file)
                                    <span class="badge badge-info mb-2">{{ $item->file }}</span>
                                @else
                                    <span class="text-muted small italic d-block mb-2">Belum ada lampiran</span>
                                @endif
                                
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="fileEdit">
                                    <label class="custom-file-label" for="fileEdit">Ganti file (Opsional)</label>
                                </div>
                            </div>

                            <hr>

                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" name="is_urgent" class="custom-control-input" id="swEdit" value="1" {{ $item->is_urgent ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold text-danger" for="swEdit">Tandai Penting!</label>
                            </div>

                            <button type="submit" class="btn btn-success btn-block shadow-sm">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{route('pengumuman')}}" class="btn btn-secondary btn-block btn-sm mt-2">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection