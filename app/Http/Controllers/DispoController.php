<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispo;
use App\Models\Petugas;

class DispoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dispo.index');
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
        $request->validate([
            'id_tipe'         => 'required',
            'nomor_surat'     => 'required',
            'nomor_disposisi' => 'required',
            'tanggal_surat'   => 'required|date',
            'prihal'          => 'required',
            'kepada'          => 'required',
            'prioritas'       => 'required',
            'sifat_surat'     => 'required',
            'pdf'             => 'required',
        ]);
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
        
            // Paksa gunakan no_disposisi dan hilangkan karakter '/'
            $noDisposisi = preg_replace('/[\/\s]+/', '_', $request->input('no_disposisi'));
        
            $extension = $file->getClientOriginalExtension();
        
            if (empty($extension) || strtolower($extension) !== 'pdf') {
                $extension = 'pdf';
            }
        
            $filename = $noDisposisi . '.' . $extension;
        
            $destinationPath = public_path('uploads/dispo');
        
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
        
            $file->move($destinationPath, $filename);
        
            $pdfPath = $filename;
        } else {
            $pdfPath = null;
        }
        
        $petugas = Petugas::where('id', session('user_id'))->first();
        if ($petugas) {
            $dispo = new Dispo();
            $dispo->id_tipe             = $request->input('id_tipe');
            $dispo->no_surat            = $request->input('nomor_surat');
            $dispo->no_disposisi     = $request->input('nomor_disposisi');
            $dispo->tgl_dispo           = $request->input('tanggal_surat');
            $dispo->prihal              = $request->input('prihal');
            $dispo->kepada              = $request->input('kepada');
            $dispo->prioritas           = $request->input('prioritas');
            $dispo->sifat_surat         = $request->input('sifat_surat');
            $dispo->file_pdf            = $pdfPath;
            $dispo->id_petugas_input    = session('user_id');
            $dispo->id_devisi           = $petugas->id_devisi;
            $dispo->id_status           = '1';
            $dispo->save();
        } else {
            return back()->withErrors('Data petugas tidak ditemukan.');
        }

        if ($dispo) {
            return redirect()->route('edit.index')->with('success', 'Data berhasil diperbarui.');
        } 
        
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        
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
   public function update(Request $request, $id)
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

    public function getDispoByNoDisposisi(Request $request)
{
    $no_disposisi = $request->query('no_disposisi');

    if (!$no_disposisi) {
        return response()->json(['error' => 'No disposisi tidak ditemukan'], 400);
    }

    $dispo = Dispo::where('no_disposisi', $no_disposisi)->first();

    if (!$dispo) {
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    return response()->json($dispo);
}

}
