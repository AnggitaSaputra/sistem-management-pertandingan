<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListAtletInPertandingan extends Model
{
    use HasFactory;

    protected $table = 'list_atlet_in_pertandingan';
    protected $guarded = [];

    public function atlet()
    {
        return $this->belongsTo(Atlet::class, 'id_atlet', 'id');
    }
    
    public function jadwal()
    {
        return $this->belongsTo(JadwalPertandingan::class, 'id_jadwal_pertandingan', 'id');
    }

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'id_tim', 'id');
    }
}