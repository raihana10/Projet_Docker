<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'id_from',
        'id_to',
        'group_id',
        'description',
        'status',
    ];
}
