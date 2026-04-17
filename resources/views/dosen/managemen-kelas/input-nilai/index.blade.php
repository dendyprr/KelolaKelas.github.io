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

<div class="container-fluid full-width-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 px-2">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-graduation-cap mr-2 text-primary"></i>
            Input Nilai: {{ $kelas->nama_matakuliah }}
        </h1>
    </div>

    <form action="{{route('rekap-nilai-proccess', $kelas->id)}}" method="POST">
        @csrf
        <div class="card shadow mb-4 border-0"> <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa & Komponen Nilai</h6>
                
                <div class="d-flex" style="gap: 10px;">
                    <a href="{{ route('detail-manajement-kelas', $kelas->id) }}" class="btn btn-sm btn-secondary shadow-sm px-3 font-weight-bold">
                        <i class="fas fa-chevron-left fa-sm text-white-50"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary btn-icon-split shadow-sm font-weight-bold">
                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                        <span class="text">Simpan Semua Nilai</span>
                    </button>
                </div>
            </div>

            <div class="card-body px-1"> <div class="table-responsive">
                    <table class="table table-bordered table-hover m-0" width="100%" cellspacing="0">
                        <thead class="bg-gray-100 text-dark small font-weight-bold text-center text-uppercase">
                            <tr>
                                <th width="40">No</th>
                                <th>Mahasiswa</th>
                                <th width="70">Alpa</th> 
                                <th width="120">Tugas (20%)</th>
                                <th width="120">UTS (30%)</th>
                                <th width="120">UAS (50%)</th>
                                <th width="120" class="bg-gray-200">Nilai Akhir</th>
                                <th width="70">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswas as $index => $mhs)
                                <tr>
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold">{{ $mhs->user->nama ?? 'Tanpa Nama' }}</div>
                                    </td>
                                    
                                    <td class="text-center text-danger font-weight-bold align-middle">
                                        {{ $mhs->absensis->where('status', 'Alpa')->count() }}
                                    </td>

                                    <td>
                                        <input type="number" name="nilai_tugas[{{ $mhs->id }}]" class="form-control text-center" value="{{ $mhs->nilai->tugas ?? 0 }}">
                                    </td>
                                    <td>
                                        <input type="number" name="nilai_uts[{{ $mhs->id }}]" class="form-control text-center" value="{{ $mhs->nilai->uts ?? 0 }}">
                                    </td>
                                    <td>
                                        <input type="number" name="nilai_uas[{{ $mhs->id }}]" class="form-control text-center" value="{{ $mhs->nilai->uas ?? 0 }}">
                                    </td>
                                    <td class="text-center font-weight-bold bg-gray-100 align-middle">
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
</div>
@endsection