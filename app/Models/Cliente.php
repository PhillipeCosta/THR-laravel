<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'cliente';
    protected $primaryKey  = 'id_cliente';
    public $timestamps = false;
    protected $fillable = [
        'cliente',
        'ativo',
        'desconta_plano_saude',
        'desconta_plano_odontologico',
        'desconta_plano_vida',
        'data_hora_registro',
        'nome_pessoa_registro'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('cliente', 'like', '%'.$search.'%');
        });
    }

}
