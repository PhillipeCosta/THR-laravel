<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\GrupoFeriados;

class Feriado extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'feriado';
    protected $primaryKey  = 'id_feriado';
    protected $fillable = [
        'descricao',
        'data_feriado',
        'nome_pessoa_registro',
        'id_grupo_feriados'
    ];

    public function grupo_feriados()
    {
        return $this->hasOne(GrupoFeriados::class, 'id_grupo_feriados', 'id_grupo_feriados');
    }
}
