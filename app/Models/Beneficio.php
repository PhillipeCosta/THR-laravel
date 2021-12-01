<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Beneficio extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'beneficio';
    protected $primaryKey  = 'id_beneficio';
    public $timestamps = false;
    protected $fillable = [
        'tipo_beneficio',
        'beneficio',
        'colaboracao_empresa',
        'data_hora_registro',
        'de',
        'ate',
        'desconto_dependente',
        'fim',
        'inicio',
        'nome_pessoa_registro'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('beneficio', 'like', '%'.$search.'%');
        });
    }

}
