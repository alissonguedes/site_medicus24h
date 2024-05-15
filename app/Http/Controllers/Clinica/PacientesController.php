<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\PacienteRequest;
use App\Models\Clinica\EstadocivilModel;
use App\Models\Clinica\EtniaModel;
use App\Models\Clinica\PacienteModel;
use Illuminate\Http\Request;

class PacientesController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, PacienteModel $paciente, EtniaModel $etnia, EstadocivilModel $estadocivil) {

		$data['pacientes']    = $paciente->get();
		$data['paciente']     = $paciente->getWhere(['id' => $request->id]);
		$data['estado_civil'] = $estadocivil->get();
		$data['etnias']       = $etnia->get();

		return view('clinica.pacientes.index', $data);

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

		unset($data['id'], $data['_method'], $data['_token']);

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		$data['id_estado_civil'] = $data['estado_civil'] ?? 1;
		$data['id_etnia']        = $data['etnia'] ?? 1;
		$data['id_convenio']     = $data['convenio'] ?? 1;
		$data['observacoes']     = $data['notas'];
		$data['data_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['data_nascimento'])));
		$data['matricula']       = rand(1000, 9999);

		unset($data['estado_civil'], $data['etnia'], $data['notas'], $data['convenio']);

		$paciente->insert($data);

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente cadastrado com sucesso!']);

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

		unset($data['estado_civil'], $data['etnia'], $data['notas'], $data['convenio']);

		$paciente->where(['id' => $request->id])->update($data);

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(PacienteModel $pacienteModel) {

		//

	}
}
