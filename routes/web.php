<?php

use App\Models\RumputSiapJual;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RumputController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\SapiJualController;
use App\Http\Controllers\WastukanController;
use App\Http\Controllers\JenisSapiController;
use App\Http\Controllers\JenisLahanController;
use App\Http\Controllers\JenisRumputController;
use App\Http\Controllers\PembeliAuthController;
use App\Http\Controllers\JenisKandangController;
use App\Http\Controllers\KegiatanSapiController;
use App\Http\Controllers\RumputSiapJualController;
use App\Http\Controllers\KegiatanKandangController;
use App\Http\Controllers\DetailKandangSapiController;

// HOME
Route::get('/', [AuthController::class, 'home'])->name('home');
// LOGIN (PEGAWAI)
Route::get('login-pegawai', [AuthController::class, 'login'])->name('loginpegawai');
Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');
// LOGIN & DAFTAR (PEMBELI)
Route::get('daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('daftar', [AuthController::class, 'daftarsave'])->name('daftar.save');
Route::get('login-pembeli', [AuthController::class, 'loginpembeli'])->name('loginpembeli');
Route::post('login-post', [AuthController::class, 'loginPembeliAction'])->name('login.pembeli.action');
// PEMBELI
Route::middleware(['auth', 'checkPembeli'])->group(function () {
});
// ADMIN 
Route::middleware(['auth', 'checkAdmin'])->group(function () {
    Route::get('/admin/akun-pegawai', [AdminController::class, 'indexadmin'])->name('akunadmin');
    Route::get('/admin/akun-pegawai/{id}', [AkunController::class, 'detailakun'])->name('detailakun');
    Route::get('/admin/akun-pembeli', [AkunController::class, 'indexpembeli'])->name('akunpembeli');
    Route::get('/admin/akun-pembeli/{id}', [AkunController::class, 'detailakunpembeli'])->name('detailakunpembeli');
    Route::get('/admin/profil-admin/{id}', [AkunController::class, 'profiladmin'])->name('profiladmin');
    Route::get('/admin/akun/edit/{id}', [AkunController::class, 'edit'])->name('akunadmin.edit');
    Route::put('/admin/akun/update/{id}', [AkunController::class, 'update'])->name('akunadmin.update');
    Route::delete('/admin/akun/delete/{id}', [AkunController::class, 'delete'])->name('akunadmin.delete');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');
    //ADMIN - DAFTAR PEGAWAI
    Route::get('/admin/pegawai/daftar', [AuthController::class, 'pegawaidaftar'])->name('pegawaidaftar');
    Route::post('/admin/pegawai/daftar', [AuthController::class, 'pegawaidaftarsave'])->name('pegawaidaftar.save');
});
// KESWAN
Route::middleware(['auth', 'checkKeswan'])->group(function () {
    Route::get('/keswan', [SapiController::class, 'index'])->name('index.sapi');
    Route::get('/keswan/tambah', [SapiController::class, 'show'])->name('show.sapi');
    Route::post('/keswan/store', [SapiController::class, 'store'])->name('store.sapi');
    Route::get('/keswan/detail/{sapi_id}', [SapiController::class, 'detail'])->name('detail.sapi');
    Route::get('/keswan/print/{sapi_id}', [SapiController::class, 'printsapi'])->name('print.sapi');
    Route::get('/export-sapi', [SapiController::class, 'export'])->name('export.sapi');
    Route::get('/sapi/filter', [SapiController::class, 'filter'])->name('filter.sapi');
    Route::get('/keswan/edit/{sapi_id}', [SapiController::class, 'edit'])->name('edit.sapi');
    Route::put('/keswan/update/{sapi_id}', [SapiController::class, 'update'])->name('update.sapi');
    Route::delete('/keswan/delete/{sapi_id}', [SapiController::class, 'destroy'])->name('destroy.sapi');

    // KESWAN - DETAIL PROFIL
    Route::get('/keswan/list-pegawai', [AdminController::class, 'pegawaiKeswan'])->name('pegawai.keswan');
    Route::get('/keswan/detail-pegawai/{id}', [AdminController::class, 'detailPKeswan'])->name('detail.pegawai.keswan');
    Route::get('/keswan/profil/{id}', [AkunController::class, 'profilkeswan'])->name('profilkeswan');
});
//WASTUKAN 
Route::middleware(['auth', 'checkWastukan'])->group(function () {
    //WASTUKAN - DETAIL PROFIL
    Route::get('/wastukan/profil', [AkunController::class, 'profilwastukan'])->name('profilwastukan');
    // WASTUKAN RUMPUT
    Route::get('/wastukan/rumput', [RumputController::class, 'index'])->name('index.rumput');
    Route::get('/wastukan/tambah/rumput', [RumputController::class, 'show'])->name('show.rumput');
    Route::post('/wastukan/store/rumput', [RumputController::class, 'store'])->name('store.rumput');
    Route::get('/wastukan/rumput/detail/{rumput_id}', [RumputController::class, 'detail'])->name('detail.rumput');
    Route::put('/wastukan/rumput/update/{rumput_id}', [RumputController::class, 'update'])->name('update.rumput');
    Route::delete('/wastukan/rumput/delete/{rumput_id}', [RumputController::class, 'destroy'])->name('destroy.rumput');
    //WASTUKAN - JENIS RUMPUT
    Route::get('/wastukan/jenis_rumput', [JenisRumputController::class, 'index'])->name('index.jenis.rumput');
    Route::get('/wastukan/tambah/jenis_rumput', [JenisRumputController::class, 'show'])->name('show.jenis.rumput');
    Route::post('/wastukan/store/jenis_rumput', [JenisRumputController::class, 'store'])->name('store.jenis.rumput');
    Route::get('/wastukan/jenis_rumput/detail/{rum_id}', [JenisRumputController::class, 'detail'])->name('detail.jenis.rumput');
    Route::get('/wastukan/jenis_rumput/detail/edit/{rum_id}', [JenisRumputController::class, 'edit'])->name('edit.jenis.rumput');
    Route::put('/wastukan/jenis_rumput/update/{rum_id}', [JenisRumputController::class, 'update'])->name('update.jenis.rumput');
    Route::delete('/wastukan/jenis_rumput/delete/{rum_id}', [JenisRumputController::class, 'destroy'])->name('destroy.jenis.rumput');
    //WASTUKAN - JENIS LAHAN
    Route::get('/wastukan/jenis_lahan', [JenisLahanController::class, 'index'])->name('index.jenis.lahan');
    Route::get('/wastukan/tambah/jenis_lahan', [JenisLahanController::class, 'show'])->name('show.jenis.lahan');
    Route::post('/wastukan/store/jenis', [JenisLahanController::class, 'store'])->name('store.jenis.lahan');
    Route::get('/wastukan/jenis_lahan/detail/{lahan_id}', [JenisLahanController::class, 'detail'])->name('detail.jenis.lahan');
    Route::get('/wastukan/jenis_lahan/detail/edit/{lahan_id}', [JenisLahanController::class, 'edit'])->name('edit.jenis.lahan');
    Route::put('/wastukan/jenis_lahan/update/{lahan_id}', [JenisLahanController::class, 'update'])->name('update.jenis.lahan');
    Route::delete('/wastukan/jenis_lahan/delete/{lahan_id}', [JenisLahanController::class, 'destroy'])->name('destroy.jenis.lahan');
});
//WASBITNAK
Route::middleware(['auth', 'checkWasbitnak'])->group(function () {
    Route::get('/profil', [AkunController::class, 'profilwasbitnak'])->name('profilwasbitnak');
    //WASBITNAK - JENIS
    Route::get('/wasbitnak', [JenisSapiController::class, 'index'])->name('wasbitnak');
    //WASBITNAK - JENIS KANDANG
    Route::prefix('jenis_kandang')->group(function () {
        Route::get('/', [JenisKandangController::class, 'index'])->name('index.jenis.kandang');
        Route::get('/tambah', [JenisKandangController::class, 'show'])->name('show.jenis.kandang');
        Route::post('/store', [JenisKandangController::class, 'store'])->name('store.jenis.kandang');
        Route::get('/detail/{kandang_id}', [JenisKandangController::class, 'detail'])->name('detail.jenis.kandang');
        Route::get('/edit/{kandang_id}', [JenisKandangController::class, 'edit'])->name('edit.jenis.kandang');
        Route::put('/update/{kandang_id}', [JenisKandangController::class, 'update'])->name('update.jenis.kandang');
        Route::delete('/delete/{kandang_id}', [JenisKandangController::class, 'destroy'])->name('destroy.jenis.kandang');
    });
    //WASBITNAK - KANDANG
    Route::prefix('kandang')->group(function () {
        Route::get('/', [KandangController::class, 'index'])->name('index.kandang');
        Route::get('/tambah', [KandangController::class, 'show'])->name('show.kandang');
        Route::post('/store', [KandangController::class, 'store'])->name('store.kandang');
        Route::get('/filter', [KandangController::class, 'filter'])->name('filter.kandang');
        Route::get('/detail/{kandang_id}', [KandangController::class, 'detail'])->name('detail.kandang');
        Route::get('/edit/{kandang_id}', [KandangController::class, 'edit'])->name('edit.kandang');
        Route::put('/update/{kandang_id}', [KandangController::class, 'update'])->name('update.kandang');
        Route::delete('/delete/{kandang_id}', [KandangController::class, 'destroy'])->name('destroy.kandang');
    });

    // WASBITNAK - KEGIATAN KANDANG
    Route::prefix('kegiatan')->group(function () {
        Route::get('/', [KegiatanKandangController::class, 'index'])->name('index.kegiatan.kandang');
        Route::get('/tambah', [KegiatanKandangController::class, 'show'])->name('show.kegiatan.kandang');
        Route::post('/store', [KegiatanKandangController::class, 'store'])->name('store.kegiatan.kandang');
        Route::get('/detail/{kegiatan_id}', [KegiatanKandangController::class, 'detail'])->name('detail.kegiatan.kandang');
        Route::put('/edit/{kegiatan_id}', [KegiatanKandangController::class, 'update'])->name('update.kegiatan.kandang');
        Route::delete('/delete/{kegiatan_id}', [KegiatanKandangController::class, 'destroy'])->name('destroy.kegiatan.kandang');
        Route::get('/export-kegiatan-kandang', [KegiatanKandangController::class, 'export'])->name('export.kegiatan.kandang');
        Route::get('/filter-kegiatan-kandang', [KegiatanKandangController::class, 'filter'])->name('filter.kegiatan.kandang');
    });
    //WASBITNAK - JENIS SAPI
    Route::prefix('jenis_sapi')->group(function () {
        Route::get('/', [JenisSapiController::class, 'index'])->name('index.jenis.sapi');
        Route::get('/tambah', [JenisSapiController::class, 'show'])->name('show.jenis.sapi');
        Route::post('/store', [JenisSapiController::class, 'store'])->name('store.jenis.sapi');
        Route::get('/detail/{sjenis_id}', [JenisSapiController::class, 'detail'])->name('detail.jenis.sapi');
        Route::get('/edit/{sjenis_id}', [JenisSapiController::class, 'edit'])->name('edit.jenis.sapi');
        Route::put('/update/{sjenis_id}', [JenisSapiController::class, 'update'])->name('update.jenis.sapi');
        Route::delete('/delete/{sjenis_id}', [JenisSapiController::class, 'destroy'])->name('destroy.jenis.sapi');
    });
});
//PPID
Route::middleware(['auth', 'checkPPID'])->group(function () {
    Route::get('/ppid', [PPIDController::class, 'index'])->name('ppid');
    Route::get('/ppid/detail-profil', [AkunController::class, 'profilppid'])->name('ppid.profil');
    Route::prefix('/ppid/siap-jual')->group(function () {
        Route::get('/sapi', [PPIDController::class, 'indexsapi'])->name('ppid.sapi');
        Route::get('/rumput', [PPIDController::class, 'indexrumput'])->name('ppid.rumput');
    });
    Route::prefix('/ppid/pembeli')->group(function () {
        Route::get('/list-akun', [PPIDController::class, 'indexpembeli'])->name('ppid.list.pembeli');
    });
});
//BENDAHARA

//KEPALA

// lOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//403
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
// PENDING

Route::get('/export', [AkunController::class, 'export']);
