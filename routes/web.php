<?php

use App\Models\RumputSiapJual;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RumputController;
use App\Http\Controllers\SapiJualController;
use App\Http\Controllers\WastukanController;
use App\Http\Controllers\JenisLahanController;
use App\Http\Controllers\JenisRumputController;
use App\Http\Controllers\PembeliAuthController;
use App\Http\Controllers\JenisKandangController;
use App\Http\Controllers\JenisSapiController;
use App\Http\Controllers\KegiatanSapiController;
use App\Http\Controllers\RumputSiapJualController;
use App\Http\Controllers\KegiatanKandangController;

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
    Route::get('/keswan', [SapiController::class, 'show'])->name('keswan');
    Route::get('/keswan/form', [SapiController::class, 'create'])->name('formcreate');
    Route::post('/keswan/submit', [SapiController::class, 'store'])->name('formsapi');
    Route::get('/keswan/detail/{id}', [SapiController::class, 'detailsapi'])->name('detailsapi');
    Route::get('/keswan/print/{id}', [SapiController::class, 'printsapi'])->name('printsapi');
    Route::get('/keswan/edit/{id}', [SapiController::class, 'edit'])->name('editsapi');
    Route::put('/keswan/update/{id}', [SapiController::class, 'update'])->name('updatesapi');
    Route::delete('/keswan/delete/{id}', [SapiController::class, 'deletesapi'])->name('deletesapi');



    // KESWAN - DETAIL PROFIL
    Route::get('/keswan/list-pegawai', [AdminController::class, 'pegawaiKeswan'])->name('pegawai.keswan');
    Route::get('/keswan/detail-pegawai/{id}', [AdminController::class, 'detailPKeswan'])->name('detail.pegawai.keswan');
    Route::get('/keswan/profil/{id}', [AkunController::class, 'profilkeswan'])->name('profilkeswan');
});
//WASTUKAN 
Route::middleware(['auth', 'checkWastukan'])->group(function () {
    Route::get('/wastukan', [WastukanController::class, 'index'])->name('wastukan');
    Route::get('/wastukan/logbook', [WastukanController::class, 'tambahlogbook'])->name('tambahlogbook');
    Route::post('/wastukan/store', [WastukanController::class, 'storelogbook'])->name('storelogbook');
    Route::get('/wastukan/logbook/detail/{id}', [WastukanController::class, 'detailwastukan'])->name('detailwastukan');
    Route::delete('/wastukan/delete/{id}', [WastukanController::class, 'deletewastukan'])->name('deletewastukan');
    Route::get('/wastukan/logbook/detail/edit/{id}', [WastukanController::class, 'editwastukan'])->name('editwastukan');
    Route::put('/wastukan/logbook/detail/update/{id}', [WastukanController::class, 'updatewastukan'])->name('updatewastukan');
    // WASTUKAN - RUMPUT SIAP 
    Route::get('/wastukan/rumput-siap-jual', [RumputSiapJualController::class, 'index'])->name('indexrumputsiap');
    Route::get('/rumput-siap-jual/create', [RumputSiapJualController::class, 'create'])->name('siapjual.create');
    Route::post('/rumput-siap-jual/store', [RumputSiapJualController::class, 'store'])->name('siapjual.store');
    Route::delete('/rumput-siap-jual/delete/{id}', [RumputSiapJualController::class, 'delete'])->name('deleterumputsiap');
    Route::get('/rumput-siap-jual/edit/{id}', [RumputSiapJualController::class, 'edit'])->name('editsiap');
    Route::put('/rumput-siap-jual/update/{id}', [RumputSiapJualController::class, 'update'])->name('updatesiap');
    //WASTUKAN - DETAIL PROFIL
    Route::get('/wastukan/profil', [AkunController::class, 'profilwastukan'])->name('profilwastukan');
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
    Route::get('/wasbitnak', [JenisKandangController::class, 'index'])->name('wasbitnak');
    Route::prefix('jenis')->group(function () {
        Route::get('/tambah', [JenisKandangController::class, 'create'])->name('tambah.jenis.kandang');
        Route::post('/store', [JenisKandangController::class, 'store'])->name('post.jenis.kandang');
        Route::get('/edit/{id}', [JenisKandangController::class, 'edit'])->name('edit.jenis.kandang');
        Route::put('/update/{id}', [JenisKandangController::class, 'update'])->name('update.jenis.kandang');
        Route::delete('/delete/{id}', [JenisKandangController::class, 'delete'])->name('deletejeniskandang');
    });
    // WASBITNAK - KEGIATAN KANDANG
    Route::prefix('kegiatan')->group(function () {
        Route::get('/', [KegiatanKandangController::class, 'index'])->name('indexkegiatankandang');
        Route::get('/tambah', [KegiatanKandangController::class, 'create'])->name('tambah.jenis.kegiatan');
        Route::post('/store', [KegiatanKandangController::class, 'store'])->name('post.jenis.kegiatan');
        Route::delete('/delete/{id}', [KegiatanKandangController::class, 'delete'])->name('deletekegiatankandang');
        Route::get('/edit/{id_kegiatan}', [KegiatanKandangController::class, 'edit'])->name('editkegiatankandang');
        Route::put('/update/{id_kegiatan}', [KegiatanKandangController::class, 'update'])->name('updatekegiatankandang');
        Route::get('/detail/{id_kegiatan}', [KegiatanKandangController::class, 'detail'])->name('detailkegiatan');
        //KEGIATAN SAPI
        Route::delete('/{id_kegiatan}/sapi/{id_sapi}', [KegiatanKandangController::class, 'hapusSapi'])->name('hapusSapi');
        Route::get('/tambah/{id_kegiatan}', [KegiatanSapiController::class, 'getsapi'])->name('getSapi');
        Route::post('/store/{id_kegiatan}', [KegiatanSapiController::class, 'tambahSapi'])->name('tambahSapi');
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

    //WASBITNAK - SAPI SIAP JUAL
    Route::prefix('sapi-jual')->group(function () {
        Route::get('/', [SapiJualController::class, 'index'])->name('sapi-jual.index');
        Route::get('/create', [SapiJualController::class, 'create'])->name('sapi-jual.create');
        Route::post('/', [SapiJualController::class, 'store'])->name('sapi-jual.store');
        Route::get('/{id}/edit', [SapiJualController::class, 'edit'])->name('sapi-jual.edit');
        Route::put('/{id}', [SapiJualController::class, 'update'])->name('sapi-jual.update');
        Route::delete('/{id}', [SapiJualController::class, 'destroy'])->name('sapi-jual.destroy');
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
