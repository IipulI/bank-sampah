<?php

use App\Http\Controllers\AnggotaConroller;
use App\Http\Controllers\HistoriTransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::middleware('can:admin')->middleware('can:staff')->group(function (){
        Route::prefix('anggota')->controller(AnggotaConroller::class)->group(function(){
            Route::get('/', function () {
                return view('app.anggota');
            })->name('anggota');

            Route::get('data', 'getData');
            Route::post('edit-data', 'editData')->name('anggota.edit-data');
            Route::post('submit-data', 'submitData')->name('anggota.submit-data');
        });

        Route::prefix('setor-sampah')->controller(SampahController::class)->group(function() {
            Route::get('/', function () {
                return view('app.setor-barang');
            })->name('setor-sampah');

            Route::get('data', 'getSampah');
            Route::get('member', 'getMember');
            Route::get('search', 'searchSampah');
            Route::post('submit-data', 'setorSampah')->name('setor-sampah.submit-data');
        });

        Route::prefix('request-tarik-dana')->group(function (){
            Route::get('/', function (){
                return view('app.request-tarik-dana');
            })->name('request-tarik-dana');

            Route::post('submit', [SampahController::class, 'tarikDana']);
        });
    });

    Route::middleware('can:admin')->group(function (){
        Route::prefix('staff')->controller(StaffController::class)->group(function (){
            Route::get('/', function () {
                return view('app.staff');
            })->name('staff');

            Route::get('/data', 'getData');
            Route::post('edit-data', 'editData')->name('staff.edit-data');
            Route::post('submit-data', 'submitData')->name('staff.submit-data');
        });

        Route::prefix('tipe-sampah')->controller(SampahController::class)->group(function (){
            Route::get('/', function () {
                return view('app.tipe-sampah');
            })->name('tipe-sampah');

            Route::get('data', 'getData');
            Route::post('edit-data', 'editData')->name('tipe-sampah.edit-data');
            Route::post('submit-data', 'submitData')->name('tipe-sampah.submit-data');
        });
    });

    Route::prefix('histori-transaksi')->controller(HistoriTransaksiController::class)->group(function (){
        Route::get('/', function () {
            return view('app.histori-transaksi');
        })->name('histori-transaksi');

        Route::get('data', 'getData');
    });

    Route::post('test/hit', function (\Illuminate\Http\Request $request){
        return $request->all();
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
