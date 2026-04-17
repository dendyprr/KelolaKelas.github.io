<?php

// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dosen\AnggotaGroupController;
use App\Http\Controllers\dosen\DashboardController;
use App\Http\Controllers\dosen\InputNilaiController;
use App\Http\Controllers\dosen\JadwalNgajarController;
use App\Http\Controllers\dosen\LaporanPresensiController;
use App\Http\Controllers\dosen\ManagemenKelasController;
use App\Http\Controllers\dosen\ManagementSiswaController;
use App\Http\Controllers\dosen\ManagementUserController;
use App\Http\Controllers\dosen\MasterController;
use App\Http\Controllers\dosen\MateriTugasController;
use App\Http\Controllers\dosen\MaterTugasController;
use App\Http\Controllers\dosen\PengumumanController;
use App\Http\Controllers\dosen\PertemuanPresensiController;
use App\Http\Controllers\dosen\RekapNilaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [MasterController::class, 'index'])->name('home');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
    
    Route::prefix('pengumuman')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman');
    });
    
    Route::prefix('laporan-presensi')->group(function () {
        Route::get('/', [LaporanPresensiController::class, 'index'])->name('laporan-presensi');
    });

    Route::prefix('tugas-materi')->group(function () {
        Route::get('/', [MateriTugasController::class, 'index'])->name('tugass-materi');
    });

    Route::prefix('manajement-kelas')->group(function () {
        Route::get('/', [ManagemenKelasController::class, 'index'])->name('manajement-kelas');
        Route::get('/{id}/detail', [ManagemenKelasController::class, 'detailKelas'])->name('detail-manajement-kelas');
        Route::get('/add', [ManagemenKelasController::class, 'add'])->name('add-manajement-kelas');
        Route::post('/addProccess', [ManagemenKelasController::class, 'addProccess'])->name('tambah-manajement-kelas');
        Route::delete('/{id}/hapus', [ManagemenKelasController::class, 'hapusKelas'])->name('hapus-manajement-kelas');
        Route::get('/reset', [ManagemenKelasController::class, 'resetFilter'])->name('reset-filter-kelas');

        Route::get('/{id}/ubah-jadwal', [ManagemenKelasController::class, 'ubahJadwal'])->name('ubah-jadwal-manajement-kelas');
        Route::put('/{id}/ubah-jadwal-proccess', [ManagemenKelasController::class, 'ubahJadwalProccess'])->name('ubah-jadwal-proccess-manajement-kelas');
    });

    Route::prefix('pertemuan-presensi')->group(function () {
        Route::get('/{id}/', [PertemuanPresensiController::class, 'index'])->name('pertemuan-presensi-index');
        Route::post('/{id}/store', [PertemuanPresensiController::class, 'addProccess'])->name('pertemuan-presensi-proccess');
        Route::get('/{id}/presensi', [PertemuanPresensiController::class, 'addFormPresensi'])->name('pertemuan-presensi-form');
        Route::put('/{id}/update', [PertemuanPresensiController::class, 'updatePresensi'])->name('pertemuan-presensi-update');
        Route::get('/', [PertemuanPresensiController::class, 'maintenance'])->name('pertemuan-presensi-maintenance');
    });

    Route::prefix('anggota-group')->group(function () {
        Route::get('/{id}/', [AnggotaGroupController::class, 'index'])->name('anggota-group-index');
        Route::post('{id}/proccess', [AnggotaGroupController::class, 'addProccess'])->name('anggota-group-proccess');
        Route::delete('/{id}/hapus', [AnggotaGroupController::class, 'destroy'])->name('anggota-group-hapus-absen-mahasiswa');
        Route::put('/{id}/update', [AnggotaGroupController::class, 'editProccess'])->name('anggota-group-edit-mahasiswa');
    });
    
    Route::prefix('rekap-nilai')->group(function () {
        Route::get('/{id}/', [RekapNilaiController::class, 'index'])->name('rekap-nilai-index');
        Route::post('/{id}/proccess', [RekapNilaiController::class, 'addProccess'])->name('rekap-nilai-proccess');
        Route::get('/', [RekapNilaiController::class, 'maintenance'])->name('rekap-nilai-maintenance');
    });

    Route::prefix('manajement-user')->group(function () {
        Route::get('/', [ManagementUserController::class, 'index'])->name('manajement-user-index');
        Route::post('/proccess', [ManagementUserController::class, 'addProccess'])->name('manajement-user-proccess');
        Route::delete('/{id}/hapus', [ManagementUserController::class, 'hapus'])->name('manajement-user-hapus-user');
        Route::put('/{id}/update', [ManagementUserController::class, 'editProccess'])->name('manajement-user-edit-user');
    });



Route::get('/jadwal-ngajar', [JadwalNgajarController::class, 'index'])->name('jadwal-ngajar');
Route::get('/add/jadwal-ngajar', [JadwalNgajarController::class, 'add'])->name('add-jadwal-ngajar');
Route::get('/detail/{id}/jadwal-ngajar', [JadwalNgajarController::class, 'detailKelas'])->name('detail-jadwal-ngajar');
Route::post('/addProccess/jadwal-ngajar', [JadwalNgajarController::class, 'addProccess'])->name('tambah-jadwal-ngajar');