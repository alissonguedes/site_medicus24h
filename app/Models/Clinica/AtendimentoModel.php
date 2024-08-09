<?php

namespace App\Models\Clinica;

use App\Models\Clinica\Model;

class AtendimentoModel extends Model
{

	protected $table = 'tb_atendimento';

	protected $fillable = ['id_paciente', 'created_at', 'updated_at'];

}
