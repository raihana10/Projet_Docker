<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    // Si tu n'as pas besoin de timestamps, tu peux désactiver :
    // public $timestamps = false;

    // Remplissage en masse
    protected $fillable = [
        'group_id',
        'id_from',
        'id_to',
        'value',
        'description',
        'status',
    ];
}
