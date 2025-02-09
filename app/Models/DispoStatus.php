<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispoStatus extends Model
{
    use HasFactory;

    protected $table = 'dispo_status'; 
    protected $primaryKey = 'id_status'; 
    protected $fillable = ['deskripsi_status']; 
}

