<?php

namespace App\Http\Controllers\Clinica\Homecare;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\GestaoDeCuidadoRequest;
use App\Models\Clinica\PacienteModel;
use App\Models\Clinica\ProgramaModel;
use Illuminate\Http\Request;

class GestaoDeCuidadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, ProgramaModel $programa) {

		if (isset($_GET['search'])) {

			// return $this->search($request, $paciente, $_GET['search']);

			$data = [];

			$pacientes = $programa->where('titulo', 'like', '%' . $request->search . '%')->get();

			if (isset($pacientes)) {
				foreach ($pacientes as $p) {
					$data[] = [
						'id'   => $p->id,
						'text' => $p->titulo,
						// 'cpf'       => $p->cpf,
						// 'email'     => $p->email,
						// 'telefone'  => $p->telefone,
						// 'matricula' => $p->matricula,
					];
				}
			}

			return response()->json($data);

		}

		$data['programas'] = $programa->get();
		$data['programa']  = $programa->where(['id' => $request->id])->get()->first();

		return view('clinica.homecare.gestao-de-cuidados.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, ProgramaModel $programa) {

		$data['programas'] = $programa->where('titulo', 'like', $request->search . '%')->get();

		return view('clinica.homecare.gestao-de-cuidados.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search_programas(Request $request, ProgramaModel $programa) {

		$data = [];

		if ($request->values) {
			$programa = $programa->whereNotIn('id', $request->values);
		}

		$programas = $programa
			->where('titulo', 'like', $request->search . '%')
			->get();

		if (isset($programas)) {
			foreach ($programas as $p) {
				$data[] = [
					'id'   => $p->id,
					'text' => $p->titulo,
				];
			}
		}

		return response()->json($data);

	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	public function addTarefa(Request $request) {

		$field = [
			'titulo_tarefa'    => 'required',
			'descricao_tarefa' => '',
			'prazo_tarefa'     => 'required',
			'tipo_tarefa'      => 'required',
		];

		if (!isset($_POST['responsavel_tarefa'])) {
			$field['responsavel_tarefa[]'] = 'required';
		}

		$request->validate($field);

		$data['tarefa'] = $request->all();

		return view('clinica.homecare.gestao-de-cuidados.includes.tarefa_table', $data);

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(GestaoDeCuidadoRequest $request, ProgramaModel $programa) {

		$data = $request->all();

		$responsaveis      = $data['responsaveis'];
		$faixa_etaria      = explode(' - ', $data['faixa_etaria']);
		$tarefas           = $data['tarefa'] ?? null;
		$data['idade_min'] = $faixa_etaria[0];
		$data['idade_max'] = $faixa_etaria[1];
		$data['publico']   = $data['sexo'];

		// unset($data['sexo'], $data['responsaveis'], $data['faixa_etaria'], $data['_token'], $data['id'], $data['_method']);

		unset(
			$data['sexo'],
			$data['responsaveis'],
			$data['faixa_etaria'],
			$data['tarefa'],
			$data['titulo_tarefa'],
			$data['descricao_tarefa'],
			$data['prazo_tarefa'],
			$data['responsavel_tarefa'],
			$data['tipo_tarefa'],
			$data['_token'], $data['id'],
			$data['_method']
		);

		$id_programa = $programa->insertGetId($data);

		// Cadastrar os responsáveis pelo programa
		foreach ($responsaveis as $r) {

			$id_responsavel = $r;

			$issetResponsavel = $programa->select('id_programa', 'id_profissional')->from('tb_programas_responsavel')
				->where('id_programa', $id_programa)
				->where('id_profissional', $id_responsavel)
				->get()
				->first();

			if (!isset($issetResponsavel)) {
				$programa->from('tb_programas_responsavel')
					->insert(['id_programa' => $id_programa, 'id_profissional' => $id_responsavel]);
			}

		}

		// Cadastrar tarefas
		if (!empty($tarefas)) {

			foreach ($tarefas as $tarefa) {

				$t = json_decode($tarefa, true);

				$columns = [
					'id_programa'            => $id_programa,
					'titulo'                 => $t['titulo_tarefa'],
					'descricao'              => $t['descricao_tarefa'],
					'tipo'                   => $t['tipo_tarefa'],
					'prazo'                  => $t['prazo_tarefa'],
					'selecionar_responsavel' => $t['responsavel_tarefa'],
				];

				$programa->from('tb_programas_tarefas')->insert($columns);

			}

		}

		return redirect()->route('clinica.homecare.gestao-de-cuidados')->with(['message' => 'Programa cadastrado com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(PacienteModel $pacienteModel) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request, ProgramaModel $programa) {

		$data['programa'] = $programa->where(['id' => $request->id])->get()->first();

		return response()->json($data);

	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(GestaoDeCuidadoRequest $request, ProgramaModel $programa) {

		$data = $request->all();

		$id_programa       = $data['id'];
		$responsaveis      = $data['responsaveis'];
		$faixa_etaria      = explode(' - ', $data['faixa_etaria']);
		$tarefas           = $data['tarefa'] ?? null;
		$data['idade_min'] = $faixa_etaria[0];
		$data['idade_max'] = $faixa_etaria[1];
		$data['publico']   = $data['sexo'];

		unset($data['sexo'], $data['responsaveis'], $data['faixa_etaria'], $data['tarefa'],
			$data['titulo_tarefa'],
			$data['descricao_tarefa'],
			$data['prazo_tarefa'],
			$data['responsavel_tarefa'],
			$data['tipo_tarefa'],
			$data['_token'], $data['id'], $data['_method']);

		$programa->where('id', $id_programa)->update($data);

		$programa->from('tb_programas_responsavel')->where('id_programa', $id_programa)->delete();

		// Cadastrar os responsáveis pelo programa
		foreach ($responsaveis as $r) {

			$id_responsavel = $r;

			$issetResponsavel = $programa->select('id_programa', 'id_profissional')->from('tb_programas_responsavel')
				->where('id_programa', $id_programa)
				->where('id_profissional', $id_responsavel)
				->get()
				->first();

			if (!isset($issetResponsavel)) {
				$programa->from('tb_programas_responsavel')
					->insert(['id_programa' => $id_programa, 'id_profissional' => $id_responsavel]);
			}

		}

		// Limpar as tarefas do programa antes de adicioná-las.
		$programa->from('tb_programas_tarefas')->where('id_programa', $id_programa)->delete();

		// Cadastrar tarefas
		if (!empty($tarefas)) {

			foreach ($tarefas as $tarefa) {

				$t = json_decode($tarefa, true);

				$columns = [
					'id_programa'            => $id_programa,
					'titulo'                 => $t['titulo_tarefa'],
					'descricao'              => $t['descricao_tarefa'],
					'tipo'                   => $t['tipo_tarefa'],
					'prazo'                  => $t['prazo_tarefa'],
					'selecionar_responsavel' => $t['responsavel_tarefa'],
				];

				$programa->from('tb_programas_tarefas')->insert($columns);

			}

		}

		return redirect()->route('clinica.homecare.gestao-de-cuidados')->with(['message' => 'Programa alterado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, ProgramaModel $programa) {

		if ($programa->where('id', $request->id)->delete()) {
			$message = 'Programa removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.homecare.gestao-de-cuidados')->with(['message' => $message]);

	}

}
