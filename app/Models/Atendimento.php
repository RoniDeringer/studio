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

class Atendimento extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'atendimento';

    protected $fillable = [
        'id_cliente',
        'id_funcionario',
        'id_terceirizado',
        'data',
        'valor',
        'servico',
        'observacao'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'id_funcionario');
    }

    public function terceirizado()
    {
        return $this->belongsTo(Terceirizado::class, 'id_terceirizado');
    }

}