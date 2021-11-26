<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescontoTransporte extends Model
{
    use HasFactory;

    protected $table = 'desconto_transporte';
    protected $primaryKey = 'id_desconto_transporte';
}
