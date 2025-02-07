<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Authenticatable 
{
    use HasFactory;
    public $timestamps = false; 

    protected $table = 'petugas';

    protected $fillable = [
        'nama_petugas',
        'id_devisi',
        'jabatan',
        'user_login',
        'pass_login',
    ];

    protected $hidden = [
        'pass_login', 
    ];
}