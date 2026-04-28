@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-bullhorn mr-2 text-primary"></i>
        {{ $title }} 
    </h1>

    <div class="card shadow mb-4">
        {{-- Breadcrumb Navigation --}}
        <nav aria-label="breadcrumb" class="bg-primary p-2 rounded-top">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{route('pengumuman')}}" class="text-white">Pengumuman</a></li>
                <li class="breadcrumb-item text-white font-weight-bold" aria-current="page" >{{ $title }} </li>
            </ol>
        </nav>

        <div class="card-body text-dark">
            {{-- Pastikan ada enctype untuk upload file --}}
            <form action="{{route('pengumuman-tambah-proccess')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                                   placeholder="Contoh: Pengumuman Jadwal KRS Susulan" value="{{ old('judul') }}">
                            @error('judul')
                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                            <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" 
                                      rows="10" placeholder="Tuliskan informasi lengkap di sini...">{{ old('isi') }}</textarea>
                            @error('isi')
                                <small class="text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="p-3 bg-light rounded border">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold small">Target Audience <span class="text-danger">*</span></label>
                                <select name="target" class="form-control form-control-sm">
                                    <option value="0">Semua User</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Dosen</option>
                                    <option value="3">Mahasiswa</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold small">Lampiran File (PDF/Gambar)</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="filePengumuman">
                                    <label class="custom-file-label" for="filePengumuman">Pilih file...</label>
                                </div>
                                <small class="text-muted small d-block mt-1">Format: PDF, JPG, PNG (Maks 2MB)</small>
                            </div>

                            <hr>

                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" name="is_urgent" class="custom-control-input" id="urgentSwitch" value="1" {{ old('is_urgent') ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-bold text-danger" for="urgentSwitch">Tandai sebagai Penting!</label>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-block shadow-sm">
                                    <i class="fas fa-paper-plane mr-1"></i> Simpan & Publish
                                </button>
                                <a href="{{route('pengumuman')}}" class="btn btn-secondary btn-block btn-sm mt-2">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Agar nama file yang dipilih muncul di input label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush