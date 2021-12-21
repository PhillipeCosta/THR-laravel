<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ComprasRefeicao extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'compras_refeicao';
    protected $primaryKey  = 'id_compras_refeicao';
    public $timestamps = false;
    protected $fillable = [
        'id_cliente',
        'id_lotacao',
        'valor',
        'inicio',
        'fim',
        'data_hora_registro',
        'nome_pessoa_registro',
        'tipo'
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'id_lotacao', 'id_lotacao');
    }
}
