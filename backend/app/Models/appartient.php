<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class appartient extends Model
{
    use HasFactory;

    protected $table = 'appartient';

    protected $fillable = [
        'idUtilisateur',
        'idGroupe',
    ];
}
