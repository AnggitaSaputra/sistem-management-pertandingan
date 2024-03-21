<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListTimJadwalPertandingan extends Model
{
    use HasFactory;
    
    protected $table = 'list_tim_jadwal_pertandingan';
    protected $guarded = [];

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'id_tim', 'id');
    }
    
    public function pertandingan()
    {
        return $this->belongsTo(JadwalPertandingan::class, 'id_pertandingan', 'id');
    }
}
