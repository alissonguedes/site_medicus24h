<?php

namespace App\Models\Clinica;

use App\Models\Clinica\Model;

class AgendaModel extends Model {

	protected $table = 'tb_medico_agenda';

	protected $fillable = ['id_medico_clinica', 'dia', 'semana', 'mes', 'ano', 'titulo', 'observacao', 'atende', 'created_at', 'updated_at', 'id_agenda', 'horarios'];

}
