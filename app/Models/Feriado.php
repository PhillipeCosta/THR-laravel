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
    protected $fillable = [
        'nome_grupo',
        'descricao',
        'data_feriado',
        'nome_pessoa_registro'
    ];
}
