<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GrauParentesco extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'grau_parentesco';
    protected $primaryKey  = 'id_grau_parentesco';
    protected $fillable = [
        'nome',
        'nome_pessoa_registro'
    ];
}
