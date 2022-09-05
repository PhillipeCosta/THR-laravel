<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{Fornecedor, Lotacao, Empresa, TipoBeneficio};

class EmpresaBeneficio extends Model
{

    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'empresa_beneficio';
    protected $primaryKey  = 'id_empresa_beneficio';
    protected $fillable = [
        'id_lotacao',
        'id_fornecedor',
        'percentual_valor_funcionario',
        'percentual_valor_dependente',
        'id_cliente',
        'id_tipo_beneficio'
    ];

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'id_lotacao', 'id_lotacao');
    }

    public function cliente()
    {
        return $this->hasOne(Empresa::class, 'id_pessoa', 'id_cliente');
    }

    public function fornecedor()
    {
        return $this->hasOne(Fornecedor::class, 'id_fornecedor', 'id_fornecedor');
    }

    public function tipo_beneficio()
    {
        return $this->hasOne(TipoBeneficio::class, 'id_tipo_beneficio', 'id_tipo_beneficio');
    }
}
