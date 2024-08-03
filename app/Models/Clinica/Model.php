<?php

namespace App\Models\Clinica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as MainModel;

class Model extends MainModel
{

	use HasFactory;

	public function __construct()
	{
		$this->connection = env('DB_CLINICA_CONNECTION');
	}

}
