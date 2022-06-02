<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Fornecedor extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'fornecedor';
    protected $primaryKey  = 'id_fornecedor';
    public $timestamps = false;
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'endereco',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'tipo_fornecedor',
        'ans',
        'telefone',
        'data_hora_registro',
        'nome_pessoa_registro',
        'inscricao_estadual',
        'tipo_beneficio',
        'pat'
    ];
/*
    public function beneficio()
    {
        //return $this->hasOne(Lotacao::class, 'tipo_beneficio', 'id_tipo_beneficio');
    }*/
}
