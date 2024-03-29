<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasListUser extends Model
{
    use HasFactory;

    protected $table = 'kelas_list_user';
    protected $guarded = [];

    public function atlet()
    {
        return $this->belongsTo(Atlet::class, 'id_atlet', 'id');
    }
    
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
