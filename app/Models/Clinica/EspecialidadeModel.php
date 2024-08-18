<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EspecialidadeModel extends Model {

	use HasFactory;

	protected $table    = 'tb_especialidade';
	protected $fillable = ['especialidade', 'descricao', 'status'];

}
