<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('dispo_trans')
            ->leftJoin('petugas', 'dispo_trans.id_petugas_validasi', '=', 'petugas.id')
            ->leftJoin('dispo_status', 'dispo_trans.id_status', '=', 'dispo_status.id_status')
            ->select(
                'dispo_trans.no_disposisi',
                'petugas.nama_petugas',
                'dispo_trans.waktu_trans',
                'dispo_trans.uraian',
                'dispo_status.deskripsi_status'
            )
            ->get(); // Ambil semua data
        return view('admin.tracking.index', compact('data'));
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
    public function destroy($no_disposisi, $waktu_trans)
    {
        // Decode parameter
        $no_disposisi = base64_decode($no_disposisi);
        $waktu_trans = base64_decode($waktu_trans);
    
        try {
            $count = DB::table('dispo_trans')->where('no_disposisi', $no_disposisi)->count();
    
            if ($count == 1) {
                DB::table('dispo')
                    ->where('no_disposisi', $no_disposisi)
                    ->update([
                        'id_devisi' => null,
                        'id_status' => 1
                    ]);
            } else {
                $datakedua = DB::table('dispo_trans')
                    ->where('no_disposisi', $no_disposisi)
                    ->orderBy('waktu_trans', 'desc')
                    ->skip(1) 
                    ->first();
    
                if ($datakedua) {
                    $id_status = $datakedua->id_status;
                    $id_petugas_validasi = $datakedua->id_petugas_validasi;
    
                 
                    $petugas = DB::table('petugas')
                        ->where('id', $id_petugas_validasi)
                        ->first();
    
                    $id_devisi = $petugas ? $petugas->id_devisi : null;
    
                  
                    DB::table('dispo')
                        ->where('no_disposisi', $no_disposisi)
                        ->update([
                            'id_devisi' => $id_devisi,
                            'id_status' => $id_status
                        ]);
                }
            }
    
   
            DB::table('dispo_trans')
                ->where('no_disposisi', $no_disposisi)
                ->where('waktu_trans', $waktu_trans)
                ->delete();
    
            return redirect()->route('tracking.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('tracking.index')->with('error', 'Gagal menghapus data.');
        }
    }
    

    
}
