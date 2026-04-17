@extends('layouts.app')

@section('content')
<style>
    .full-width-container { padding: 0 !important; margin: 0 !important; width: 100% !important; max-width: 100% !important; }
    .pulse { animation: pulse-animation 2s infinite; }
    @keyframes pulse-animation { 0% { opacity: 1; } 50% { opacity: 0.6; } 100% { opacity: 1; } }
    .card-meeting:hover { background-color: #f8f9fc; transform: translateX(5px); transition: 0.3s; }
</style>

<div class="container-fluid full-width-container">
    <div class="px-4">
        <h1 class="h3 mb-4 text-gray-800 font-weight-bold"> 
            <i class="fas fa-list-ol mr-2 text-primary"></i> Log Pertemuan Kuliah
        </h1>
    </div>

    {{-- Info Kelas --}}
    <div class="card shadow-sm mb-4 border-0 rounded-0 border-bottom-primary">
        <div class="card-body px-4 py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 font-weight-bold text-gray-800 mb-1">{{ $kelas->nama_matakuliah }}</h2>
                    <div class="text-muted small">
                        <span class="badge badge-primary px-2 mr-2">{{ $kelas->kode_kelas }}</span>
                        <i class="fas fa-calendar-day mr-1"></i> {{ $kelas->hari }} | 
                        <i class="fas fa-clock mr-1 ml-2"></i> {{ $kelas->jam_mulai }} - {{ $kelas->jam_selesai }}
                    </div>
                </div>
                <div class="text-right d-none d-md-block">
                    <span class="small text-muted font-weight-bold uppercase">Total Pertemuan</span>
                    <div class="h4 font-weight-bold text-primary mb-0">{{ $pertemuans->count() }} / 14</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="px-4 d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0 font-weight-bold text-dark text-uppercase"><i class="fas fa-stream mr-1"></i> Daftar Riwayat</h6>
        <div class="d-flex align-items-center" style="gap: 10px;">
            <a href="{{ route('detail-manajement-kelas', $kelas_id) }}" class="btn btn-sm btn-secondary shadow-sm font-weight-bold px-3">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button class="btn btn-sm btn-primary shadow-sm font-weight-bold px-3" data-toggle="modal" data-target="#modalTambahPertemuan">
                <i class="fas fa-plus mr-1"></i> Pertemuan Baru
            </button>
        </div>
    </div>

    {{-- List Pertemuan --}}
    <div class="row no-gutters">
        @forelse ($pertemuans as $p)
            @php
                $tgl = \Carbon\Carbon::parse($p->tanggal);
                $isToday = $tgl->isToday();
                $isPast = $tgl->isPast() && !$isToday;
            @endphp
            <div class="col-12 mb-2">
                <div class="card card-meeting shadow-sm rounded-0 border-left-{{ $isToday ? 'primary' : ($isPast ? 'success' : 'secondary') }} border-right-0">
                    <div class="card-body py-3 px-4">
                        <div class="row align-items-center"> 
                            {{-- Nomor --}}
                            <div class="col-md-1 border-right text-center d-none d-md-block">
                                <div class="text-xs font-weight-bold text-muted text-uppercase">Pert.</div>
                                <div class="h4 font-weight-bold text-gray-800 mb-0">{{ $p->pertemuan_ke }}</div>
                            </div>

                            {{-- Tanggal --}}
                            <div class="col-md-2 border-right text-center d-none d-md-block">
                                <div class="small font-weight-bold text-dark text-uppercase">{{ $tgl->translatedFormat('l') }}</div>
                                <div class="small text-muted">{{ $tgl->translatedFormat('d M Y') }}</div>
                            </div>

                            {{-- Materi --}}
                            <div class="col-md-6 px-md-4">
                                <h6 class="font-weight-bold text-primary mb-1 text-uppercase">
                                    {{ $p->materi ?? 'Materi Belum Diisi' }}
                                </h6>
                                @if($p->catatan)
                                    <div class="small text-danger font-italic mb-1">
                                        <i class="fas fa-sticky-note mr-1 small"></i> {{ $p->catatan }}
                                    </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    <div class="small mr-3">
                                        @if($isToday)
                                            <span class="text-primary font-weight-bold pulse small"><i class="fas fa-circle mr-1"></i> Berlangsung</span>
                                        @else
                                            <span class="text-muted small"><i class="fas fa-check-double mr-1 small"></i> {{ $isPast ? 'Selesai' : 'Mendatang' }}</span>
                                        @endif
                                    </div>
                                    <span class="badge badge-light border text-dark font-weight-normal small">
                                        <i class="fas fa-users mr-1 text-primary"></i> 
                                        {{-- <strong>{{ $p->hadir_count ?? 0 }}</strong> Mahasiswa Hadir --}}
                                        <strong>{{ $p->hadir_count ?? 0 }}</strong> / {{ $p->total_mhs ?? 0 }} Mahasiswa Hadir
                                    </span>
                                </div>
                            </div>

                            {{-- Button --}}
                            <div class="col-md-3 ml-auto"> 
                                <a href="{{ route('pertemuan-presensi-form', $p->id) }}" 
                                class="btn {{ $isToday ? 'btn-primary' : 'btn-outline-dark' }} btn-block btn-sm shadow-sm font-weight-bold py-2">
                                    <i class="fas fa-edit mr-2"></i> Kelola Presensi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 px-4"><div class="alert alert-info text-center py-5 shadow-sm">Belum ada jadwal pertemuan kuliah.</div></div>
        @endforelse
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalTambahPertemuan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">Tambah Pertemuan</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('pertemuan-presensi-proccess', $kelas_id) }}" method="POST">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="font-weight-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Materi Kuliah</label>
                        <textarea name="materi" class="form-control" rows="3" placeholder="Masukkan materi pembahasan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block shadow font-weight-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection