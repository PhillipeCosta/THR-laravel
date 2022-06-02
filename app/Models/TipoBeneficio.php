<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoBeneficio extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'tipo_beneficio';
    protected $primaryKey  = 'id_tipo_beneficio';
    public $timestamps = false;
    protected $fillable = [
        'tipo'
    ];
}
