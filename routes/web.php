<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [SesiController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [SesiController::class, 'index'])->name('login.form')->middleware('guest');
Route::post('/', [SesiController::class, 'login'])->name('login.submit')->middleware('guest');

Route::get('/home', function () {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.index');
    }
});


Route::group(['prefix' => 'admin', 'middleware' => ['roleAcces:admin'], 'as' => 'admin.'], function () {

    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');



    // Route siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/destroy/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/siswa/export/', [SiswaController::class, 'export'])->name('siswa.export');

    // Route Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
