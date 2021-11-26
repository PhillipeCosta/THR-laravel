<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory, Uuid;
    protected $table = 'beneficio';

    protected $primaryKey  = 'id_beneficio';
    public $timestamps = false;
    protected $fillable = [
        'tipo_beneficio',
        'beneficio',
        'colaboracao_empresa',
        'data_hora_registro',
        'de',
        'ate',
        'desconto_dependente',
        'fim',
        'inicio',
        'nome_pessoa_registro'
    ];
}
