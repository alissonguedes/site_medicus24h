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

		return view('clinica.pacientes.index');

	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PacienteRequest $request) {

		request()->validate([
			'nome' => 'required',
			'cpf'  => 'required',
		]);

		echo 'Aprovado';
		dump($request->all());
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
		return view('clinica.pacientes.index', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, PacienteModel $pacienteModel) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(PacienteModel $pacienteModel) {
		//
	}
}
