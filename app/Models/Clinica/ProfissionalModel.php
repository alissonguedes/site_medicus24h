<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfissionalModel extends Model {

	use HasFactory;

	protected $table    = 'tb_profissional';
	protected $fillable = ['id_departamento', 'nome', 'cpf', 'rg', 'data_nascimento', 'sexo', 'cns', 'logradouro', 'numero', 'complemento', 'status',
		'id_especialidade', 'rqe', 'conselho', 'registro', 'uf_registro'];

}
