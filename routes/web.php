<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RumputController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\SapiJualController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\JenisSapiController;
use App\Http\Controllers\JenisLahanController;
use App\Http\Controllers\JenisRumputController;
use App\Http\Controllers\KepalaBalaiController;
use App\Http\Controllers\JenisKandangController;
use App\Http\Controllers\KegiatanLahanController;
use App\Http\Controllers\PengajuanSapiController;
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
    Route::prefix('pengajuan-sapi')->group(function () {
        Route::get('/show', [PengajuanSapiController::class, 'index'])->name('index.pengajuan.sapi');
        Route::get('/tambah', [PengajuanSapiController::class, 'show'])->name('show.pengajuan.sapi');
        Route::post('/store', [PengajuanSapiController::class, 'store'])->name('store.pengajuan.sapi');
        Route::get('/detail/{id}', [PengajuanSapiController::class, 'detail'])->name('detail.pengajuan.sapi');
        Route::put('/update/{id}', [PengajuanSapiController::class, 'update'])->name('update.pengajuan.sapi');
        Route::put('/pembayaran/update/{id}', [PengajuanSapiController::class, 'updateBukti'])->name('update.bayar.pembeli');
        Route::get('/pembayaran/update/show/{id}', [PengajuanSapiController::class, 'updateBuktiShow'])->name('update.bayar');
        Route::put('/bukti/update/{id}', [PengajuanSapiController::class, 'updatebayarsapi'])->name('bukti.bayar.pembeli');
    });
    Route::prefix('profil-pembeli')->group(function () {
        Route::get('/detail/{id}', [AkunController::class, 'profilpembeliakun'])->name('detail.profil.pembeli');
        Route::get('Edit/{id}', [AkunController::class, 'editpembeliakun'])->name('edit.profil.pembeli');
        Route::put('Update/{id}', [AkunController::class, 'updatepembeliakun'])->name('update.profil.pembeli');
    });
});
// ADMIN 
Route::middleware(['auth', 'checkAdmin'])->group(function () {
    //AKUN PEGAWAI
    Route::get('/akun-pegawai', [AdminController::class, 'indexadmin'])->name('akunadmin');
    Route::prefix('akun-pegawai')->group(function () {
        Route::get('/detail/{id}', [AkunController::class, 'detailakun'])->name('detailakun');
        Route::get('/edit/{id}', [AkunController::class, 'edit'])->name('akunadmin.edit');
        Route::put('/update/{id}', [AkunController::class, 'update'])->name('akunadmin.update');
    });
    //AKUN PEMBELI
    Route::get('akun-pembeli/', [AkunController::class, 'indexpembeli'])->name('akunpembeli');
    Route::get('akun-pembeli/detail/{id}', [AkunController::class, 'detailakunpembeli'])->name('detail.akun.pembeli');
    Route::get('akun-pembeli/pembeli/edit/{id}', [AkunController::class, 'editpembeli'])->name('pembeliadmin.edit');
    Route::put('akun-pembeli/pembeli/update/{id}', [AkunController::class, 'updatepembeli'])->name('pembeliadmin.update');
    //AKUN PROFIL
    Route::get('akun-profil/admin/', [AkunController::class, 'profil'])->name('profiladmin');
    Route::get('akun-profil/edit/{id}', [AkunController::class, 'editprofil'])->name('admin.profil.edit');
    Route::put('akun-profil/update/{id}', [AkunController::class, 'updateprofil'])->name('admin.profil.update');
    //AKUN DAFTAR
    Route::get('/admin/pegawai/daftar', [AuthController::class, 'pegawaidaftar'])->name('pegawaidaftar');
    Route::post('/admin/pegawai/daftar', [AuthController::class, 'pegawaidaftarsave'])->name('pegawaidaftar.save');
    //DELETE AKUN
    Route::delete('/admin/akun/delete/{id}', [AkunController::class, 'delete'])->name('akunadmin.delete');
    //ADMIN - DAFTAR PEGAWAI
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
    // KESWAN - PEGAWAI
    Route::get('/keswan/list-pegawai', [AdminController::class, 'pegawaiKeswan'])->name('pegawai.keswan');
    Route::get('/keswan/detail-pegawai/{id}', [AdminController::class, 'detailPKeswan'])->name('detail.pegawai.keswan');
    // KESWAN - PROFIL
    Route::get('/keswan/profil/{id}', [AkunController::class, 'profilkeswan'])->name('profilkeswan');
    Route::get('/keswan/profil/edit/{id}', [AkunController::class, 'editkeswan'])->name('edit.profil.keswan');
    Route::put('keswan/profil/update/{id}', [AkunController::class, 'updatekeswan'])->name('update.profil.keswan');
});
//WASTUKAN 
Route::middleware(['auth', 'checkWastukan'])->group(function () {
    //WASTUKAN - DETAIL PROFIL
    Route::get('/wastukan/profil/{id}', [AkunController::class, 'profilwastukan'])->name('profilwastukan');
    Route::get('/wastukan/profil/edit/{id}', [AkunController::class, 'editwastukan'])->name('edit.profil.wastukan');
    Route::put('wastukan/profil/update/{id}', [AkunController::class, 'updatewastukan'])->name('update.profil.wastukan');
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
    Route::put('/wastukan/jenis_lahan/update/{lahan_id}', [JenisLahanController::class, 'update'])->name('update.jenis.lahan');
    Route::delete('/wastukan/jenis_lahan/delete/{lahan_id}', [JenisLahanController::class, 'destroy'])->name('destroy.jenis.lahan');
    //WASTUKAN - KEGIATAN LAHAN
    Route::prefix('kegiatan_lahan')->group(function () {
        Route::get('/', [KegiatanLahanController::class, 'index'])->name('index.tanam');
        Route::get('/tambah', [KegiatanLahanController::class, 'show'])->name('show.tanam');
        Route::post('/store', [KegiatanLahanController::class, 'store'])->name('store.tanam');
        Route::get('/detail/{id}', [KegiatanLahanController::class, 'detail'])->name('detail.tanam');
        Route::put('/update/{tanam_id}', [KegiatanLahanController::class, 'update'])->name('update.tanam');
        Route::delete('/delete/{tanam_id}', [KegiatanLahanController::class, 'destroy'])->name('destroy.tanam');
    });
    Route::prefix('pegawai-wastukan')->group(function () {
        Route::get('/', [AdminController::class, 'pegawaiWastukan'])->name('index.pegawai.wastukan');
        Route::get('/detail/{id}', [AdminController::class, 'detailPwastukan'])->name('detail.pegawai.wastukan');
    });
});
//WASBITNAK
Route::middleware(['auth', 'checkWasbitnak'])->group(function () {
    //WASBITNAK - PROFIL
    Route::get('/waasbitnak/profil/{id}', [AkunController::class, 'profilwasbitnak'])->name('profilwasbitnak');
    Route::get('/wasbitnak/profil/edit/{id}', [AkunController::class, 'editwasbitnak'])->name('edit.profil.wasbitnak');
    Route::put('wasbitnak/profil/update/{id}', [AkunController::class, 'updatewasbitnak'])->name('update.profil.wasbitnak');
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
    // WASBITNAK - DATA SAPI
    Route::prefix('sapi')->group(function () {
        Route::get('/', [SapiJualController::class, 'index'])->name('index.sapi.wasbitnak');
        Route::get('/tambah', [SapiJualController::class, 'show'])->name('show.sapi.wasbitnak');
        Route::post('/store', [SapiJualController::class, 'store'])->name('store.sapi.wasbitnak');
        Route::get('/detail/{sapi_id}', [SapiJualController::class, 'detail'])->name('detail.sapi.wasbitnak');
        Route::get('/print/{sapi_id}', [SapiJualController::class, 'printsapi'])->name('print.sapi.wasbitnak');
        Route::get('/export-sapi', [SapiJualController::class, 'export'])->name('export.sapi.wasbitnak');
        Route::get('/sapi/filter', [SapiJualController::class, 'filter'])->name('filter.sapi.wasbitnak');
        Route::get('/edit/{sapi_id}', [SapiJualController::class, 'edit'])->name('edit.sapi.wasbitnak');
        Route::put('/update/{sapi_id}', [SapiJualController::class, 'update'])->name('update.sapi.wasbitnak');
        Route::delete('/delete/{sapi_id}', [SapiJualController::class, 'destroy'])->name('destroy.sapi.wasbitnak');
    });
    // WASBITNAK - DATA PEGAWAI
    Route::prefix('pegawai-wasbitnak')->group(function () {
        Route::get('/', [AdminController::class, 'pegawaiWasbitnak'])->name('index.pegawai.wasbitnak');
        Route::get('/detail/{id}', [AdminController::class, 'detailPWasbitnak'])->name('detail.pegawai.wasbitnak');
    });
});
//PPID
Route::middleware(['auth', 'checkPPID'])->group(function () {
    Route::get('/daftar-pembeli', [PPIDController::class, 'daftarpembeli'])->name('index.daftar.pembeli');
    Route::prefix('akun-pembeli-ppid')->group(function () {
        Route::get('/detail/{id}', [PPIDController::class, 'detailPembeli'])->name('detail.ppid.pembeli');
        Route::put('/update/{id}', [PPIDController::class, 'updatePembeli'])->name('update.ppid.pembeli');
        Route::delete('/delete/{id}', [PPIDController::class, 'deletepembeli'])->name('delete.ppid.pembeli');
    });
    Route::prefix('sapi-jual')->group(function () {
        Route::get('/', [PPIDController::class, 'indexsapijual'])->name('index.ppid.sapi');
        Route::get('/detail/{id}', [PPIDController::class, 'detailsapijual'])->name('detail.ppid.sapi');
        Route::put('/update/{id}', [PPIDController::class, 'updatesapijual'])->name('update.ppid.sapi');
        Route::delete('/delete/{id}', [PPIDController::class, 'deletesapijual'])->name('delete.ppid.sapi');
        Route::get('/export', [PPIDController::class, 'exportsapijual'])->name('export.ppid.sapi');
        Route::get('/filter', [PPIDController::class, 'filtersapijual'])->name('filter.ppid.sapi');
    });
    Route::prefix('rumput-jual')->group(function () {
        Route::get('/', [PPIDController::class, 'indexrumputjual'])->name('index.ppid.rumput');
        Route::get('/detail/{id}', [PPIDController::class, 'detailrumputjual'])->name('detail.ppid.rumput');
        Route::put('/update/{id}', [PPIDController::class, 'updaterumputjual'])->name('update.ppid.rumput');
        Route::delete('/delete/{id}', [PPIDController::class, 'deleterumputjual'])->name('delete.ppid.rumput');
    });
    Route::prefix('pengajuan-sapi-ppid')->group(function () {
        Route::get('/', [PPIDController::class, 'indexpengajuansapi'])->name('index.ppid.psapi');
        Route::get('/detail/{id}', [PPIDController::class, 'detailpengajuansapi'])->name('detail.ppid.psapi');
        Route::put('/update/{id}', [PPIDController::class, 'updatepengajuansapi'])->name('update.ppid.psapi');
        Route::delete('/delete/{id}', [PPIDController::class, 'deletepengajuansapi'])->name('delete.ppid.psapi');
    });
    //PPID - PROFIL
    Route::get('/PPID/Profil/{id}', [AkunController::class, 'profilppid'])->name('detail.profil.ppid');
    Route::get('/PPID/Profil/Edit/{id}', [AkunController::class, 'editppid'])->name('edit.profil.ppid');
    Route::put('/PPID/Profil/Update/{id}', [AkunController::class, 'updateppid'])->name('update.profil.ppid');
});
//BENDAHARA
Route::middleware(['auth', 'checkBendahara'])->group(function () {
    Route::get('/dasboard/Bendahara', [BendaharaController::class, 'dashboard'])->name('dashboard.bendahara');
    //PROFIL
    Route::get('/bendahara/profil/{id}', [AkunController::class, 'profilbendahara'])->name('profilbendahara');
    Route::get('/bendahara/profil/edit/{id}', [AkunController::class, 'editbendahara'])->name('edit.profil.bendahara');
    Route::put('bendahara/profil/update/{id}', [AkunController::class, 'updatebendahara'])->name('update.profil.bendahara');
    //PENGAJUAN SAPI
    Route::prefix('pengajuan-sapi-bendahara')->group(function () {
        Route::get('/', [BendaharaController::class, 'indexsapi'])->name('index.bendahara.psapi');
        Route::get('/detail/{belisapi_id}', [BendaharaController::class, 'detailsapi'])->name('detail.bendahara.psapi');
        Route::post('/storebayarsapi/{belisapi_id}', [BendaharaController::class, 'storebayarsapi'])->name('store.bayar.psapi');
        Route::put('/update/{dbeli_id}', [BendaharaController::class, 'updatebayarsapi'])->name('update.bayar.psapi');
        Route::delete('/bayar/psapi/{dbeli_id}', [BendaharaController::class, 'deletebayarsapi'])->name('delete.bayar.psapi');
    });
});
//KEPALA
Route::middleware(['auth', 'checkKepala'])->group(function () {
    Route::get('/dasboard/kepala', [KepalaBalaiController::class, 'dashboard'])->name('dashboard.kepala');
    Route::get('/Kepala/Profil/{id}', [AkunController::class, 'profilkepala'])->name('detail.profil.kepala');
    Route::get('/Kepala/Profil/Edit/{id}', [AkunController::class, 'editkepala'])->name('edit.profil.kepala');
    Route::put('/Kepala/Profil/Update/{id}', [AkunController::class, 'updatekepala'])->name('update.profil.kepala');
    Route::prefix('pengajuan-sapi-kepala')->group(function () {
        Route::get('/', [KepalaBalaiController::class, 'pengajuansapi'])->name('index.kepala.psapi');
        Route::get('/detail/{id}', [KepalaBalaiController::class, 'detailpengajuansapi'])->name('detail.kepala.psapi');
        Route::put('/update/{id}', [KepalaBalaiController::class, 'updatepengajuansapi'])->name('update.kepala.psapi');
    });
});
// lOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//403
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
// PENDING

Route::get('/export', [AkunController::class, 'export']);
