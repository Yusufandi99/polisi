<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ListController; 
use App\Http\Controllers\DispoController; 
use App\Models\Dispo;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('login/index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses'); 

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/petugas', PetugasController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/dispo', DispoController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/list', ListController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/api/dispo', function (Request $request) {
    $id_tipe = $request->query('id_tipe');
    $data = Dispo::where('id_tipe', $id_tipe)->get();
    return response()->json($data);
});