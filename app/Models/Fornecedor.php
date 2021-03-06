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
        'nome_pessoa_registro',
        'inscricao_estadual',
        'id_tipo_beneficio',
        'pat'
    ];

    public function beneficio()
    {
        return $this->hasOne(TipoBeneficio::class, 'id_tipo_beneficio', 'id_tipo_beneficio');
    }
}
