<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Pembina\RaporController;
use App\Http\Controllers\Peserta\OrderController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Pengurus\RaportController;
use App\Http\Controllers\Admin\ListOrderConttroller;
use App\Http\Controllers\Pengurus\ProductController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Pengurus\DokumentasiController;
use App\Http\Controllers\Pengurus\CategoryController;
use App\Http\Controllers\Pengurus\AmalYaumiController;
use App\Http\Controllers\Peserta\PembayaranController;
use App\Http\Controllers\Public\PublicOrderController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\Peserta\pendaftaranController;
use App\Http\Controllers\Pembina\amalyaumireadController;
use App\Http\Controllers\Peserta\RaportPesertaController;
use App\Http\Controllers\Pengurus\LaporanDivisiController;
use App\Http\Controllers\Peserta\amalyaumipesertaController;
use App\Http\Controllers\Public\DokumentasiPublikController;
use App\Http\Controllers\Admin\VerifikasiPembayaranController;
use App\Http\Controllers\Admin\LaporanDivisiPengurusController;
use App\Http\Controllers\Pengurus\PengurusPendaftaranController;
use App\Http\Controllers\UserApproveController;

// Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/', [DokumentasiPublikController::class, 'index'])->name('index');
//Route::get('/', [DokumentasiPublikController::class, 'store'])->name('store');
Route::post('/public-order/{product}', [PublicOrderController::class, 'store'])->name('order.store.public');

Route::post('/kirim-kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');


// web.php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Auth
Auth::routes();

Route::get('/verification/pending', function () {
    return view('auth.pending');
})->name('verification.pending');

// Dashboard (semua role)
Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');

Route::middleware('CheckRole:Admin')->prefix('admin')->name('admin.')->group(function () {
    // Manajemen User
    Route::prefix('data-user')->name('data-user.')->group(function () {
        Route::get('/', [ManajemenUserController::class, 'index'])->name('index');
        Route::get('/create', [ManajemenUserController::class, 'create'])->name('create');
        Route::post('/store', [ManajemenUserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [ManajemenUserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [ManajemenUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [ManajemenUserController::class, 'destroy'])->name('destroy');
    });

     Route::prefix('laporan-divisi')->name('laporan-divisi.')->group(function () {
        Route::get('/', [LaporanDivisiPengurusController::class, 'index'])->name('index');
    });

    Route::prefix('verifikasi-user')->name('verifikasi-user.')->group(function () {
        Route::get('/', [UserApproveController::class, 'index'])->name('index');
        Route::post('/approve/{id}', [UserApproveController::class, 'approve'])->name('approve');
    });

    // Kalender Kegiatan
    Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', [KegiatanController::class, 'index'])->name('index');
        Route::get('/events', [KegiatanController::class, 'fetchEvents'])->name('events');
        Route::post('/', [KegiatanController::class, 'store'])->name('store');
        Route::put('/{kegiatan}/edit', [KegiatanController::class, 'update'])->name('update');
        Route::delete('/{kegiatan}/delete', [KegiatanController::class, 'destroy'])->name('destroy');
    });



    Route::prefix('kontak')->name('kontak.')->group(function () {
        Route::get('/', [KontakController::class, 'index'])->name('index');
    });

    Route::prefix('products')->name('products.')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        });

    Route::prefix('verifikasi-pembayaran')->name('verifikasi-pembayaran.')->group(function () {
        Route::get('/', [VerifikasiPembayaranController::class, 'index'])->name('index');
        Route::put('/{pembayaran}', [VerifikasiPembayaranController::class, 'updateStatus'])->name('update');
        Route::get('/export/pdf', [VerifikasiPembayaranController::class, 'exportPdf'])->name('export.pdf');
    });

    Route::prefix('program')->name('program.')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('/create', [ProgramController::class, 'create'])->name('create');
        Route::post('/store', [ProgramController::class, 'store'])->name('store');
        Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('edit');
        Route::put('/{program}', [ProgramController::class, 'update'])->name('update');
        Route::delete('/{program}', [ProgramController::class, 'destroy'])->name('destroy');
    });

     Route::prefix('category')->group(function () {
        Route::resource('categories', CategoryController::class)->names('categories');
    });

    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [ListOrderConttroller::class, 'index'])->name('index');
        Route::put('/{order}/status', [ListOrderConttroller::class, 'updateStatus'])->name('updateStatus');
        Route::get('/export/pdf', [ListOrderConttroller::class, 'exportPdf'])->name('export.pdf');
    });

});


