<?php

// Admin Controllers
// use App\Http\Controllers\Admin\ApresentacaoController as Apresentacao;
// use App\Http\Controllers\Admin\A_IbrController as A_Ibr;
// use App\Http\Controllers\Admin\BannersController as Banners;
// use App\Http\Controllers\Admin\PastoresController as Pastores;
use App\Http\Controllers\APIController as API;

// Clinica Controllers
use App\Http\Controllers\Clinica\DepartamentosController as Departamentos;
use App\Http\Controllers\Clinica\EspecialidadesController as Especialidades;
use App\Http\Controllers\Clinica\Funcionarios\FuncionariosController as Funcionarios;
use App\Http\Controllers\Clinica\Funcionarios\PerfisController as Perfis;
use App\Http\Controllers\Clinica\Homecare\GestaoDeCuidadosController as Homecare;
use App\Http\Controllers\Clinica\Homecare\PacientesController as PacientesHomecare;
use App\Http\Controllers\Clinica\HomeController as ClinicaHome;
use App\Http\Controllers\Clinica\PacientesController as Pacientes;
use App\Http\Controllers\Clinica\ProcedimentosController as Procedimentos;
use App\Http\Controllers\Clinica\ProfissionaisController as Profissionais;
use App\Http\Controllers\Clinica\Recursosmedicos\AgendamedicaController as Agendamedica;
use App\Http\Controllers\Clinica\UnidadesController as Unidades;

// Main Controllers

// Site Controllers
use App\Http\Controllers\Site\HomeController;

// Clinica Requests

// Models
use App\Models\Clinica\AgendaModel;

// Illuminate
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {

	Route::get('/', [HomeController::class, 'index'])->name('site.index');

});

Route::get('/profile/image/preview/{file_categ}/{file_id}', [API::class, 'show_image_profile'])->name('clinica.show-image-profile');

