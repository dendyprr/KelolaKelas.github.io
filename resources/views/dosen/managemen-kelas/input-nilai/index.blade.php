@extends('layouts.app')

@section('content')
<style>
    .full-width-content {
        padding-left: 10px !important;
        padding-right: 10px !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    .card {
        border-radius: 0; /* Opsional: kotak tanpa radius biar kelihatan lebih luas */
    }
</style>

    <div class="d-sm-flex align-items-center justify-content-between mb-4 px-2">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-graduation-cap mr-2 text-primary"></i>
            Input Nilai: {{ $kelas->nama_matakuliah }}
        </h1>
    </div>

    <form action="{{route('rekap-nilai-proccess', $kelas->id)}}" method="POST">
        @csrf
        <div class="card shadow mb-4 border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover m-0" width="100%" cellspacing="0">
                        {{-- HEADER CUSTOM DALAM TABEL --}}
                        <thead>
                            <tr class="bg-primary text-white">
                                <th colspan="8" class="py-3 px-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="h6 m-0 font-weight-bold">
                                            <i class="fas fa-list mr-2"></i> Daftar Mahasiswa & Komponen Nilai
                                        </div>
                                        <div class="d-flex" style="gap: 8px;">
                                            <a href="{{ route('detail-manajement-kelas', $kelas->id) }}" class="btn btn-sm btn-light text-primary shadow-sm font-weight-bold px-3">
                                                <i class="fas fa-chevron-left fa-sm mr-1"></i> Kembali
                                            </a>
                                            <a href="" class="btn btn-sm btn-success mr-2 shadow-sm">
                                                <i class="fa fa-file-excel mr-2"></i>
                                                Export Excel
                                            </a>
                                            <a href="" class="btn btn-sm btn-danger mr-2 shadow-sm">
                                                <i class="fa fa-file-pdf mr-2"></i>
                                                Export PDF
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm font-weight-bold px-3">
                                                <i class="fas fa-save fa-sm mr-1"></i> Simpan Semua Nilai
                                            </button>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            {{-- SUB-HEADER (KOLOM NILAI) --}}
                            <tr class="bg-gray-100 text-dark small font-weight-bold text-center text-uppercase">
                                <th width="40" class="align-middle">No</th>
                                <th class="align-middle text-left">Mahasiswa</th>
                                <th width="70" class="align-middle">Alpa</th> 
                                <th width="120" class="align-middle">Tugas (20%)</th>
                                <th width="120" class="align-middle">UTS (30%)</th>
                                <th width="120" class="align-middle">UAS (50%)</th>
                                <th width="120" class="bg-gray-200 align-middle">Nilai Akhir</th>
                                <th width="70" class="align-middle">Grade</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($mahasiswas as $index => $mhs)
                                <tr>
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-primary">{{ $mhs->user->nama ?? 'Tanpa Nama' }}</div>
                                        <small class="text-muted">{{ $mhs->user->nim ?? '-' }}</small>
                                    </td>
                                    
                                    <td class="text-center text-danger font-weight-bold align-middle">
                                        {{ $mhs->absensis->where('status', 'Alpa')->count() }}
                                    </td>

                                    <td class="p-2 align-middle">
                                        <input type="number" name="nilai_tugas[{{ $mhs->id }}]" class="form-control form-control-sm text-center font-weight-bold" value="{{ $mhs->nilai->tugas ?? 0 }}">
                                    </td>
                                    <td class="p-2 align-middle">
                                        <input type="number" name="nilai_uts[{{ $mhs->id }}]" class="form-control form-control-sm text-center font-weight-bold" value="{{ $mhs->nilai->uts ?? 0 }}">
                                    </td>
                                    <td class="p-2 align-middle">
                                        <input type="number" name="nilai_uas[{{ $mhs->id }}]" class="form-control form-control-sm text-center font-weight-bold" value="{{ $mhs->nilai->uas ?? 0 }}">
                                    </td>
                                    <td class="text-center font-weight-bold bg-gray-50 align-middle">
                                        {{ $mhs->nilai->nilai_akhir ?? 0 }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge {{ ($mhs->absensis->where('status', 'Alpa')->count() >= 3) ? 'badge-warning' : 'badge-primary' }} px-3 py-2">
                                            {{ $mhs->nilai->grade ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection