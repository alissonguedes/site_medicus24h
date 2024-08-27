<?php

namespace App\Models\Clinica;

use App\Models\Clinica\Model;

class AgendaModel extends Model
{

	protected $table = 'tb_medico_agenda';

	protected $fillable = [
		'id_medico',
		'id_clinica',
		'titulo',
		'observacao',
		'duracao',
		'tempo_min_agendamento',
		'tempo_max_agendamento',
		'intervalo',
		'max_agendamento',
		'repetir',
		'created_at',
		'updated_at',
		'horarios',
		'status',
	];

}
