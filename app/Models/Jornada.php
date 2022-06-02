<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Jornada extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'jornada';
    protected $primaryKey  = 'id_jornada';
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'dia_semana',
        'nome_horario',
        'data_hora_registro',
        'nome_pessoa_registro'
    ];
}
