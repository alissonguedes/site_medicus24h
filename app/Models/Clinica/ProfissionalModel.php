<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfissionalModel extends Model
{

	use HasFactory;

	protected $table    = 'tb_medico';
	protected $fillable = [
		// Dados do profissional
		'id_departamento', 'nome', 'cpf', 'rg', 'data_nascimento', 'sexo', 'cns', 'logradouro', 'numero', 'complemento', 'status',
		// Dados do registro
		'id_especialidade', 'rqe', 'conselho', 'registro', 'uf_registro',
	];

}
