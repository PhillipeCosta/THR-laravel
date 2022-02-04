<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Cliente;

class DescontoTransporte extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'desconto_transporte';
    protected $primaryKey  = 'id_desconto_transporte';
    public $timestamps = false;
    protected $fillable = [
        'id_faixa_salarial',
        'id_cliente',
        'valor',
        'ativo',
        'data_hora_registro',
        'nome_pessoa_registro'
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function faixa()
    {
        return $this->hasOne(FaixaSalarial::class, 'id_faixa_salarial', 'id_faixa_salarial');
    }
}
