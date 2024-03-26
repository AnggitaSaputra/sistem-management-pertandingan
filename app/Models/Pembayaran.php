<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    
    protected $table = 'pembayaran';
    protected $guarded = [];

    public function tim() 
    {
        return $this->belongsTo(Tim::class, 'id_tim', 'id')->with('user');
    }

    public function pertandingan()
    {
        return $this->belongsTo(JadwalPertandingan::class, 'id_pertandingan', 'id');
    }
}
