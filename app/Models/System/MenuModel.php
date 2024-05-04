<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
	use HasFactory;

	protected $table = 'tb_acl_menu';

	public function __construct()
	{
		$this->connection = env('DB_SYSTEM_CONNECTION');
	}
}
