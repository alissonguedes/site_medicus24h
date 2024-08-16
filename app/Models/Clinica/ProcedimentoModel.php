<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcedimentoModel extends Model {
	use HasFactory;

	protected $table    = 'tb_procedimento';
	protected $fillable = ['id_categoria', 'titulo', 'descricao', 'classificacao', 'tempo', 'formato', 'valor', 'status'];

}
