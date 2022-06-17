<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Fornecedor;

class FaixaEtaria extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'desconto_faixa_etaria';
    protected $primaryKey  = 'id_desconto_faixa_etaria';
    protected $fillable = [
        'id_fornecedor',
        'faixa_idade',
        'tipo_plano',
        'vigencia',
        'valor_dependente',
        'valor_funcionario',
        'nome_pessoa_registro'
    ];

    public function fornecedor()
    {
        return $this->hasOne(Fornecedor::class, 'id_fornecedor', 'id_fornecedor');
    }
}