Route::middleware([
	'auth',
	'verified',
])->prefix('/clinica')->group(function () {

	Route::get('/', function () {
		return redirect()->route('clinica.dashboard');
	})->name('clinica.index');

	Route::get('/dashboard', [ClinicaHome::class, 'index'])->name('clinica.dashboard');
	// Route::get('/agenda', [ClinicaHome::class, 'index'])->name('clinica.recursosmedicos.agenda.index');

	// Atendimentos
	Route::prefix('/atendimentos')->group(function () {
		Route::get('/tipos/{search?}', function () {
			$atendimentos = [];
			$atendimento  = DB::connection('medicus')
				->table('tb_atendimento_tipo')
				->select('tipo', 'id')
				->whereAny(['tipo'], 'like', request('search') . '%')
				->get();

			if ($atendimento->count() > 0) {
				foreach ($atendimento as $p) {
					$atendimentos[] = ['text' => $p->tipo, 'id' => $p->id];
				}
			}

			return $atendimentos;
		})->name('clinica.atendimentos.tipos.autocomplete');

		Route::get('/categorias/{search?}', function () {
			$atendimentos = [];
			$atendimento  = DB::connection('medicus')
				->table('tb_categoria_descricao')
				->select('titulo AS tipo', 'id_categoria AS id')
				->whereAny(['titulo'], 'like', request('search') . '%')
				->get();

			if ($atendimento->count() > 0) {
				foreach ($atendimento as $p) {
					$atendimentos[] = ['text' => $p->tipo, 'id' => $p->id];
				}
			}

			return $atendimentos;
		})->name('clinica.atendimentos.categorias.autocomplete');
	});

	// Pacientes
	Route::prefix('/pacientes')->group(function () {

		Route::get('/', [Pacientes::class, 'index'])->name('clinica.pacientes.index');
		Route::get('/q/{search?}', [Pacientes::class, 'search'])->name('clinica.pacientes.search');
		Route::get('/a/{search?}', function () {
			$pacientes = [];
			$paciente  = DB::connection('medicus')
				->table('tb_paciente AS P')
				->select('nome', 'id', 'cpf', 'matricula')
				->whereAny(['nome', 'cpf', 'matricula'], 'like', request('search') . '%')
				->get();

			if ($paciente->count() > 0) {
				foreach ($paciente as $p) {
					$pacientes[] = ['text' => $p->nome . ' - ' . format($p->cpf), 'id' => $p->id];
				}
			}

			return $pacientes;
		})->name('clinica.pacientes.autocomplete');
		Route::get('/id/{id}', [Pacientes::class, 'index'])->name('clinica.pacientes.edit');
		Route::post('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
		Route::put('/', [Pacientes::class, 'update'])->name('clinica.pacientes.post');
		Route::delete('/', [Pacientes::class, 'destroy'])->name('clinica.pacientes.delete');

		Route::get('/{id}/dados', function () {

			$id = request('id');

			$pacientes = [];
			$result    = DB::connection('medicus')
				->table('tb_paciente AS P')
				->select('*', DB::raw('DATE_FORMAT(data_nascimento, "%d/%m/%Y") AS data_nascimento'))
				->where('id', request('id'))
				->get()
				->first();

			$paciente['mae']             = $result->mae ?? null;
			$paciente['pai']             = $result->pai ?? null;
			$paciente['data_nascimento'] = $result->data_nascimento ?? null;
			$paciente['cpf']             = $result->cpf ?? null;
			$paciente['telefone']        = $result->telefone ?? null;
			$paciente['convenio']        = $result->convenio ?? null;
			$paciente['matricula']       = $result->matricula ?? null;
			$paciente['validade']        = $result->validade ?? null;
			$paciente['observacao']      = $result->notas ?? null;
			$paciente['enviar_email']    = $result->enviar_email ?? null;

			return $paciente;

		})->name('clinca.pacientes.get_dados');

	});

	// HomeCare
	Route::prefix('/homecare')->group(function () {

		Route::get('/', function () {

			return redirect()->route('clinica.homecare.gestao-de-cuidados');

		})->name('clinica.homecare.index');

		Route::prefix('/gestao-de-cuidados')->group(function () {

			Route::get('/', [Homecare::class, 'index'])->name('clinica.homecare.gestao-de-cuidados');
			Route::get('/q/{search?}', [Homecare::class, 'search'])->name('clinica.homecare.gestao-de-cuidados.search');
			Route::get('/id/{id}', [Homecare::class, 'index'])->name('clinica.homecare.gestao-de-cuidados.edit');
			Route::post('/', [Homecare::class, 'store'])->name('clinica.homecare.gestao-de-cuidados.post');
			Route::put('/', [Homecare::class, 'update'])->name('clinica.homecare.gestao-de-cuidados.post');
			Route::delete('/', [Homecare::class, 'destroy'])->name('clinica.homecare.gestao-de-cuidados.delete');

			Route::prefix('/programas')->group(function () {

				Route::get('/q/{search?}', [Homecare::class, 'search_programas'])->name('clinica.homecare.programas.search');

			});

			Route::prefix('/tarefas')->group(function () {
				Route::get('/', [Homecare::class, 'addTarefa'])->name('clinica.homecare.gestao-de-cuidados.tarefas');
				Route::post('/', [Homecare::class, 'addTarefa'])->name('clinica.homecare.gestao-de-cuidados.tarefas');
			});

		});

		// Route::get('/tarefas', [Homecare::class, 'index'])->name('clinica.homecare.tarefas');

		Route::prefix('/pacientes')->group(function () {

			Route::prefix('/tickets')->group(function () {
				Route::get('/', [PacientesHomecare::class, 'tickets'])->name('clinica.homecare.pacientes.tickets');
			});

			Route::get('/', [PacientesHomecare::class, 'index'])->name('clinica.homecare.pacientes');
			Route::get('/q/{search?}', [PacientesHomecare::class, 'search'])->name('clinica.homecare.pacientes.search');
			Route::get('/a/{search?}', [PacientesHomecare::class, 'autocomplete'])->name('clinica.homecare.pacientes.autocomplete');
			Route::get('/id/{id}', [PacientesHomecare::class, 'index'])->name('clinica.homecare.pacientes.edit');
			Route::post('/', [PacientesHomecare::class, 'store'])->name('clinica.homecare.pacientes.post');
			Route::put('/', [PacientesHomecare::class, 'store'])->name('clinica.homecare.pacientes.post');
			Route::delete('/', [PacientesHomecare::class, 'destroy'])->name('clinica.homecare.pacientes.delete');

		});

	});

	// Recursos Médicos
	Route::prefix('/recursos-medicos')->group(function () {

		Route::prefix('/agenda')->group(function () {

			Route::get('/', [Agendamedica::class, 'index'])->name('clinica.recursosmedicos.agenda.index');
			// 	Route::get('/id/{id}', [Agendamedica::class, 'index'])->name('clinica.recursosmedicos.agenda.edit');
			// 	Route::post('/', [Agendamedica::class, 'store'])->name('clinica.recursosmedicos.agenda.index');
			// 	Route::put('/', [Agendamedica::class, 'store'])->name('clinica.recursosmedicos.agenda.index');

			// 	Route::prefix('/medico')->group(function () {

			Route::prefix('/medico/{id_medico}/{id_clinica?}')->group(function () {

				Route::get('/', function (AgendaModel $agenda) {

					$data           = [];
					$data['medico'] = $agenda->select('M.id', 'M.nome')
						->from('tb_medico AS M')
						->where('id', request('id_medico'))
						->first();

					// $data['agenda'] = $agenda->select('A.horarios')
					// 	->from('tb_medico_agenda AS A')
					// 	->where('id_medico', request('id_medico'))
					// 	->get();

					// dd($data);
					// $data['agenda'] = $agenda->select('C.id_medico', 'horarios')
					// 	->from('tb_medico_agenda AS A')
					// // ->join('tb_medico_agenda_horario AS H', 'H.id_agenda', 'A.id')
					// 	->join('tb_medico_clinica AS C', 'C.id', 'A.id_medico')
					// 	->where('C.id_medico', request('id_medico'))
					// 	->get()
					// 	->first();

					// return view('clinica.recursosmedicos.agenda.index-calendar', $data);
					// return view('clinica.recursosmedicos.agenda.index-agenda', $data);
					return view('clinica.recursosmedicos.agenda.medico', $data);

				})->name('clinica.recursosmedicos.agenda.medico');

				Route::post('/', [Agendamedica::class, 'store']);
				Route::put('/', [Agendamedica::class, 'store']);

				// 			Route::get('/disponibilidade', [Agendamedica::class, 'index'])->name('clinica.recursosmedicos.agenda.disponibilidade');
				// 			Route::get('/agendamento', [Agendamedica::class, 'index'])->name('clinica.recursosmedicos.agenda.medico.agendamento');

			});

			// 		Route::get('/clinicas', function () {
			// 			$id_medico = request('medico');
			// 			$clinicas  = [];
			// 			$model = DB::connection('medicus')->table('tb_medico_clinica AS MC')
			// 				->select('C.id', 'C.razao_social')
			// 				->join('tb_empresa AS C', 'C.id', 'MC.id_empresa')
			// 				->where('MC.id_medico', $id_medico)
			// 				->get();
			// 			if ($model->count() > 0) {
			// 				foreach ($model as $c) {
			// 					$clinicas[] = [
			// 						'id'   => $c->id,
			// 						'text' => $c->razao_social,
			// 					];
			// 				}
			// 			}
			// 			return $clinicas;
			// 		})->name('clinica.recursosmedicos.agenda.medico.get_clinicas');
			// 	});

			// 	Route::get('/filtros', function () {
			// 		$medicos = DB::connection('medicus')
			// 			->table('tb_medico_especialidade', 'ME')
			// 			->select('ME.id_profissional', 'ME.id_especialidade', 'P.nome', 'E.especialidade')
			// 			->join('tb_medico AS P', 'P.id', 'ME.id_profissional')
			// 			->join('tb_especialidade AS E', 'E.id', 'ME.id_especialidade')
			// 			->where('P.nome', 'like', request('search') . '%')
			// 			->orWhere('E.especialidade', 'like', request('search') . '%')
			// 			->groupBy('ME.id_profissional')
			// 			->get();
			// 		$data = [];
			// 		if ($medicos->count() > 0) {
			// 			foreach ($medicos as $m) {
			// 				$data[] = ['id' => $m->id_profissional, 'text' => $m->nome];
			// 			}
			// 		}
			// 		return $data;
			// 	})->name('clinica.recursosmedicos.agenda.busca.medico_especialidade');

			// 	Route::get('/grade', function () {
			// 		dd(request()->all());
			// 	})->name('clinica.recursosmedicos.agenda.busca.grade');
			//
		});

	});

	// Route::get('/agendamento', [Agendamedica::class, 'index'])->name('clinica.recursosmedicos.agendamento');

	Route::prefix('/agendamentos')->group(function () {

		Route::get('/', function () {

			return view('clinica.agendamentos.index');

		})->name('clinica.agendamentos.index');

		Route::get('/filtros', function () {

			$medicos = DB::connection('medicus')
				->table('tb_medico_especialidade', 'ME')
				->select('ME.id_profissional', 'ME.id_especialidade', 'P.nome', 'E.especialidade')
				->join('tb_medico AS P', 'P.id', 'ME.id_profissional')
				->join('tb_especialidade AS E', 'E.id', 'ME.id_especialidade')
				->where('P.nome', 'like', request('search') . '%')
				->orWhere('E.especialidade', 'like', request('search') . '%')
				->groupBy('ME.id_profissional')
				->get();

			$data = [];
			if ($medicos->count() > 0) {
				foreach ($medicos as $m) {
					$data[] = ['id' => $m->id_profissional, 'text' => $m->nome];
				}
			}

			return $data;

		})->name('clinica.recursosmedicos.agenda.busca.medico_especialidade');

		Route::prefix('/agenda')->group(function () {

			Route::get('/', function (AgendaModel $agenda_model) {

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
						$medico                = $agenda_model->select('nome')->from('tb_medico')->where('id', $a->id_medico)->first();
						$medico                = $medico->nome;
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

			})->name('clinica.agendamentos.agenda.horarios');

			Route::prefix('/{year}/{month}/{day}')->group(function () {

				Route::get('/', function (AgendaModel $agenda_model) {

					/**
					 * Listar todas as especialidades / médicos que atendem no dia (w) referente à data selecionada
					 */
					$data     = strtotime(request('year') . '-' . request('month') . '-' . request('day'));
					$ano      = date('Y', $data);
					$mes      = date('m', $data);
					$dia      = date('d', $data);
					$dia_num  = date('w', $data);
					$clinicas = [];

					$agendas = $agenda_model->select('*')
						->from('tb_medico_agenda AS A')
						->join('tb_medico_agenda_horario AS H', 'H.id_agenda', 'A.id')
						->where('dia', $dia_num)
						->groupBy('id_agenda')
						->get();

					if ($agendas->count() > 0) {

						foreach ($agendas as $a) {

							$medico         = $agenda_model->select('nome')->from('tb_medico')->where('id', $a->id_medico)->first();
							$clinica        = $agenda_model->select('razao_social')->from('tb_empresa')->where('id', $a->id_clinica)->first();
							$especialidades = $agenda_model->select('id_especialidade')->from('tb_medico_agenda_especialidade')->where('id_agenda', $a->id)->get();

							if ($especialidades->count() > 0) {

								foreach ($especialidades as $e) {

									$horarios = $agenda_model->select('inicio', 'fim')->from('tb_medico_agenda_horario')->where('id_agenda', $a->id)->where('dia', $dia_num)->get();

									$horario = [];
									foreach ($horarios as $h) {
										$horario[] = ['inicio' => $h->inicio, 'fim' => $h->fim];
									}

									$especialidade                                                     = $agenda_model->select('especialidade')->from('tb_especialidade')->where('id', $e->id_especialidade)->first();
									$clinicas[$clinica->razao_social][$especialidade->especialidade][] = [
										'id_agenda'             => $a->id,
										'id_medico'             => $a->id_medico,
										'id_clinica'            => $a->id_clinica,
										'medico'                => $medico->nome,
										'especialidade'         => $especialidade->especialidade,
										'id_especialidade'      => $e->id_especialidade,
										'dia'                   => $a->dia,
										'horarios'              => $horario,
										'duracao'               => $a->duracao,
										'tempo_min_agendamento' => $a->tempo_min_agendamento,
										'tempo_max_agendamento' => $a->tempo_max_agendamento,
										'intervalo'             => $a->intervalo,
										'max_agendamento'       => $a->max_agendamento,
										'repetir'               => $a->repetir,
									];

								}

							}

						}

					}

					$dados['clinicas'] = $clinicas;

					return view('clinica.agendamentos.index', $dados);

				})->name('clinica.agendamento.data');

				// Formulário do agendamento
				Route::get('/{horario}/{id_medico}/{id_clinica}/{id_especialidade}', function () {

					$request            = request()->all();
					$dados['dados']     = $request;
					$convenio           = new App\Models\Clinica\ConvenioModel();
					$convenios          = $convenio->get();
					$dados['convenios'] = $convenios;

					return view('clinica.agendamentos.index', $dados);

				})->name('clinica.agendamentos.form');

				Route::post('/', function (Request $request, AgendaModel $agenda) {

					$request        = request()->all();
					$dados['dados'] = $request;

					$rules = [
						'especialidade' => 'required',
						'clinica'       => 'required',
						'convenio'      => 'required',
						'paciente'      => 'required',
						'medico'        => [
							'required',
							// 'regex:/[\d]{2}\.[\d]{3}\.[\d]{3}\/[\d]{4}\-[\d]{2}/i',
							// Rule::unique('tb_agendamento', 'cnpj')->ignore($request->post('id'), 'id'),
						],
						'tipo'          => [
							'required',
							// Rule::unique('tb_agendamento', 'inscricao_estadual')->ignore($request->post('id'), 'id'),
						],
						'categoria'     => [
							'required',
							'required_if:receber_notificacoes,on',
						],
						'data'          => [
							'required',
							'regex:/(([0-2][0-9])|([3][0-1]))\/(([0][0-9])|([1][0-2]))\/([20][0-9]{2})/i',
						],
						'hora'          => [
							'required',
							'regex:/(([0-1][0-9])|[2][0-3])\:([0-5][0-9])/i',
						],

					];

					request()->validate($rules);

					$data = [
						'titulo'              => $request['titulo'] ?? null,
						'descricao'           => $request['descricao'] ?? null,
						'id_parent'           => $request['id_parent'] ?? null,
						'id_tipo'             => $request['tipo'] ?? null,
						'id_medico'           => $request['medico'],
						'id_clinica'          => $request['clinica'],
						'id_paciente'         => $request['paciente'],
						'id_convenio'         => $request['convenio'],
						'id_categoria'        => $request['categoria'],
						'observacao'          => $request['observacao'],
						'data'                => date('Y-m-d', strtotime(str_replace('/', '-', $request['data']))),
						'hora_agendada'       => $request['hora'],
						'hora_inicial'        => $request['hora_inicial'] ?? null,
						'hora_final'          => $request['hora_final'] ?? null,
						'recorrencia'         => $request['recorrencia'] ?? 'off',
						'recorrencia_periodo' => $request['recorrencia_periodo'] ?? 0,
						'recorrencia_limite'  => $request['recorrencia_limite'] ?? null,
						'cor'                 => $request['cor'] ?? null,
						'criador'             => $request['criador'] ?? Auth::id(),
						'lembrete'            => $request['lembrete'] ?? 'off',
						'tempo_lembrete'      => $request['tempo_lembrete'] ?? 0,
						'status'              => $request['status'] ?? '0',
					];

					$id_agendamento = $agenda->from('tb_atendimento')
						->updateOrInsert([
							'id_medico'     => $request['medico'],
							'id_clinica'    => $request['clinica'],
							'id_paciente'   => $request['paciente'],
							'hora_agendada' => $request['hora'],
						], $data);

					// dd($data);

					return redirect()->route('clinica.agendamento.data', [request('year'), request('month'), request('day')])->with(['message' => 'Agendamento cadastrado com sucesso!']);

				})->name('clinica.agendamentos.post');

				Route::get('/{id_especialidade}/{id_medico}', function () {

				})->name('clinica.agendamento.marcar_consulta');

			});

		});

	});

	// Médicossite_medicusite_medicus24h/resources/views/clinica/pacientess24h/resources/views/clinica/pacientes
	Route::prefix('/profissionais')->group(function () {

		Route::get('/', [Profissionais::class, 'index'])->name('clinica.profissionais.index');

		Route::get('/q/{search?}', [Profissionais::class, 'search'])->name('clinica.profissionais.search');
		Route::get('/a/{search?}', [Profissionais::class, 'autocomplete'])->name('clinica.profissionais.autocomplete');
		Route::get('/id/{id}', [Profissionais::class, 'index'])->name('clinica.profissionais.edit');
		Route::post('/', [Profissionais::class, 'store'])->name('clinica.profissionais.post');
		Route::put('/', [Profissionais::class, 'store'])->name('clinica.profissionais.post');
		Route::delete('/', [Profissionais::class, 'destroy'])->name('clinica.profissionais.delete');

		Route::get('/a/{search?}', function () {
			return DB::connection('medicus')
				->table('tb_medico AS M')
				->select('nome AS text', 'id')
			// ->join('tb_funcionario AS F', 'F.id', 'M.id_funcionario')
				->get();
		})->name('clinica.medicos.autocomplete');

		Route::post('/especialidade', function (Request $request) {

			$data['especialidades'] = request()->all();

			// Validation::make(['especialidade' => 'required']);

			return view('clinica.profissionais.includes.table_especialidade', $data);

		})->name('clinica.profissionais.especialidade.add');

	});

	// Perfis de Acessos
	Route::prefix('/perfis')->group(function () {

		Route::get('/', [Perfis::class, 'index'])->name('clinica.grupos.usuarios.index');
		Route::get('/q/{search?}', [Perfis::class, 'search'])->name('clinica.grupos.usuarios.search');
		Route::get('/id/{id}', [Perfis::class, 'index'])->name('clinica.grupos.usuarios.edit');
		Route::post('/', [Perfis::class, 'store'])->name('clinica.grupos.usuarios.post');
		Route::put('/', [Perfis::class, 'update'])->name('clinica.grupos.usuarios.post');
		Route::delete('/', [Perfis::class, 'destroy'])->name('clinica.grupos.usuarios.delete');

		Route::get('/a/{search?}', function () {
			return DB::connection('medicus')
				->table('tb_medico AS M')
				->select('nome AS text', 'id')
			// ->join('tb_funcionario AS F', 'F.id', 'M.id_funcionario')
				->get();
		})->name('clinica.medicos.autocomplete');

	});

	// Agendamentos

	// Tickets

	/**
	 * Cadastros
	 */

	// Cadastro de Unidades
	Route::prefix('/unidades')->group(function () {

		Route::get('/', [Unidades::class, 'index'])->name('clinica.unidades.index');
		Route::get('/q/{search?}', [Unidades::class, 'index'])->name('clinica.unidades.search');
		Route::get('/id/{id}', [Unidades::class, 'index'])->name('clinica.unidades.edit');
		Route::post('/', [Unidades::class, 'store'])->name('clinica.unidades.post');
		Route::put('/', [Unidades::class, 'store'])->name('clinica.unidades.post');
		Route::patch('/id/{id}', [Unidades::class, 'index'])->name('clinica.unidades.patch');
		Route::delete('/', [Unidades::class, 'destroy'])->name('clinica.unidades.delete');

		// Route::get('/a/{search?}', [Profissionais::class, 'autocomplete'])->name('clinica.profissionais.autocomplete');
		Route::get('/a/{search?}', function () {

			$unidades = DB::connection('medicus')->table('tb_empresa')->select('id', 'razao_social AS text')->where('razao_social', 'like', request('search') . '%')
				->where('status', '1')->orderBy('razao_social', 'asc')->get();

			return $unidades;

		})->name('clinica.unidades.autocomplete');
	});

	// Cadastro de Procedimentos
	Route::prefix('/procedimentos')->group(function () {

		Route::get('/', [Procedimentos::class, 'index'])->name('clinica.procedimentos.index');
		Route::get('/q/{search?}', [Procedimentos::class, 'index'])->name('clinica.procedimentos.search');
		Route::get('/id/{id}', [Procedimentos::class, 'index'])->name('clinica.procedimentos.edit');
		Route::post('/', [Procedimentos::class, 'store'])->name('clinica.procedimentos.post');
		Route::put('/', [Procedimentos::class, 'update'])->name('clinica.procedimentos.post');
		Route::patch('/id/{id}', [Procedimentos::class, 'index'])->name('clinica.procedimentos.patch');
		Route::delete('/', [Procedimentos::class, 'destroy'])->name('clinica.procedimentos.delete');

	});

	// Cadastro de Especialidades
	Route::prefix('/especialidades')->group(function () {

		Route::get('/', [Especialidades::class, 'index'])->name('clinica.especialidades.index');
		Route::get('/q/{search?}', [Especialidades::class, 'index'])->name('clinica.especialidades.search');
		Route::get('/id/{id}', [Especialidades::class, 'index'])->name('clinica.especialidades.edit');
		Route::post('/', [Especialidades::class, 'store'])->name('clinica.especialidades.post');
		Route::put('/', [Especialidades::class, 'update'])->name('clinica.especialidades.post');
		Route::patch('/id/{id}', [Especialidades::class, 'index'])->name('clinica.especialidades.patch');
		Route::delete('/', [Especialidades::class, 'destroy'])->name('clinica.especialidades.delete');

		// Route::get('/a/{search?}', [Profissionais::class, 'autocomplete'])->name('clinica.profissionais.autocomplete');
		Route::get('/a/{search?}', function () {

			$especialidades = DB::connection('medicus')->table('tb_especialidade')->select('id', 'especialidade AS text')->where('especialidade', 'like', request('search') . '%')->get();

			return $especialidades;

		})->name('clinica.especialidades.autocomplete');

	});

	// Cadastro de Funcionários
	Route::prefix('/funcionarios')->group(function () {

		Route::get('/', [Funcionarios::class, 'index'])->name('clinica.funcionarios.index');
		Route::get('/q/{search?}', [Funcionarios::class, 'index'])->name('clinica.funcionarios.search');
		Route::get('/id/{id}', [Funcionarios::class, 'index'])->name('clinica.funcionarios.edit');
		Route::post('/', [Funcionarios::class, 'store'])->name('clinica.funcionarios.post');
		Route::put('/', [Funcionarios::class, 'store'])->name('clinica.funcionarios.post');
		Route::patch('/id/{id}', [Funcionarios::class, 'index'])->name('clinica.funcionarios.patch');
		Route::delete('/', [Funcionarios::class, 'destroy'])->name('clinica.funcionarios.delete');

	});

	// Cadastro de Perfis de acesso
	// Route::prefix('/perfis')->group(function () {

	// });

	// Cadastro de Procedimentos
	Route::prefix('/departamentos')->group(function () {

		Route::get('/', [Departamentos::class, 'index'])->name('clinica.departamentos.index');
		Route::get('/q/{search?}', [Departamentos::class, 'index'])->name('clinica.departamentos.search');
		Route::get('/id/{id}', [Departamentos::class, 'index'])->name('clinica.departamentos.edit');
		Route::post('/', [Departamentos::class, 'store'])->name('clinica.departamentos.post');
		Route::put('/', [Departamentos::class, 'update'])->name('clinica.departamentos.post');
		Route::patch('/id/{id}', [Departamentos::class, 'index'])->name('clinica.departamentos.patch');
		Route::delete('/', [Departamentos::class, 'destroy'])->name('clinica.departamentos.delete');

	});

	// Tabelas

	// Route::get('/imagem/banner/{file_id}', [Banners::class, 'show'])->name('home.banners.show-image');
	// Route::get('/imagem/post/{file_id}', [Apresentacao::class, 'show'])->name('home.apresentacao.show-image');
	// Route::get('/imagem/pastor/{file_id}', [Pastores::class, 'show'])->name('home.pastores.show-image');
	// Route::get('/imagem/a-ibr/{file_id}', [A_Ibr::class, 'show'])->name('home.a-ibr.show-image');
	Route::get('/imagem/paciente/{file_id}', [Pacientes::class, 'show'])->name('clinica.pacientes.show-image');

})->prefix('/admin')->group(function () {

	Route::get('/index', function () {
		return redirect()->route('admin.dashboard');
	})->name('admin.index');

	Route::get('/', function () {
		// return redirect()->route('admin.dashboard');
		return redirect()->route('clinica.dashboard');
	})->name('dashboard');

	Route::get('/dashboard', function () {
		// return view('admin.dashboard');
	})->name('admin.dashboard');

	// /** banners */
	// Route::prefix('/banners')->group(function () {

	// 	Route::get('/', [Banners::class, 'index'])->name('admin.home.banners.index');
	// 	Route::get('/{search}', [Banners::class, 'search'])->name('admin.home.banners.search');
	// 	Route::get('/id/{id}', [Banners::class, 'create'])->name('admin.home.banners.edit');
	// 	// Route::get('/imagem/{file_id}', [Banners::class, 'show'])->name('admin.home.banners.show-image');
	// 	Route::post('/', [Banners::class, 'store'])->name('admin.home.banners.post');
	// 	Route::put('/', [Banners::class, 'store'])->name('admin.home.banners.post');
	// 	Route::delete('/', [Banners::class, 'destroy'])->name('admin.home.banners.delete');

	// });

	// /** Apresentação */
	// Route::prefix('/apresentacao')->group(function () {

	// 	Route::get('/', [Apresentacao::class, 'index'])->name('admin.home.apresentacao.index');
	// 	Route::get('/{search}', [Apresentacao::class, 'search'])->name('admin.home.apresentacao.search');
	// 	Route::get('/id/{id}', [Apresentacao::class, 'create'])->name('admin.home.apresentacao.edit');
	// 	// Route::get('/imagem/{file_id}', [Apresentacao::class, 'show'])->name('admin.home.apresentacao.show-image');
	// 	Route::post('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
	// 	Route::put('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
	// 	Route::delete('/', [Apresentacao::class, 'destroy'])->name('admin.home.apresentacao.delete');

	// });

	// /** Pastores */
	// Route::prefix('/pastores')->group(function () {

	// 	Route::get('/', [Pastores::class, 'index'])->name('admin.home.pastores.index');
	// 	Route::get('/{search}', [Pastores::class, 'search'])->name('admin.home.pastores.search');
	// 	Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.home.pastores.edit');
	// 	// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.home.pastores.show-image');
	// 	Route::post('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
	// 	Route::put('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
	// 	Route::delete('/', [Pastores::class, 'destroy'])->name('admin.home.pastores.delete');

	// });

	// /** A_Ibr */
	// Route::prefix('/a-ibr')->group(function () {

	// 	Route::get('/', [A_Ibr::class, 'index'])->name('admin.a-ibr.index');
	// 	Route::get('/{search}', [A_Ibr::class, 'search'])->name('admin.a-ibr.search');
	// 	Route::get('/id/{id}', [A_Ibr::class, 'create'])->name('admin.a-ibr.edit');
	// 	// Route::get('/imagem/{file_id}', [A_Ibr::class, 'show'])->name('admin.a-ibr.show-image');
	// 	Route::post('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
	// 	Route::put('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
	// 	Route::delete('/', [A_Ibr::class, 'destroy'])->name('admin.a-ibr.delete');

	// });

	// /** Ministérios */
	// Route::prefix('/ministerios')->group(function () {

	// 	Route::get('/', [Pastores::class, 'index'])->name('admin.ministerios.index');
	// 	Route::get('/{search}', [Pastores::class, 'search'])->name('admin.ministerios.search');
	// 	Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.ministerios.edit');
	// 	// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.ministerios.show-image');
	// 	Route::post('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
	// 	Route::put('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
	// 	Route::delete('/', [Pastores::class, 'destroy'])->name('admin.ministerios.delete');

	// });

	// /** Cultos */
	// Route::prefix('/cultos')->group(function () {

	// 	Route::get('/', [Pastores::class, 'index'])->name('admin.cultos.index');
	// 	Route::get('/{search}', [Pastores::class, 'search'])->name('admin.cultos.search');
	// 	Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.cultos.edit');
	// 	// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.cultos.show-image');
	// 	Route::post('/', [Pastores::class, 'store'])->name('admin.cultos.post');
	// 	Route::put('/', [Pastores::class, 'store'])->name('admin.cultos.post');
	// 	Route::delete('/', [Pastores::class, 'destroy'])->name('admin.cultos.delete');

	// });

	// /** Eventos */
	// Route::prefix('/eventos')->group(function () {

	// 	Route::get('/', [Pastores::class, 'index'])->name('admin.eventos.index');
	// 	Route::get('/{search}', [Pastores::class, 'search'])->name('admin.eventos.search');
	// 	Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.eventos.edit');
	// 	// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.eventos.show-image');
	// 	Route::post('/', [Pastores::class, 'store'])->name('admin.eventos.post');
	// 	Route::put('/', [Pastores::class, 'store'])->name('admin.eventos.post');
	// 	Route::delete('/', [Pastores::class, 'destroy'])->name('admin.eventos.delete');

	// });

	// Route::middleware('auth')->group(function () {
	// 	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	// 	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	// 	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	// });

	// Clínica
});

require __DIR__ . '/auth.php';

// use App\Http\Controllers\Admin\ApresentacaoController as Apresentacao;
// use App\Http\Controllers\Admin\A_IbrController as A_Ibr;
// use App\Http\Controllers\Admin\BannersController as Banners;
// use App\Http\Controllers\Admin\PastoresController as Pastores;
// use App\Http\Controllers\APIController as API;

// // Admin Controllers
// use App\Http\Controllers\Clinica\HomeController as ClinicaHome;
// use App\Http\Controllers\Clinica\PacientesController as Pacientes;
// // use App\Http\Controllers\Site\HomeController;

// // Main Controllers

// // Admin Requests

// // Admin Models
// use Illuminate\Support\Facades\Route;

// Route::prefix('/')->group(function () {

// 	Route::get('/', [HomeController::class, 'index'])->name('site.index');

// });

// Route::get('/profile/image/preview/{file_categ}/{file_id}', [API::class, 'show_image_profile'])->name('clinica.show-image-profile');

// Route::middleware([
// 	'auth',
// 	'verified',
// ])->prefix('/clinica')->group(function () {

// 	Route::get('/', function () {
// 		return redirect()->route('clinica.dashboard');
// 	})->name('clinica.index');

// 	Route::get('/dashboard', [ClinicaHome::class, 'index'])->name('clinica.dashboard');
// 	Route::get('/agenda', [ClinicaHome::class, 'index'])->name('clinica.recursosmedicos.agenda.index');

// 	// Pacientes
// 	Route::prefix('/pacientes')->group(function () {

// 		Route::get('/', [Pacientes::class, 'index'])->name('clinica.pacientes.index');
// 		Route::get('/{search}', [Pacientes::class, 'search'])->name('clinica.pacientes.search');
// 		Route::get('/id/{id}', [Pacientes::class, 'index'])->name('clinica.pacientes.edit');
// 		Route::post('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
// 		Route::put('/', [Pacientes::class, 'store'])->name('clinica.pacientes.post');
// 		Route::delete('/', [Pacientes::class, 'destroy'])->name('clinica.pacientes.delete');

// 	});

// 	// HomeCare

// 	// Recursos Médicos

// 	// Agendamentos

// 	// Tickets

// 	// Cadastros

// 	// Tabelas

// 	Route::get('/imagem/banner/{file_id}', [Banners::class, 'show'])->name('home.banners.show-image');
// 	Route::get('/imagem/post/{file_id}', [Apresentacao::class, 'show'])->name('home.apresentacao.show-image');
// 	Route::get('/imagem/pastor/{file_id}', [Pastores::class, 'show'])->name('home.pastores.show-image');
// 	Route::get('/imagem/a-ibr/{file_id}', [A_Ibr::class, 'show'])->name('home.a-ibr.show-image');
// 	Route::get('/imagem/paciente/{file_id}', [Pacientes::class, 'show'])->name('clinica.pacientes.show-image');

// })->prefix('/admin')->group(function () {

// 	Route::get('/index', function () {
// 		return redirect()->route('admin.dashboard');
// 	})->name('admin.index');

// 	Route::get('/', function () {
// 		// return redirect()->route('admin.dashboard');
// 		return redirect()->route('clinica.dashboard');
// 	})->name('dashboard');

// 	Route::get('/dashboard', function () {
// 		// return view('admin.dashboard');
// 	})->name('admin.dashboard');

// 	/** banners */
// 	Route::prefix('/banners')->group(function () {

// 		Route::get('/', [Banners::class, 'index'])->name('admin.home.banners.index');
// 		Route::get('/{search}', [Banners::class, 'search'])->name('admin.home.banners.search');
// 		Route::get('/id/{id}', [Banners::class, 'create'])->name('admin.home.banners.edit');
// 		// Route::get('/imagem/{file_id}', [Banners::class, 'show'])->name('admin.home.banners.show-image');
// 		Route::post('/', [Banners::class, 'store'])->name('admin.home.banners.post');
// 		Route::put('/', [Banners::class, 'store'])->name('admin.home.banners.post');
// 		Route::delete('/', [Banners::class, 'destroy'])->name('admin.home.banners.delete');

// 	});

// 	/** Apresentação */
// 	Route::prefix('/apresentacao')->group(function () {

// 		Route::get('/', [Apresentacao::class, 'index'])->name('admin.home.apresentacao.index');
// 		Route::get('/{search}', [Apresentacao::class, 'search'])->name('admin.home.apresentacao.search');
// 		Route::get('/id/{id}', [Apresentacao::class, 'create'])->name('admin.home.apresentacao.edit');
// 		// Route::get('/imagem/{file_id}', [Apresentacao::class, 'show'])->name('admin.home.apresentacao.show-image');
// 		Route::post('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
// 		Route::put('/', [Apresentacao::class, 'store'])->name('admin.home.apresentacao.post');
// 		Route::delete('/', [Apresentacao::class, 'destroy'])->name('admin.home.apresentacao.delete');

// 	});

// 	/** Pastores */
// 	Route::prefix('/pastores')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.home.pastores.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.home.pastores.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.home.pastores.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.home.pastores.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.home.pastores.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.home.pastores.delete');

// 	});

// 	/** A_Ibr */
// 	Route::prefix('/a-ibr')->group(function () {

// 		Route::get('/', [A_Ibr::class, 'index'])->name('admin.a-ibr.index');
// 		Route::get('/{search}', [A_Ibr::class, 'search'])->name('admin.a-ibr.search');
// 		Route::get('/id/{id}', [A_Ibr::class, 'create'])->name('admin.a-ibr.edit');
// 		// Route::get('/imagem/{file_id}', [A_Ibr::class, 'show'])->name('admin.a-ibr.show-image');
// 		Route::post('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
// 		Route::put('/', [A_Ibr::class, 'store'])->name('admin.a-ibr.post');
// 		Route::delete('/', [A_Ibr::class, 'destroy'])->name('admin.a-ibr.delete');

// 	});

// 	/** Ministérios */
// 	Route::prefix('/ministerios')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.ministerios.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.ministerios.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.ministerios.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.ministerios.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.ministerios.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.ministerios.delete');

// 	});

// 	/** Cultos */
// 	Route::prefix('/cultos')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.cultos.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.cultos.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.cultos.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.cultos.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.cultos.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.cultos.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.cultos.delete');

// 	});

// 	/** Eventos */
// 	Route::prefix('/eventos')->group(function () {

// 		Route::get('/', [Pastores::class, 'index'])->name('admin.eventos.index');
// 		Route::get('/{search}', [Pastores::class, 'search'])->name('admin.eventos.search');
// 		Route::get('/id/{id}', [Pastores::class, 'create'])->name('admin.eventos.edit');
// 		// Route::get('/imagem/{file_id}', [Pastores::class, 'show'])->name('admin.eventos.show-image');
// 		Route::post('/', [Pastores::class, 'store'])->name('admin.eventos.post');
// 		Route::put('/', [Pastores::class, 'store'])->name('admin.eventos.post');
// 		Route::delete('/', [Pastores::class, 'destroy'])->name('admin.eventos.delete');

// 	});

// 	Route::middleware('auth')->group(function () {
// 		Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// 		Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// 		Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// 	});

// 	// Clínica
// });

// require __DIR__ . '/auth.php';
