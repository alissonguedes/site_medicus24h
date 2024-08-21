<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuncionarioModel extends Model
{
	use HasFactory;

	protected $table    = 'tb_funcionario';
	protected $fillable = [
		'id_departamento', 'perfil', 'nome', 'cpf', 'rg', 'data_nascimento', 'sexo', 'cns', 'logradouro', 'numero', 'complemento', 'status',
	];

}
