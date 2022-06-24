<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{Funcionario, Ausencia};

class Ocorrencia extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'ocorrencia';
    protected $primaryKey  = 'id_ocorrencia';
    protected $fillable = [
        'id_funcionario',
        'id_ausencia',
        'data_inicio',
        'data_fim',
        'competencia',
        'quantidade_dias',
        'observacao',
    ];


    public function ausencia()
    {
        return $this->hasOne(Ausencia::class, 'id_ausencia', 'id_ausencia');
    }

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id_funcionario', 'id_funcionario');
    }
}
