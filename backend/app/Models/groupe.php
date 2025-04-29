<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class groupe extends Model
{
    use HasFactory;

    protected $table = 'groupe';

    protected $primaryKey = 'idGroupe';

    protected $fillable = [
        'nom_groupe',
        'join_code',
    ];
}
