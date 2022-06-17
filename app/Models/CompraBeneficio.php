<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{Fornecedor, Lotacao};

class CompraBeneficio extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'compra_beneficio';
    protected $primaryKey  = 'id_compra_beneficio';
    protected $fillable = [
        'id_lotacao',
        'id_fornecedor',
        'tipo_beneficio',
        'vigencia',
        'valor_diario',
        'nome_pessoa_registro'
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
