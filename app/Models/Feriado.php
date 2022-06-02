<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feriado extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'feriado';
    protected $primaryKey  = 'id_feriado';
    public $timestamps = false;
    protected $fillable = [
        'nome_grupo',
        'descricao',
        'data',
        'data_hora_registro',
        'nome_pessoa_registro'
    ];
}
