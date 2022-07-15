<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GrupoFeriados extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'grupo_feriados';
    protected $primaryKey  = 'id_grupo_feriados';
    protected $fillable = [
        'nome'
    ];
}
