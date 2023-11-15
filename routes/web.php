<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/foo', function () {
    Artisan::call('storage:link');
});
Route::get(
    '/',
    [App\Http\Controllers\PublicController::class, 'welcome']
)->name('welcome');

Route::get(
    '/tentang',
    [App\Http\Controllers\PublicController::class, 'tentang']
)->name('tentang');

Route::get(
    '/tentang-spmi',
    [App\Http\Controllers\PublicController::class, 'spmi']
)->name('tentang_spmi');

Route::get(
    '/akre',
    [App\Http\Controllers\PublicController::class, 'akre']
)->name('akre');

Route::get(
    '/peraturan',
    [App\Http\Controllers\PublicController::class, 'peraturan']
)->name('peraturan');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get(
    '/dokumen/{jurusan}',
    [App\Http\Controllers\PublicController::class, 'dokumen']
)->name('dokumen');
Route::get(
    '/spmi/{kat}',
    [App\Http\Controllers\PublicController::class, 'spmi']
)->name('spmi-pub');

Route::prefix('folder/')->group(
    function () {
        Route::get('detail/{id}', [App\Http\Controllers\FolderController::class, 'show'])->name('folder.detail');
    }
);

Route::prefix('baca/')->group(
    function () {
        Route::get('berita/{id}', [App\Http\Controllers\PublicController::class, 'baca'])->name('baca.news');
        Route::get('semua', [App\Http\Controllers\PublicController::class, 'baca_full'])->name('baca.full');
        Route::get('semua/loadmore', [App\Http\Controllers\PublicController::class, 'loadMore'])->name('baca.load-more');
    }
);

Route::get('/load-more', [App\Http\Controllers\PublicController::class, 'loadMore']);


