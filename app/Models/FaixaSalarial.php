<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{CompraBeneficio, Lotacao};

class FaixaSalarial extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'faixa_salarial';
    protected $primaryKey  = 'id_faixa_salarial';
    protected $fillable = [
        'inicio',
        'fim',
        'ativo',
        'salario_ini',
        'nome_pessoa_registro',
        'valor_desc_vr',
        'valor_desc_vt',
        'valor_desc_va',
        'id_compra_beneficio',
        'id_lotacao',
        'id_cliente',
        'salario_fim'
    ];

    public function compra_beneficio()
    {
        return $this->hasOne(CompraBeneficio::class, 'id_compra_beneficio', 'id_compra_beneficio');
    }

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'id_lotacao', 'id_lotacao');
    }

    public function cliente()
    {
        return $this->hasOne(Empresa::class, 'id_pessoa', 'id_cliente');
    }
}
