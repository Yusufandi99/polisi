<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispo;

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

            $nomorSurat = preg_replace('/\s+/', '_', $request->input('nomor_surat'));

            $extension = $file->getClientOriginalExtension();

            if (empty($extension) || strtolower($extension) !== 'pdf') {
                $extension = 'pdf';
            }

            $filename = $nomorSurat . '.' . $extension;

            $destinationPath = public_path('uploads/dispo');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);

            $pdfPath = $filename;
        } else {
            $pdfPath = null;
        }

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
        $dispo->id_petugas_input    = '1';
        $dispo->save();

        if ($dispo) {
            return redirect()->route('dispo.index')->with('success', 'Data berhasil disimpan.');
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
