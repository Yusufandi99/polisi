<?php

namespace App\Http\Controllers;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProsesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = session('user_id'); 
        $petugas = Petugas::where('id', $userId)->first(); 
        
        $statusList = DB::table('dispo_status')->get();
        $devisiList = DB::table('devisi')->get();
    
        return view('admin.proses.index', [
            'petugas' => $petugas,
            'statusList' => $statusList,
            'devisiList' => $devisiList
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_disposisi' => 'required',
            'id_petugas_validasi' => 'required',
            'uraian' => 'required',
            'id_status' => 'required',
            'id_devisi' => 'required'
        ]);
    
        try {
            DB::beginTransaction();
    
            DB::table('dispo_trans')->insert([
                'no_disposisi' => $validatedData['no_disposisi'],
                'id_petugas_validasi' => $validatedData['id_petugas_validasi'],
                'waktu_trans' => now(),
                'uraian' => $validatedData['uraian'],
                'id_status' => $validatedData['id_status']
            ]);
    
            DB::table('dispo')
                ->where('no_disposisi', $validatedData['no_disposisi'])
                ->update([
                    'id_status' => $validatedData['id_status'],
                    'id_devisi' => $validatedData['id_devisi']
                ]);
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Disposisi berhasil disimpan.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function checkValidasi(Request $request)
    {
        $validated = DB::table('dispo_trans')
            ->join('dispo_status', 'dispo_trans.id_status', '=', 'dispo_status.id_status')
            ->where('dispo_trans.no_disposisi', $request->no_disposisi)
            ->where('dispo_trans.id_petugas_validasi', session('user_id'))
            ->select('dispo_trans.id_status', 'dispo_status.closing', 'dispo_trans.waktu_trans')
            ->orderByDesc('dispo_trans.waktu_trans') 
            ->first(); 
    
        return response()->json([
            'validated' => !is_null($validated), 
            'id_status' => $validated->id_status ?? null,
            'closing' => $validated->closing ?? null,
            'waktu_trans' => $validated->waktu_trans ?? null, 
        ]);
    }
    
    

}