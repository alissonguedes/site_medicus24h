<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartamentoModel extends Model {

	use HasFactory;

	protected $table    = 'tb_departamento';
	protected $fillable = ['titulo', 'descricao', 'is_deleted', 'deleted_at'];

}
