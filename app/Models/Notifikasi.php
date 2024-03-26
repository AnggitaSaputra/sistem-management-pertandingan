<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';
    protected $guard = [];

    public function scopeRead($query, $id, $idUser, $readState)
    {
        return $query->where('id', $id)
                     ->where('user_id', $idUser)
                     ->update('read', $readState);
    }

    public function scopeCreateNotification($query, $data)
    {
        return $query->insert([
            'type' => $data['type'],
            'id_user' => $data['id_user'],
            'message' => $data['message'],
            'read' => 'unread',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
