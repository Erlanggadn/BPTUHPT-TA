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
use App\Http\Controllers\JenisKandangController;
use App\Http\Controllers\KegiatanSapiController;
use App\Http\Controllers\RumputSiapJualController;
use App\Http\Controllers\KegiatanKandangController;

// HOME
Route::get('/', function () {
    return view('index');
});

Route::get('/', [AuthController::class, 'home'])->name('home');
// LOGIN & DAFTAR PEMBELI
Route::get('daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('daftar', [AuthController::class, 'daftarsave'])->name('daftar.save');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');
// PEMBELI
Route::get('/pembeli', [AdminController::class, 'pembeli']);
Route::get('/akun/{id}', [AkunController::class, 'detailpembeli'])->name('detailpembeli');
// ADMIN 
Route::middleware(['auth', 'checkAdmin'])->group(function () {
    Route::get('/akunpembeli', [AkunController::class, 'indexpembeli'])->name('akunpembeli');
    Route::get('/admin', [AdminController::class, 'indexadmin'])->name('akunadmin');
    Route::get('/akun/{id}', [AkunController::class, 'detailakun'])->name('detailakun');
    Route::get('/profil/{id}', [AkunController::class, 'profiladmin'])->name('profiladmin');
    Route::get('/akun/edit/{id}', [AkunController::class, 'edit'])->name('akunadmin.edit');
    Route::put('/akun/update/{id}', [AkunController::class, 'update'])->name('akunadmin.update');
    Route::delete('/akun/delete/{id}', [AkunController::class, 'delete'])->name('akunadmin.delete');
    //ADMIN - DAFTAR PEGAWAI
    Route::get('pegawai/daftar', [AuthController::class, 'pegawaidaftar'])->name('pegawaidaftar');
    Route::post('pegawai/daftar', [AuthController::class, 'pegawaidaftarsave'])->name('pegawaidaftar.save');
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
    Route::get('/wastukan/jenis_rumput', [RumputController::class, 'index'])->name('indexrumput');
    Route::get('/wastukan/tambah/jenis', [RumputController::class, 'tambahjenis'])->name('tambahjenis');
    Route::post('/wastukan/store/jenis', [RumputController::class, 'postjenis'])->name('postjenis');
    Route::get('/wastukan/jenis_rumput/detail/{id}', [RumputController::class, 'detailjenis'])->name('detailjenis');
    Route::get('/wastukan/jenis_rumput/detail/edit/{id}', [RumputController::class, 'editjenis'])->name('editjenis');
    Route::put('/wastukan/jenis_rumput/update/{id}', [RumputController::class, 'updatejenis'])->name('updatejenis');
    Route::delete('/wastukan/jenis_rumput/delete/{id}', [RumputController::class, 'deletejenis'])->name('deletejenis');
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//403
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
// PENDING
