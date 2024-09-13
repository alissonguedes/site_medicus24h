<?php

namespace App\Http\Controllers\Clinica\Recursosmedicos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\AgendaRequest;
use App\Models\Clinica\AgendaModel;
use App\Models\FileModel;
use Illuminate\Http\Request;

class AgendamedicaController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, AgendaModel $agenda) {

		return view('clinica.recursosmedicos.agenda.index');

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

	public function agenda(AgendaModel $agenda_model) {

		$data              = request('data') ?? date('Y-m-d'); // data que vem do calendario na requisição
		$data_time         = strtotime($data); // transforma a data da requisição em inteiro
		$primeira_data_mes = 1; // primeira data do mês
		$ultima_data_mes   = date('Y-m-', strtotime($data)) . date('t', strtotime($data)); // A última data do mês (28|29; 30|31)
		$data_fim_time     = strtotime($ultima_data_mes); // transforma a última data do mês em inteiro
		$ano               = date('Y', $data_time); // ano da data
		$mes               = date('m', $data_fim_time); // mês da data
		$ultima_data_mes   = date('t', strtotime($data)); // última data do mês
		$dia_semana_ativo  = date('w', $data_time); // o dia da semana que está disponível para atendimento (vem do Banco de dados)
		$repetir           = null; // o dia da semana que deve se repetir o evento (vem do Banco de dados)
		$dias_agenda       = [];
		$dias_ativos       = [];
		$dias_inativos     = [];

		$agenda = $agenda_model->select('id', 'id_medico', 'id_clinica', 'titulo', 'duracao', 'tempo_min_agendamento', 'tempo_max_agendamento', 'intervalo', 'max_agendamento', 'repetir')
			->from('tb_medico_agenda AS A')
			->get();

		if ($agenda->count() > 0) {

			foreach ($agenda as $a) {

				$id                    = $a->id;
				$id_medico             = $a->id_medico;
				$medico_model          = $agenda_model->select('nome', 'crm')->from('tb_medico')->where('id', $a->id_medico)->first();
				$medico                = $medico_model->nome;
				$crm                   = $medico_model->crm;
				$id_clinica            = $a->id_clinica;
				$clinica               = $agenda_model->select('razao_social')->from('tb_empresa')->where('id', $a->id_clinica)->first();
				$clinica               = $clinica->razao_social;
				$titulo                = $a->titulo;
				$duracao               = $a->duracao;
				$tempo_min_agendamento = $a->tempo_min_agendamento;
				$tempo_max_agendamento = $a->tempo_max_agendamento;
				$intervalo             = $a->intervalo;
				$max_agendamento       = $a->max_agendamento;
				$repetir               = $a->repetir;

				$horarios = $agenda_model->from('tb_medico_agenda_horario')
					->where('id_agenda', $a->id)
					->orderBy('dia', 'asc')
					->orderBy('inicio', 'asc')
					->orderBy('fim', 'asc')
					->get();

				for ($d = $primeira_data_mes; $d <= $ultima_data_mes; $d++) {

					$time = strtotime($ano . '-' . $mes . '-' . $d);

					if ($horarios->count() > 0) {

						foreach ($horarios as $h) {

							$dia    = (int) $h->dia;
							$inicio = $h->inicio;
							$fim    = $h->fim;

							if ($dia == date('w', $time)) {
								$dias_ativos[] = date('Y-m-d', $time);
							}

						}

					}

					if (!in_array(date('Y-m-d', $time), $dias_ativos)) {
						$dias_inativos[] = date('Y-m-d', $time);
					}

				}

			}

		}

		if (request()->ajax()) {
			return response()->json(['dias_ativos' => $dias_ativos, 'dias_inativos' => $dias_inativos]);
		} else {
			$dados['clinicas'] = 'clinica';
			return view('clinica.agendamentos.index', $dados);
		}

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(AgendaRequest $request, AgendaModel $agenda) {

		$data                          = $request->all();
		$dias_semana                   = ['domingo' => 0, 'segunda' => 1, 'terca' => 2, 'quarta' => 3, 'quinta' => 4, 'sexta' => 5, 'sabado' => 6];
		$categoria                     = $data['categoria'];
		$horarios                      = $data['horario'];
		$especialidades                = $data['especialidades'];
		$data['id_medico']             = $request->medico;
		$data['id_clinica']            = $request->clinica;
		$data['tempo_max_agendamento'] = $request->tempo_max_agendamento ?? null;
		$data['tempo_min_agendamento'] = $request->tempo_min_agendamento ?? null;
		$data['intervalo']             = $request->intervalo ?? null;
		$data['max_agendamento']       = $request->max_agendamento ?? null;

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

		// Cadastrar as especialidades que atendem pela agenda na clínica.

		if (isset($especialidades)) {

			$agenda->from('tb_medico_agenda_especialidade')->where('id_agenda', $id_agenda->id)->delete();

			foreach ($especialidades as $e) {

				$i                     = [];
				$i['id_agenda']        = $id_agenda->id;
				$i['id_especialidade'] = $e;

				$agenda->from('tb_medico_agenda_especialidade')->insert($i);

			}

		}

		return redirect()->route('clinica.recursosmedicos.agenda.medico', [$request->medico, $request->clinica])->with(['message' => 'Agenda atualizada com sucesso!']);

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
