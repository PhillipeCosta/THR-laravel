<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{FaixaEtaria, GrauParentesco, Funcionario};

class Dependente extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'dependentes';
    protected $primaryKey  = 'id_dependentes';
    protected $fillable = [
        'tipo',
        'matricula_funcionario',
        'nome_funcionario',
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'id_parentesco',
        'nome_mae',
        'id_funcionario',
        'id_desconto_faixa_etaria',
        'nome_pessoa_registro'
    ];


    public function faixa_etaria()
    {
        return $this->hasOne(FaixaEtaria::class, 'id_desconto_faixa_etaria', 'id_desconto_faixa_etaria');
    }

    public function grau_parentesco()
    {
        return $this->hasOne(GrauParentesco::class, 'id_grau_parentesco', 'id_parentesco');
    }

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id_funcionario', 'id_funcionario');
    }
}
