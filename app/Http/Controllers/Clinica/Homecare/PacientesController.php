<?php

namespace App\Http\Controllers\Clinica\Homecare;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\PacienteRequest;
use App\Models\Clinica\EstadocivilModel;
use App\Models\Clinica\EtniaModel;
use App\Models\Clinica\PacienteModel;
use App\Models\FileModel;
use Illuminate\Http\Request;

class PacientesController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, PacienteModel $paciente, EtniaModel $etnia, EstadocivilModel $estadocivil)
	{

		$data['estado_civil'] = $estadocivil->get();
		$data['etnias']       = $etnia->get();
		$data['pacientes']    = $paciente->from('tb_paciente_homecare AS H')
			->join('tb_paciente AS P', 'P.id', 'H.id_paciente')
			->get();
		$data['paciente'] = $paciente->getWhere(['id' => $request->id]);

		if ($request->id && empty($data['paciente'])) {
			return redirect()->route('clinica.homecare.pacientes.index');
		}

		return view('clinica.homecare.pacientes.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PacienteModel $paciente)
	{

		$data['pacientes'] = $paciente->search($request->search);

		return view('clinica.homecare.pacientes.index', $data);

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
	public function store(PacienteRequest $request, PacienteModel $paciente)
	{

		$data = $request->all();

		$paciente->cadastra($request);

		return redirect()->route('clinica.homecare.pacientes')->with(['message' => 'Paciente cadastrado com sucesso!']);

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
	public function edit(PacienteModel $pacienteModel)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(PacienteRequest $request, PacienteModel $paciente)
	{

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

		return redirect()->route('clinica.homecare.pacientes')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PacienteModel $paciente)
	{

		// $this->authorize('delete', PacienteModel::class);

		if ($paciente->removePaciente($request->id)) {
			$status  = 'success';
			$message = 'Paciente removido com sucesso!';
		} else {
			$status  = 'error';
			$message = $paciente->getErros();
		}

		return response()->json([
			'status'  => $status,
			'message' => $message,
			'type'    => 'redirect',
			'url'     => url()->route('clinica.pacientes.index'),
		]);

	}
}
