<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{FaixaSalarial, Lotacao, FaixaEtaria, Jornada};

class Funcionario extends Model
{
    use Uuid;
    use HasFactory, Notifiable;
    protected $table = 'funcionario';
    protected $primaryKey  = 'id_funcionario';
    protected $fillable = [
        'matricula',
        'nome',
        'ativo',
        'centro_custo',
        'cargo',
        'cpf',
        'pis',
        'data_admissao',
        'data_demissao',
        'data_adesao_plano',
        'id_lotacao',
        'id_faixa_salarial',
        'id_desconto_faixa_etaria',
        'rg',
        'id_jornada',
        'numero_cartao',
        'salario',
        'numero_centro_custo',
        'total_desconto_va',
        'total_desconto_vr',
        'nome_pessoa_registro'
    ];


    public function faixa_etaria()
    {
        return $this->hasOne(FaixaEtaria::class, 'id_desconto_faixa_etaria', 'id_desconto_faixa_etaria');
    }

    public function faixa_salarial()
    {
        return $this->hasOne(FaixaSalarial::class, 'id_faixa_salarial', 'id_faixa_salarial');
    }

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'id_lotacao', 'id_lotacao');
    }

    public function jornada()
    {
        return $this->hasOne(Jornada::class, 'id_jornada', 'id_jornada');
    }
}
