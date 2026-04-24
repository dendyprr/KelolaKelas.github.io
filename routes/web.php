<?php

// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dosen\AnggotaGroupController;
use App\Http\Controllers\dosen\DashboardController;
use App\Http\Controllers\dosen\JadwalNgajarController;
use App\Http\Controllers\dosen\LaporanPresensiController;
use App\Http\Controllers\dosen\ManagemenKelasController;
use App\Http\Controllers\dosen\ManagementUserController;
use App\Http\Controllers\dosen\MateriTugasController;
use App\Http\Controllers\dosen\PengumumanController;
use App\Http\Controllers\dosen\PertemuanPresensiController;
use App\Http\Controllers\dosen\RekapNilaiController;
use App\Http\Controllers\mahasiswa\AbsensiMahasiswaController;
use App\Http\Controllers\mahasiswa\DashboardMahasiswaController;
use App\Http\Controllers\mahasiswa\KelasSayaMahasiswaController;
use App\Http\Controllers\mahasiswa\KrsMahasiswaController;
use App\Http\Controllers\mahasiswa\MateriTugasMahasiswaController;
use App\Http\Controllers\mahasiswa\NilaiMahasiswaController;
use App\Http\Controllers\mahasiswa\PengumumanMahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('cekLogin')->group(function() {
    
    Route::middleware('role_id:1')->prefix('dosen')->group(function () {
        
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

        Route::prefix('jadwal-ngajar')->group(function () {
            Route::get('/', [JadwalNgajarController::class, 'index'])->name('jadwal-ngajar');
            Route::get('/add/jadwal-ngajar', [JadwalNgajarController::class, 'add'])->name('add-jadwal-ngajar');
            Route::get('/detail/{id}/jadwal-ngajar', [JadwalNgajarController::class, 'detailKelas'])->name('detail-jadwal-ngajar');
            Route::post('/addProccess/jadwal-ngajar', [JadwalNgajarController::class, 'addProccess'])->name('tambah-jadwal-ngajar');
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

    });
    
    Route::middleware('role_id:3')->prefix('mahasiswa')->group(function () {
        
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardMahasiswaController::class, 'maintenance'])->name('dashboard-mahasiswa');
        });
        
        Route::prefix('KRS')->group(function () {
            Route::get('/', [KrsMahasiswaController::class, 'maintenance'])->name('KRS-maintenance');
        });
        
        Route::prefix('kelas-saya')->group(function () {
            Route::get('/', [KelasSayaMahasiswaController::class, 'maintenance'])->name('kelas-saya-maintenance');
        });
        
        Route::prefix('absen')->group(function () {
            Route::get('/', [AbsensiMahasiswaController::class, 'maintenance'])->name('absen-maintenance');
        });
        
        Route::prefix('tugas-materi')->group(function () {
            Route::get('/', [MateriTugasMahasiswaController::class, 'maintenance'])->name('tugas-materi-maintenance');
        });
        
        Route::prefix('nilai')->group(function () {
            Route::get('/', [NilaiMahasiswaController::class, 'maintenance'])->name('nilai-maintenance');
        });
        
        Route::prefix('pengumuman')->group(function () {
            Route::get('/', [PengumumanMahasiswaController::class, 'maintenance'])->name('pengumuman-maintenance');
        });
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile-profile');
        Route::get('/edit/{id}/profile', [ProfileController::class, 'edit'])->name('profile-edit');
        Route::put('/edit-proccess/{id}/profile', [ProfileController::class, 'updateProfile'])->name('profile-edit-proccess');
    });
    
    Route::prefix('pengaturan')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('pengaturan-settings');
        Route::put('/update-password', [SettingsController::class, 'updatePassword'])->name('pengaturan-update-password');
    });
    
    
});

   

Route::get('/login', [AuthController::class, 'index'])->name('auth-login');
Route::post('/login-proccess', [AuthController::class, 'loginProccess'])->name('auth-login-proccess');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth-logout');