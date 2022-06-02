<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{Empresa, Feriado};

class Lotacao extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'lotacao';
    protected $primaryKey  = 'id_lotacao';
    public $timestamps = false;
    protected $fillable = [
        'id_pessoa',
        'lotacao',
        'ativo',
        'data_hora_registro',
        'nome_pessoa_registro',
        'nome_grupo_feriados',
        'id_feriado'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('lotacao', 'like', '%'.$search.'%');
        });
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'id_pessoa', 'id_pessoa');
    }

    public function feriado()
    {
        return $this->hasOne(Feriado::class, 'id_feriado', 'id_feriado');
    }
}
