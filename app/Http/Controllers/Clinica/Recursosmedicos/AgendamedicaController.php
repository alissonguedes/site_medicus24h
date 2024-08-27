<?php

namespace App\Http\Controllers\Clinica\Recursosmedicos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\AgendaRequest;
use App\Models\Clinica\AgendaModel;
use App\Models\FileModel;
use Illuminate\Http\Request;

class AgendamedicaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $agenda)
	{

		return view('clinica.recursosmedicos.agenda.index');

	}

	/**
	 * Search banners
	 */
	public function search(Request $request)
	{

		// $data['pacientes'] = $paciente->search($request->search);

		// return view('clinica.pacientes.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(AgendaRequest $request, AgendaModel $agenda)
	{

		$data               = $request->all();
		$dias_semana        = ['domingo' => 0, 'segunda' => 1, 'terca' => 2, 'quarta' => 3, 'quinta' => 4, 'sexta' => 5, 'sabado' => 6];
		$categoria          = $data['categoria'];
		$horarios           = $request['horario'];
		$data['id_medico']  = $request->medico;
		$data['id_clinica'] = $request->clinica;

		unset($data['_token'], $data['_method'], $data['horario'], $data['categoria'], $data['medico'], $data['clinica']);

		// Cadastrar a agenda do médico na clínica:

		$id_agenda = $agenda->updateOrCreate([
			'id_medico'  => $data['id_medico'],
			'id_clinica' => $data['id_clinica'],
		], $data);

		$horarios_agenda = [];

		// Cadastrar os horários da agenda
		$agenda->from('tb_medico_agenda_horario')->where('id_agenda', $id_agenda->id)->delete();

		if (isset($horarios)) {

			foreach ($horarios as $dia => $horario) {

				$i              = [];
				$dia            = $dias_semana[$dia];
				$i['id_agenda'] = $id_agenda->id;
				$i['dia']       = $dia;
				$hora           = array_combine($horario['inicio'], $horario['fim']);

				foreach ($hora as $inicio => $fim) {

					$ini_format  = (preg_match('/^[0-9]{2}\:[0-9]{2}$/', $inicio) ? $inicio : $inicio . ':00') . ':00';
					$fim_format  = (preg_match('/^[0-9]{2}\:[0-9]{2}$/', $fim) ? $fim : $fim . ':00') . ':00';
					$i['inicio'] = $ini_format;
					$i['fim']    = $fim_format;

					$agenda->from('tb_medico_agenda_horario')->insert($i);

				}

			}

		}

		return redirect()->route('clinica.recursosmedicos.agenda.medico', [$request->medico, $request->clinica])->with(['message' => 'Agenda atualizada com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request)
	{

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request)
	{

		// return redirect()->route('clinica.pacientes.index')->with(['message' => $message]);

	}
}
