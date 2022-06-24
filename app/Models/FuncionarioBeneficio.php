<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{Fornecedor, Funcionario};

class FuncionarioBeneficio extends Model
{

    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'funcionario_beneficio';
    protected $primaryKey  = 'id_funcionario_beneficio';
    protected $fillable = [
        'id_funcionario',
        'id_fornecedor',
        'valor_unitario',
        'quantidade',
        'data_vigencia'
    ];

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id_lotacao', 'id_lotacao');
    }

    public function fornecedor()
    {
        return $this->hasOne(Fornecedor::class, 'id_fornecedor', 'id_fornecedor');
    }
}
