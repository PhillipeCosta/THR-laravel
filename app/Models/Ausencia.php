<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Empresa;

class Ausencia extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'ausencia';
    protected $primaryKey  = 'id_ausencia';
    protected $fillable = [
        'nome',
        'id_pessoa',
        'bh_positivo',
        'va',
        'vr',
        'vt',
    ];


    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'id_pessoa', 'id_pessoa');
    }

}
