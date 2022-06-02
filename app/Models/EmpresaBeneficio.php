<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{Fornecedor, Lotacao};

class EmpresaBeneficio extends Model
{

    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'empresa_beneficio';
    protected $primaryKey  = 'id_empresa_beneficio';
    public $timestamps = false;
    protected $fillable = [
        'id_lotacao',
        'id_fornecedor',
        'percentual_valor_funcionario',
        'percentual_valor_dependente'
    ];

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'id_lotacao', 'id_lotacao');
    }

    public function fornecedor()
    {
        return $this->hasOne(Fornecedor::class, 'id_fornecedor', 'id_fornecedor');
    }
}
