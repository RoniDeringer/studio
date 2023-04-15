<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'funcionario';

    protected $fillable = [
        'id_user',
        'cargo',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
