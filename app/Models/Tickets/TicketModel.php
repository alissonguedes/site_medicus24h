<?php

namespace App\Models\Tickets;

use App\Models\Tickets\Model;

class TicketModel extends Model
{

	protected $table = 'tb_ticket';

	protected $fillable = ['id_paciente', 'created_at', 'updated_at'];

}
