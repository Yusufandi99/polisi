<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController; 


Route::get('/', function () {
    return view('login/index');
});


// Route::get('admin/petugas', function () {
//     return view('admin/petugas/index');
// });

// Route::resource('admin/petugas', PetugasController::class);

// Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses'); 

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/petugas', PetugasController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');