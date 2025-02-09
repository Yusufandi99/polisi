<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispo extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_disposisi'; // Ganti dengan primary key tabel dispo
    public $incrementing = false; // Kalau key-nya bukan auto-increment
    protected $keyType = 'string'; // Kalau bukan angka

    protected $table = 'dispo';
    public $timestamps = false;

    protected $fillable = [
        'no_disposisi',
        'id_tipe',
        'no_surat',
        'tgl_dispo',
        'prihal',
        'kepada',
        'prioritas',
        'sifat_surat',
        'file_pdf',
        'id_petugas_input',
    ];
}
