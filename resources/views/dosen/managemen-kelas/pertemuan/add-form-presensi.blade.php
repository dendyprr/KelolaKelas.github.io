@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-clipboard-check mr-2 text-primary"></i> Presensi Ke-{{ $pertemuan->pertemuan_ke }}
        </h1>
    </div>

    <form action="{{ route('pertemuan-presensi-update', $pertemuan->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

        {{-- Detail Materi --}}
        <div class="card shadow mb-4 border-left-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold small text-uppercase text-dark">Materi Pertemuan</label>
                        <input type="text" name="materi" class="form-control font-weight-bold" value="{{ $pertemuan->materi }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="font-weight-bold small text-uppercase text-dark">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $pertemuan->tanggal }}" required>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="font-weight-bold small text-uppercase text-danger">Catatan / Info Tugas</label>
                        <textarea name="catatan" class="form-control" rows="1" placeholder="Contoh: Tugas kumpulkan di pertemuan depan">{{ $pertemuan->catatan }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik Singkat --}}
        <div class="row">
            @php
                $stats = [
                    ['l' => 'Hadir', 'v' => $absensi->where('status', 'Hadir')->count(), 'c' => 'success', 'i' => 'user-check'],
                    ['l' => 'Sakit', 'v' => $absensi->where('status', 'Sakit')->count(), 'c' => 'info', 'i' => 'medkit'],
                    ['l' => 'Izin', 'v' => $absensi->where('status', 'Izin')->count(), 'c' => 'warning', 'i' => 'envelope'],
                    ['l' => 'Alpa', 'v' => $absensi->where('status', 'Alpa')->count(), 'c' => 'danger', 'i' => 'user-times'],
                ];
            @endphp
            @foreach($stats as $s)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{{ $s['c'] }} shadow-sm py-2">
                    <div class="card-body py-1">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-{{ $s['c'] }} text-uppercase mb-1">{{ $s['l'] }}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $s['v'] }}</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-{{ $s['i'] }} fa-lg text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="bg-gray-100 text-dark small font-weight-bold text-center">
                            <tr>
                                <th width="50">No</th>
                                <th>Mahasiswa (NIM)</th>
                                <th width="120">Nilai Tugas</th>
                                <th width="280">Status Kehadiran</th>
                                <th>Keterangan Tambahan</th>
                            </tr>
                        </thead>       
                        <tbody>
                            @foreach($absensi as $index => $row)
                                <tr class="small text-dark">
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="align-middle"> 
                                        <div class="font-weight-bold text-primary text-uppercase">{{ $row->mahasiswa->user->nama ?? 'N/A' }}</div>
                                        <div class="text-muted small">{{ $row->mahasiswa->nim }}</div>
                                        <input type="hidden" name="absen_id[]" value="{{ $row->id }}">
                                    </td>
                                    <td class="align-middle">
                                        <input type="number" name="nilai_tugas[{{ $row->id }}]" 
                                               class="form-control form-control-sm text-center font-weight-bold border-primary" 
                                               value="{{ $row->nilai_tugas ?? 0 }}" min="0" max="100">
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-around px-2">
                                            @foreach(['Hadir' => 'success', 'Sakit' => 'info', 'Izin' => 'warning', 'Alpa' => 'danger'] as $st => $cl)
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="{{ substr($st,0,1) }}_{{ $row->id }}" name="status[{{ $row->id }}]" value="{{ $st }}" class="custom-control-input" {{ $row->status == $st ? 'checked' : '' }}>
                                                    <label class="custom-control-label text-{{ $cl }} font-weight-bold" for="{{ substr($st,0,1) }}_{{ $row->id }}">
                                                        {{ substr($st,0,1) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <input type="text" name="keterangan[{{ $row->id }}]" class="form-control form-control-sm" value="{{ $row->keterangan }}" placeholder="...">
                                    </td>
                                </tr>
                            @endforeach          
                        </tbody>
                    </table>         
                </div>

                <div class="d-flex justify-content-end mt-4" style="gap: 10px;">
                    <a href="{{ route('pertemuan-presensi-index', $pertemuan->kelas_id) }}" class="btn btn-secondary px-4 shadow-sm">Batal</a>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm font-weight-bold">
                        <i class="fas fa-save mr-2"></i> Simpan Data Pertemuan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection