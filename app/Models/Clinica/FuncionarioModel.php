<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuncionarioModel extends Model {
	use HasFactory;

	protected $table    = 'tb_funcionario';
	protected $fillable = ['perfil', 'id_departamento', 'nome', 'cpf', 'rg', 'data_nascimento', 'status'];

}
