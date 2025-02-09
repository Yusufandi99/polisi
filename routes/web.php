<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DispoController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\EditController;
use App\Models\Dispo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    Route::resource('admin/riwayat', RiwayatController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/proses', ProsesController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/edit', EditController::class);
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

Route::get('/api/get-tracking', function (Request $request) {
    $noDisposisi = $request->query('no_disposisi');

    if (!$noDisposisi) {
        return response()->json(['error' => 'No disposisi tidak ditemukan'], 400);
    }

    $trackingData = DB::table('dispo_trans')
        ->where('no_disposisi', $noDisposisi)
        ->orderBy('waktu_trans', 'desc')
        ->get(['uraian', 'waktu_trans']);


    return response()->json($trackingData);
});

Route::get('/api/get-dispo', function (Request $request) {
    $noDisposisi = $request->query('no_disposisi');

    $dispo = DB::table('dispo')
        ->leftJoin('devisi', 'dispo.id_devisi', '=', 'devisi.id_devisi')
        ->leftJoin('petugas', 'dispo.id_devisi', '=', 'petugas.id_devisi')
        ->where('dispo.no_disposisi', $noDisposisi)
        ->select(
            'dispo.*',
            'devisi.deskripsi_devisi',
            'petugas.nama_petugas'
        )
        ->first();

    return response()->json($dispo);
});


Route::get('/api/get-devisi', function (Request $request) {
    $no_disposisi = $request->query('no_disposisi');

    $devisi = DB::table('dispo')
        ->join('devisi', 'dispo.id_devisi', '=', 'devisi.id_devisi')
        ->where('dispo.no_disposisi', $no_disposisi)
        ->select('devisi.deskripsi_devisi')
        ->first();

    return response()->json([
        'deskripsi_devisi' => $devisi->deskripsi_devisi ?? 'Tidak Diketahui'
    ]);
});

Route::get('/api/check-validasi', [ProsesController::class, 'checkValidasi']);

// Route::get('/api/get-dispo', [DispoController::class, 'getDispoByNoDisposisi']);
