<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispo;

class ListController extends Controller
{
    public function index()
    {
        $antrian = Dispo::where('id_tipe', 100)->get();
        $selesai = Dispo::where('id_tipe', 200)->get();

        return view('admin.list.index', compact('antrian', 'selesai'));
    }
}
