<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\PacienteRequest;
use App\Models\Clinica\EstadocivilModel;
use App\Models\Clinica\EtniaModel;
use App\Models\Clinica\PacienteModel;
use App\Models\FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, PacienteModel $paciente, EtniaModel $etnia, EstadocivilModel $estadocivil) {

		$data['estado_civil'] = $estadocivil->get();
		$data['etnias']       = $etnia->get();
		$data['pacientes']    = $paciente->get();
		$data['paciente']     = $paciente->getWhere(['id' => $request->id]);

		if ($request->id && empty($data['paciente'])) {
			return redirect()->route('clinica.pacientes.index');
		}

		return view('clinica.pacientes.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PacienteModel $paciente) {

		$data['pacientes'] = $paciente->search($request->search);

		return view('clinica.pacientes.index', $data);

	}

	public function autocomplete(Request $request) {

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

	}

	public function get_dados(Request $request) {
		$id = $request->id;

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
	public function store(PacienteRequest $request, PacienteModel $paciente) {

		$data = $request->all();

		$paciente->cadastra($request);

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente cadastrado com sucesso!']);

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
	public function edit(PacienteModel $pacienteModel) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(PacienteRequest $request, PacienteModel $paciente) {

		$data = $request->all();

		unset($data['id'], $data['_method'], $data['_token']);

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		$data['id_estado_civil'] = $data['estado_civil'];
		$data['id_etnia']        = $data['etnia'];
		$data['id_convenio']     = $data['convenio'];
		$data['observacoes']     = $data['notas'];
		$data['data_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['data_nascimento'])));

		unset($data['estado_civil'], $data['etnia'], $data['notas'], $data['convenio'], $data['categoria']);

		$paciente->where(['id' => $request->id])->update($data);

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PacienteModel $paciente) {

		// // $this->authorize('delete', PacienteModel::class);

		if ($paciente->removePaciente($request->id)) {
			$message = 'Paciente removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.pacientes.index')->with(['message' => $message]);

	}
}
