<?php

namespace App\Http\Controllers;

use App\Models\Dispo;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.edit.index');
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
    public function edit(Request $request, $id)
    {
        //
    }

  public function update(Request $request, $id)
{
    // 🔄 Ganti '-' kembali menjadi '/'
    $id = str_replace('-', '/', $id);

    if ($request->expectsJson()) {
        return response()->json(['debug' => 'Request terbaca sebagai JSON']);
    }

    $request->validate([
        'id_tipe'         => 'required',
        'nomor_surat'     => 'required',
        'nomor_disposisi' => 'required',
        'tanggal_surat'   => 'required|date',
        'prihal'          => 'required',
        'kepada'          => 'required',
        'prioritas'       => 'required',
        'sifat_surat'     => 'required',
        'pdf'             => 'nullable|mimes:pdf',
    ]);

    try {
        $dispo = Dispo::where('no_disposisi', $id)->firstOrFail();
        $pdfPath = $dispo->file_pdf;

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');

            // Paksa gunakan no_disposisi tanpa '/'
            $noDisposisi = preg_replace('/[\/\s]+/', '_', $request->input('nomor_disposisi'));

            $filename = $noDisposisi . '.pdf';
            $destinationPath = public_path('uploads/dispo');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Hapus file lama jika ada
            if (!empty($dispo->file_pdf) && file_exists($destinationPath . '/' . $dispo->file_pdf)) {
                unlink($destinationPath . '/' . $dispo->file_pdf);
            }

            // Simpan file baru
            $file->move($destinationPath, $filename);
            $pdfPath = $filename;
        }

        $dispo->update([
            'id_tipe'      => $request->input('id_tipe'),
            'no_surat'     => $request->input('nomor_surat'),
            'no_disposisi' => $request->input('nomor_disposisi'),
            'tgl_dispo'    => $request->input('tanggal_surat'),
            'prihal'       => $request->input('prihal'),
            'kepada'       => $request->input('kepada'),
            'prioritas'    => $request->input('prioritas'),
            'sifat_surat'  => $request->input('sifat_surat'),
            'file_pdf'     => $pdfPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

    
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
