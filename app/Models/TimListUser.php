<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimListUser extends Model
{
    use HasFactory;
    
    protected $table = 'tim_list_user';
    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo(User::class, 'id_official', 'id');
    }

    public function atlet() 
    {
        return $this->belongsTo(Atlet::class, 'id_atlet', 'id');
    }

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'id_tim', 'id');
    }
}
