<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class debt extends Model
{
    use HasFactory;

    protected $table = 'debt';

    protected $primaryKey = 'idDebt';

    protected $fillable = [
        'idFrom',
        'idTo',
        'idGrp',
        'montant',
        'status',
        'description',
        'date',
    ];
}