Auth::routes([
    'register' => false,
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:admin,prodi,fakultas'])->group(
    function () {
        Route::prefix('admin/')->group(
            function () {

                Route::prefix('prodi/')->group(
                    function () {
                        Route::get('dokumen/{kategori}/{kat_fak?}', [App\Http\Controllers\ProdiController::class, 'index'])->name('prodi');
                        Route::post('store', [App\Http\Controllers\ProdiController::class, 'store'])->name('prodi.store');
                        Route::post('update/{id}', [App\Http\Controllers\ProdiController::class, 'update'])->name('prodi.update');

                        Route::post('ajax_status', [App\Http\Controllers\ProdiController::class, 'ajax_status'])->name('prodi.status');

                        Route::post('ajax_pesan', [App\Http\Controllers\ProdiController::class, 'ajax_pesan'])->name('prodi.pesan');

                        Route::delete('destroy/{id}', [App\Http\Controllers\ProdiController::class, 'destroy'])->name('prodi.destroy');
                    }
                );

                Route::prefix('akreditasi/')->group(
                    function () {
                        Route::get('', [App\Http\Controllers\AkreditasiController::class, 'index'])->name('akreditasi');
                        Route::post('store', [App\Http\Controllers\AkreditasiController::class, 'store'])->name('akreditasi.store');
                        Route::post('update/{id}', [App\Http\Controllers\AkreditasiController::class, 'update'])->name('akreditasi.update');
                        Route::delete('destroy/{id}', [App\Http\Controllers\AkreditasiController::class, 'destroy'])->name('akreditasi.destroy');
                    }
                );
                Route::prefix('reakreditasi/')->group(
                    function () {
                        Route::get('dokumen/{kategori}/{kat_fak?}', [App\Http\Controllers\File_reakreditasiController::class, 'index'])->name('reakreditasi');
                        Route::post('store', [App\Http\Controllers\File_reakreditasiController::class, 'store'])->name('reakreditasi.store');
                        Route::post('ajax_status', [App\Http\Controllers\File_reakreditasiController::class, 'ajax_status'])->name('reakreditasi.status');

                        Route::post('ajax_pesan', [App\Http\Controllers\File_reakreditasiController::class, 'ajax_pesan'])->name('reakreditasi.pesan');
                        Route::post('update/{id}', [App\Http\Controllers\File_reakreditasiController::class, 'update'])->name('reakreditasi.update');
                        Route::delete('destroy/{id}', [App\Http\Controllers\File_reakreditasiController::class, 'destroy'])->name('reakreditasi.destroy');
                    }
                );
            }
        );
    }
);
Route::middleware(['auth', 'role:admin,wr1,wr2,wr3'])->group(
    function () {
        Route::prefix('admin/')->group(
            function () {
                Route::prefix('universitas/')->group(
                    function () {
                        Route::get('dokumen/{kategori}', [App\Http\Controllers\UniversitasController::class, 'index'])->name('universitas');
                        Route::post('store', [App\Http\Controllers\UniversitasController::class, 'store'])->name('universitas.store');

                        Route::post('ajax_status', [App\Http\Controllers\UniversitasController::class, 'ajax_status'])->name('univ.status');

                        Route::post('ajax_pesan', [App\Http\Controllers\UniversitasController::class, 'ajax_pesan'])->name('univ.pesan');

                        Route::post('update/{id}', [App\Http\Controllers\UniversitasController::class, 'update'])->name('universitas.update');
                        Route::delete('destroy/{id}', [App\Http\Controllers\UniversitasController::class, 'destroy'])->name('universitas.destroy');
                        Route::delete('permintaan_hapus/{id}', [App\Http\Controllers\UniversitasController::class, 'permintaan_hapus'])->name('universitas.permintaan_hapus');
                    }
                );
            }
        );
    }
);
Route::middleware(['auth', 'role:admin,fakultas'])->group(
    function () {
        Route::prefix('admin/')->group(
            function () {
                Route::prefix('file_fakultas/')->group(
                    function () {
                        Route::get('dokumen/{kategori}/{kat_fak?}', [App\Http\Controllers\File_fakultasController::class, 'index'])->name('file_fakultas');
                        Route::post('store', [App\Http\Controllers\File_fakultasController::class, 'store'])->name('file_fakultas.store');

                        Route::post('ajax_status', [App\Http\Controllers\File_fakultasController::class, 'ajax_status'])->name('file_fakultas.status');

                        Route::post('ajax_pesan', [App\Http\Controllers\File_fakultasController::class, 'ajax_pesan'])->name('file_fakultas.pesan');

                        Route::post('update/{id}', [App\Http\Controllers\File_fakultasController::class, 'update'])->name('file_fakultas.update');
                        Route::delete('destroy/{id}', [App\Http\Controllers\File_fakultasController::class, 'destroy'])->name('file_fakultas.destroy');
                        Route::delete('permintaan_hapus/{id}', [App\Http\Controllers\File_fakultasController::class, 'permintaan_hapus'])->name('file_fakultas.permintaan_hapus');
                    }
                );
            }
        );
    }
);

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::prefix('admin/')->group(
        function () {
            Route::prefix('user/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('user');
                    Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
                    Route::post('update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
                }
            );
            Route::prefix('folder/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\FolderController::class, 'index'])->name('folder');
                    Route::get('tambah', [App\Http\Controllers\FolderController::class, 'create'])->name('folder.tambah');
                    Route::get('edit/{id}', [App\Http\Controllers\FolderController::class, 'edit'])->name('folder.edit');
                    Route::post('store', [App\Http\Controllers\FolderController::class, 'store'])->name('folder.store');
                    Route::post('update/{id}', [App\Http\Controllers\FolderController::class, 'update'])->name('folder.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\FolderController::class, 'destroy'])->name('folder.destroy');
                }
            );

            Route::prefix('kategori/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');
                    Route::post('store', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
                    Route::post('update/{id}', [App\Http\Controllers\KategoriController::class, 'update'])->name('kategori.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');
                }
            );

            Route::prefix('sub_kategori/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\Sub_kategoriController::class, 'index'])->name('sub_kategori');
                    Route::post('store', [App\Http\Controllers\Sub_kategoriController::class, 'store'])->name('sub_kategori.store');
                    Route::post('update/{id}', [App\Http\Controllers\Sub_kategoriController::class, 'update'])->name('sub_kategori.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\Sub_kategoriController::class, 'destroy'])->name('sub_kategori.destroy');
                }
            );

            Route::prefix('pengendalian/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\PengendalianController::class, 'index'])->name('pengendalian');
                    Route::post('store', [App\Http\Controllers\PengendalianController::class, 'store'])->name('pengendalian.store');
                    Route::post('update/{id}', [App\Http\Controllers\PengendalianController::class, 'update'])->name('pengendalian.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\PengendalianController::class, 'destroy'])->name('pengendalian.destroy');
                }
            );

            Route::prefix('fakultas/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\FakultasController::class, 'index'])->name('fakultas');
                    Route::post('store', [App\Http\Controllers\FakultasController::class, 'store'])->name('fakultas.store');
                    Route::post('update/{id}', [App\Http\Controllers\FakultasController::class, 'update'])->name('fakultas.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\FakultasController::class, 'destroy'])->name('fakultas.destroy');
                }
            );

            Route::prefix('SPMI/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\SPMIController::class, 'index'])->name('SPMI');
                    Route::get('kategori/{kategori}', [App\Http\Controllers\SPMIController::class, 'kategori'])->name('SPMI.kategori');
                    Route::get('Sub_kategori/{Sub_kategori}', [App\Http\Controllers\SPMIController::class, 'Sub_kategori'])->name('SPMI.Sub_kategori');
                    Route::post('store', [App\Http\Controllers\SPMIController::class, 'store'])->name('SPMI.store');
                    Route::post('update/{id}', [App\Http\Controllers\SPMIController::class, 'update'])->name('SPMI.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\SPMIController::class, 'destroy'])->name('SPMI.destroy');
                    Route::get('getdata/{id}', [App\Http\Controllers\SPMIController::class, 'getData'])->name('SPMI.getdata');
                }
            );

            Route::prefix('jurusan/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\JurusanController::class, 'index'])->name('jurusan');
                    Route::post('store', [App\Http\Controllers\JurusanController::class, 'store'])->name('jurusan.store');
                    Route::post('update/{id}', [App\Http\Controllers\JurusanController::class, 'update'])->name('jurusan.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\JurusanController::class, 'destroy'])->name('jurusan.destroy');
                }
            );

            Route::prefix('conten/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\ContenController::class, 'index'])->name('conten');
                    Route::post('store', [App\Http\Controllers\ContenController::class, 'store'])->name('conten.store');
                    Route::post('update/{id}', [App\Http\Controllers\ContenController::class, 'update'])->name('conten.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\ContenController::class, 'destroy'])->name('conten.destroy');
                }
            );

            Route::prefix('berita/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
                    Route::post('store', [App\Http\Controllers\BeritaController::class, 'store'])->name('berita.store');
                    Route::post('update/{id}', [App\Http\Controllers\BeritaController::class, 'update'])->name('berita.update');
                    Route::delete('destroy/{id}', [App\Http\Controllers\BeritaController::class, 'destroy'])->name('berita.destroy');
                    Route::post('image/{id}', [App\Http\Controllers\BeritaController::class, 'image_store'])->name('berita.image');
                    Route::post('image_edit', [App\Http\Controllers\BeritaController::class, 'image_edit'])->name('berita.img_edit');
                    Route::delete('img_destroy/{id}', [App\Http\Controllers\BeritaController::class, 'image_destroy'])->name('berita.img_destroy');
                }
            );
        }
    );
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin/')->group(
        function () {
            Route::prefix('dashboard/')->group(
                function () {
                    Route::get('', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
                }
            );
        }
    );
});
