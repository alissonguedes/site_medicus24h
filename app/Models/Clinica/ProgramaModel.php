<?php

namespace App\Models\Clinica;

use App\Models\Clinica\Model;

class ProgramaModel extends Model
{

	protected $table = 'tb_programas';

	protected $fillable = ['titulo', 'descricao', 'publico', 'faixa_etaria'];

}
