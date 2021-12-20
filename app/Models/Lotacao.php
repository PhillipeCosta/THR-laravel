<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Cliente;

class Lotacao extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'lotacao';
    protected $primaryKey  = 'id_lotacao';
    public $timestamps = false;
    protected $fillable = [
        'id_cliente',
        'lotacao',
        'ativo',
        'data_hora_registro',
        'nome_pessoa_registro'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('lotacao', 'like', '%'.$search.'%');
        });
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
