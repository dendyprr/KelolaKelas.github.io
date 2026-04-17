@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('detail-manajement-kelas', $kelas_id) }}" class="btn btn-sm btn-light border mr-3 shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Daftar Pertemuan</h1>
        </div>
        <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus fa-sm mr-1"></i> Pertemuan Baru
        </button>
    </div>

    <div class="row">
        {{-- Looping Card Pertemuan --}}
        @forelse ($pertemuans as $p)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 {{ $p->tanggal == date('Y-m-d') ? 'border-left-primary' : '' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="rounded-circle {{ $p->tanggal == date('Y-m-d') ? 'bg-primary' : 'bg-success' }} text-white d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                <small class="font-weight-bold">{{ $p->pertemuan_ke }}</small>
                            </div>
                            @if($p->tanggal == date('Y-m-d'))
                                <span class="badge badge-primary pulse">Hari Ini</span>
                            @else
                                <span class="badge badge-light border text-success">Selesai</span>
                            @endif
                        </div>

                        <h5 class="font-weight-bold text-gray-800 mb-0">Pertemuan {{ $p->pertemuan_ke }}</h5>
                        <p class="text-muted small mb-3 italic">{{ $p->materi ?? 'Tanpa Materi' }}</p>
                        
                        <div class="text-xs font-weight-bold text-uppercase text-muted mb-3">
                            <i class="fas fa-calendar-day mr-1"></i> {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        
                        {{-- Link ke Halaman Absensi Mahasiswa --}}
                        <a href="{{ route('mahasiswa-index', ['kelas_id' => $kelas_id, 'pertemuan_id' => $p->id]) }}" 
                           class="btn {{ $p->tanggal == date('Y-m-d') ? 'btn-primary' : 'btn-outline-success' }} btn-sm btn-block shadow-sm font-weight-bold">
                            <i class="fas fa-user-check mr-1"></i> {{ $p->tanggal == date('Y-m-d') ? 'Mulai Absen' : 'Lihat Rekap' }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-gray-500 italic">Belum ada pertemuan yang dibuat.</p>
            </div>
        @endforelse

        {{-- Card Tambah Cepat --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 border-dashed d-flex align-items-center justify-content-center" 
                 style="border: 2px dashed #d1d3e2; background: transparent; cursor: pointer;"
                 data-toggle="modal" data-target="#modalTambah">
                <div class="text-center py-4">
                    <i class="fas fa-plus-circle fa-2x text-gray-300 mb-2"></i>
                    <div class="text-gray-500 small font-weight-bold">Tambah Pertemuan</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pertemuan.store', $kelas_id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">Tambah Pertemuan</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small font-weight-bold text-dark">Tanggal Pertemuan</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold text-dark">Topik / Materi</label>
                        <input type="text" name="materi" class="form-control" placeholder="Contoh: Pengenalan Middleware">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm" type="submit">Buat Pertemuan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.border-dashed { border-style: dashed !important; }
.pulse { animation: pulse-red 2s infinite; }
@keyframes pulse-red {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}
</style>
@endsection