<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'pessoa';
    protected $primaryKey  = 'id_pessoa';
    public $timestamps = false;
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'endereco',
        'numero_endereco',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'codigo_empresa_folha',
        'inscricao_estadual',
        'cnae',
        'telefone',
        'contato',
        'data_hora_registro',
        'nome_pessoa_registro',
        'tipo'
    ];
/*
    public function beneficio()
    {
        //return $this->hasOne(Lotacao::class, 'tipo_beneficio', 'id_tipo_beneficio');
    }*/
}
