<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.petugas.index');
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
        $validated = $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'id_devisi' => 'required|integer',
            'jabatan' => 'required|string|max:255',
            'user_login' => 'required|string|max:255|unique:petugas',
            'pass_login' => 'required|string|max:8',
        ]);

        $id = Petugas::max('id') + 1;
        $petugas = Petugas::create([
            'id' => $id,
            'nama_petugas' => $validated['nama_petugas'],
            'id_devisi' => $validated['id_devisi'],
            'jabatan' => $validated['jabatan'],
            'user_login' => $validated['user_login'],
            'pass_login' => md5($validated['pass_login']),
        ]);

        if ($petugas) {
            return redirect()->route('petugas.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
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
