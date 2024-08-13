<?php

namespace App\Http\Controllers\Clinica\Recursosmedicos;

use App\Http\Controllers\Controller;
use App\Models\Clinica\AgendaModel;
use App\Models\FileModel;
use Illuminate\Http\Request;

class AgendamedicaController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $agenda) {

		$data['horarios'] = $agenda->select('A.id', 'C.id_medico', 'horarios')
			->from('tb_medico_agenda AS A')
			->join('tb_medico_agenda_horario AS H', 'H.id_agenda', 'A.id')
			->join('tb_medico_clinica AS C', 'C.id', 'A.id_medico_clinica')
			->get();

		return view('clinica.recursosmedicos.agenda.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request) {

		// $data['pacientes'] = $paciente->search($request->search);

		// return view('clinica.pacientes.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, AgendaModel $agenda) {

		$request->validate([
			'medico' => 'required',
		]);
		$horarios          = $request->horario;
		$id_medico_clinica = $agenda->from('tb_medico_clinica')->select('id')->where('id_medico', $request->medico)->get()->first();

		$dias_semana = [
			'domingo' => 0,
			'segunda' => 1,
			'terca'   => 2,
			'quarta'  => 3,
			'quinta'  => 4,
			'sexta'   => 5,
			'sabado'  => 6,
		];

		$horarios_agenda = [];

		foreach ($horarios as $dia => $horario) {
			$dia                   = $dias_semana[$dia];
			$horarios_agenda[$dia] = array_combine($horario['inicio'], $horario['fim']);
		}

		$agenda_medico = [
			'id_medico_clinica' => $id_medico_clinica->id,
			// 'dia'               => $dia,
		];

		$id_agenda = $agenda->updateOrCreate([
			'id_medico_clinica' => $id_medico_clinica->id,
		], $agenda_medico);

		$agenda->from('tb_medico_agenda_horario')->where('id_agenda', $id_agenda->id)->delete();

		$agenda->from('tb_medico_agenda_horario')->insert([
			'id_agenda' => $id_agenda->id,
			'horarios'  => json_encode($horarios_agenda),
		]);

		return redirect()->route('clinica.recursosmedicos.agenda.index')->with(['message' => 'Agenda atualizada com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request) {

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request) {

		// return redirect()->route('clinica.pacientes.index')->with(['message' => $message]);

	}
}
