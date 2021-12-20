<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FaixaSalarial extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'faixa_salarial';
    protected $primaryKey  = 'id_faixa_salarial';
    public $timestamps = false;
    protected $fillable = [
        'id_cliente',
        'inicio',
        'fim',
        'ativo',
        'data_hora_registro',
        'nome_pessoa_registro'
    ];
}
