<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Petugas;
// use App\Models\Dispo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           
        $idPetugas = session('user_id');

        // Query join manual antara petugas dan devisi
        $petugas = DB::table('petugas')
            ->join('devisi', 'petugas.id_devisi', '=', 'devisi.id_devisi')
            ->where('petugas.id', $idPetugas)
            ->select('petugas.*', 'devisi.deskripsi_devisi')
            ->first();
    
        return view('admin.profil.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
