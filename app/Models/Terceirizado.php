<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terceirizado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'terceirizado';

    protected $fillable = [
        'id_user',
        'funcao',
        'observacao',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
