<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateDebt extends Model
{
    protected $fillable = [
        'name',
        'value',
        'id_from',
        'id_to',
        'description',
        'status',
    ];

    public function fromUser() {
        return $this->belongsTo(\App\Models\User::class, 'id_from');
    }

    public function toUser() {
        return $this->belongsTo(\App\Models\User::class, 'id_to');
    }
}