Route::middleware('CheckRole:Pengurus Divisi')->prefix('Pengurus Divisi')->name('pengurus.')->group(function () {
    // Laporan Divisi
    Route::prefix('laporan-divisi')->name('laporan-divisi.')->group(function () {
        Route::get('/', [LaporanDivisiController::class, 'index'])->name('index');
        Route::get('/create', [LaporanDivisiController::class, 'create'])->name('create');
        Route::post('/store', [LaporanDivisiController::class, 'store'])->name('store');
        Route::get('/{laporan}/edit', [LaporanDivisiController::class, 'edit'])->name('edit');
        Route::put('/{laporan}', [LaporanDivisiController::class, 'update'])->name('update');
        Route::delete('/{laporan}', [LaporanDivisiController::class, 'destroy'])->name('destroy');
    });

    // Route::prefix('program')->name('program.')->group(function () {
    //     Route::get('/', [ProgramController::class, 'index'])->name('index');
    //     Route::get('/create', [ProgramController::class, 'create'])->name('create');
    //     Route::post('/store', [ProgramController::class, 'store'])->name('store');
    //     Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('edit');
    //     Route::put('/{program}', [ProgramController::class, 'update'])->name('update');
    //     Route::delete('/{program}', [ProgramController::class, 'destroy'])->name('destroy');
    // });

     Route::prefix('category')->group(function () {
        Route::resource('categories', CategoryController::class)->names('categories');

    });

    // Verifikasi Pembayaran
    Route::prefix('verifikasi-pembayaran')->name('verifikasi-pembayaran.')->group(function () {
        Route::get('/', [VerifikasiPembayaranController::class, 'index'])->name('index');
        Route::put('/{pembayaran}', [VerifikasiPembayaranController::class, 'updateStatus'])->name('update');
    });

     Route::prefix('raport')->name('raport.')->group(function () {
        Route::get('/', [RaportController::class, 'index'])->name('index');
        Route::get('/create', [RaportController::class, 'create'])->name('create');
        Route::post('/store', [RaportController::class, 'store'])->name('store');
        Route::get('raport/{raport}', [RaportController::class, 'show'])->name('show');
        Route::delete('raport/{raport}', [RaportController::class, 'destroy'])->name('destroy');
    });

      Route::prefix('amalyaumi')->name('amalyaumi.')->group(function () {
        Route::get('/', [AmalYaumiController::class, 'index'])->name('index');
    });

     Route::prefix('products')->name('products.')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', [PengurusPendaftaranController::class, 'index'])->name('index');
            Route::put('/{pendaftaran}/status', [PengurusPendaftaranController::class, 'updateStatus'])->name('updateStatus');
            Route::delete('/{pendaftaran}', [PengurusPendaftaranController::class, 'destroy'])->name('destroy');
            Route::get('/program/{id}', [PengurusPendaftaranController::class, 'showByProgram'])->name('byProgram');
            Route::get('/program/{id}/export-pdf', [PengurusPendaftaranController::class, 'exportPdf'])->name('exportPdf');
            Route::post('/program/{id}/export-pdf', [PengurusPendaftaranController::class, 'exportPdf'])->name('exportPdf');

        });

    Route::prefix('dokumentasi')->name('dokumentasi.')->group(function () {
        Route::get('/', [DokumentasiController::class, 'index'])->name('index');
        Route::get('/create', [DokumentasiController::class, 'create'])->name('create');
        Route::post('/store', [DokumentasiController::class, 'store'])->name('store');
        Route::get('/show/{dokumentasi}', [DokumentasiController::class, 'show'])->name('show');
        Route::delete('/{dokumentasi}', [DokumentasiController::class, 'destroy'])->name('destroy');
        Route::get('/export/pdf', [DokumentasiController::class, 'exportPdf'])->name('export-dok.pdf');
    });
});


Route::middleware('CheckRole:Pembina')->prefix('Pembina')->name('Pembina.')->group(function () {

     Route::prefix('raport')->name('raport.')->group(function () {
        Route::get('/', [RaporController::class, 'index'])->name('index');
    });

      Route::prefix('amalyaumi')->name('amalyaumi.')->group(function () {
        Route::get('/', [amalyaumireadController::class, 'index'])->name('index');
    });
});


Route::middleware('CheckRole:Peserta')->prefix('Peserta')->name('Peserta.')->group(function () {

     Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/riwayat', [PembayaranController::class, 'riwayat'])->name('riwayat');
        Route::get('/upload-pembayaran', [PembayaranController::class, 'create'])->name('create');
        Route::post('/upload-pembayaran', [PembayaranController::class, 'store'])->name('store');
    });

    Route::prefix('amal-yaumi')->name('amal-yaumi.')->group(function () {
        Route::get('/', [amalyaumipesertaController::class, 'index'])->name('index');
        Route::post('/', [amalyaumipesertaController::class, 'store'])->name('store');
    });

    Route::prefix('rapor')->name('rapor.')->group(function () {
        Route::get('/', [RaportPesertaController::class, 'index'])->name('index');
         Route::get('raport/{raport}', [RaportPesertaController::class, 'show'])->name('show');
    });

    Route::prefix('belanja')->name('belanja.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/pesan/{product}', [OrderController::class, 'store'])->name('pesan');
        Route::get('/riwayat', [OrderController::class, 'riwayat'])->name('riwayat');
    });

     Route::prefix('pendaftaran-program')->name('pendaftaran-program.')->group(function () {
        Route::get('/', [PendaftaranController::class, 'index'])->name('index');
        Route::get('/list', [PendaftaranController::class, 'listProgram'])->name('list');
        Route::post('/store', [PendaftaranController::class, 'store'])->name('store');
    });
});

