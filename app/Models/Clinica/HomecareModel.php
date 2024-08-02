<?php

namespace App\Models\Clinica;

use App\Models\Clinica\Model;

class HomecareModel extends Model
{

	protected $table = 'tb_paciente_homecare';

	protected $fillable = ['id_paciente', 'created_at', 'updated_at'];

}
