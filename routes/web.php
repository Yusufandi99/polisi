<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DispoController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ProsesController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Models\Dispo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Petugas;


Route::get('/', function () {
    return view('login/index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/petugas', PetugasController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/tracking', TrackingController::class)->except(['destroy']);
    Route::delete('admin/tracking/{no_disposisi}/{waktu_trans}', [TrackingController::class, 'destroy'])->name('tracking.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('admin/profil', ProfilController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('admin/dashboard', DashboardController::class);
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
    $closing = $request->query('closing'); // Ambil query parameter closing (0 atau 1)

    $data = DB::table('dispo')
        ->join('dispo_status', 'dispo.id_status', '=', 'dispo_status.id_status')
        ->where('dispo_status.closing', $closing) // Filter berdasarkan closing, bukan id_status
        ->select('dispo.*', 'dispo_status.closing')
        ->get();

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
        ->leftJoin('petugas', 'dispo.id_petugas_input', '=', 'petugas.id')
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

Route::get('/api/dispo-trans', [TrackingController::class, 'getDispoTrans']);

Route::middleware(['auth'])->group(function () {
    Route::get('/edit_profile/{id}', function ($id) {
        session(['profile_id' => $id]); 
        return redirect()->to('/edit_profile', 301); 
    });
});
Route::middleware(['auth'])->group(function () {
    Route::get('/edit_profile', function () {
        $profileId = Session::get('profile_id'); 
    
        $petugas = Petugas::where('id', $profileId)->first();
        $userLogin = $petugas ? $petugas->user_login : null; 
    
        return view('admin.profil.edit_profile', compact('profileId', 'userLogin'));
    })->name('edit.profile');
});





Route::post('/update_profile', function (Request $request) {
    $request->validate([
        'profile_id' => 'required|integer',
        'password' => 'required|string|max:8'
    ]);

    $update = Petugas::where('id', $request->profile_id)
        ->update(['pass_login' => md5($request->password)]); // Simpan password dengan MD5

    if ($update) {
        session()->flash('success', 'Password berhasil diperbarui!');
    } else {
        session()->flash('error', 'Gagal memperbarui password.');
    }

    return response()->json(['message' => session('success') ?? session('error')]);
})->name('update.profile');

Route::get('/get-devisi', function () {
    $devisi = DB::table('devisi')->select('id_devisi','deskripsi_devisi')->get();
    return response()->json($devisi);
});

Route::get('/notifications', function () {
    $notifications = DB::table('dispo_trans')
        ->join('dispo_status', 'dispo_trans.id_status', '=', 'dispo_status.id_status')
        ->join('petugas', 'dispo_trans.id_petugas_validasi', '=', 'petugas.id')
        ->select(
            'dispo_trans.no_disposisi',
            'dispo_trans.waktu_trans',
            'dispo_trans.uraian',
            'dispo_status.deskripsi_status',
            'petugas.nama_petugas'
        )
        ->orderBy('dispo_trans.waktu_trans', 'desc')
        ->limit(3)
        ->get();

    return response()->json($notifications);
});

