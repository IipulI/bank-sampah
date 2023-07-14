<?php

use App\Http\Controllers\ProfileController;
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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/staff', function () {
        return view('app.staff');
    })->name('staff');

    Route::get('/anggota', function () {
        return view('app.anggota');
    })->name('anggota');

    Route::get('/tipe-sampah', function () {
        return view('app.tipe-sampah');
    })->name('tipe-sampah');

    Route::get('/setor-barang', function () {
        return view('app.setor-barang');
    })->name('setor-barang');

    Route::get('/histori-transaksi', function () {
        return view('app.histori-transaksi');
    })->name('histori-transaksi');

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
