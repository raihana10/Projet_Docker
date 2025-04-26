<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateur';

    protected $primaryKey = 'idUtilisateur';

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mot_de_passe' => 'hashed',
        ];
    }

}
