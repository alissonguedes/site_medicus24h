<?php

namespace App\Http\Controllers\Clinica\Homecare;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\PacienteHomecareRequest;
use App\Models\Clinica\EstadocivilModel;
use App\Models\Clinica\EtniaModel;
use App\Models\Clinica\HomecareModel;
use App\Models\Clinica\PacienteModel;
use App\Models\FileModel;
use Illuminate\Http\Request;

class PacientesController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, PacienteModel $paciente, EtniaModel $etnia, EstadocivilModel $estadocivil) {

		if (isset($_GET['search'])) {
			return $this->search($request, $paciente, $_GET['search']);
		}

		// dd($request->search);
		if ($request->search !== null) {
			return $this->search($search);
		}

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
	 * Display a listing of the resource.
	 */
	public function tickets(Request $request, PacienteModel $paciente, EtniaModel $etnia, EstadocivilModel $estadocivil, $search = null) {

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
	public function search(Request $request, PacienteModel $paciente) {

		$data = [];

		if ($request->values) {
			$paciente = $paciente->whereNotIn('id', [$request->values]);
		}

		$pacientes = $paciente->whereNotIn('id', function ($query) {
			$query->select('id_paciente')->from('tb_paciente_homecare');
		})
			->where('nome', 'like', '%' . $request->search . '%')
			->get();

		if (isset($pacientes)) {
			foreach ($pacientes as $p) {
				$data[] = [
					'id'   => $p->id,
					'text' => $p->nome,
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

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PacienteHomecareRequest $request, HomecareModel $homecare, PacienteModel $paciente) {

		$data = $request->all();

		unset($data['_token'], $data['sexo']);

		$id_homecare = $homecare->updateOrCreate(['id_paciente' => $data['paciente']]);

		$homecare->from('tb_paciente_programa')->where('id_paciente', $data['paciente'])->delete();

		foreach ($data['programa'] as $programa) {

			$columns = [
				'id_paciente' => $request->paciente,
				'id_programa' => $programa,
			];

			$homecare->from('tb_paciente_programa')->insert($columns, $columns);

		}

		if ($request->_method != 'put') {
			$message = 'Paciente cadastrado com sucesso!';
		} else {
			$message = 'Paciente atualizado com sucesso!';
		}

		return redirect()->route('clinica.homecare.pacientes')->with(['message' => $message]);

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

		unset($data['estado_civil'], $data['etnia'], $data['notas'], $data['convenio']);

		$paciente->where(['id' => $request->id])->update($data);

		return redirect()->route('clinica.homecare.pacientes')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, PacienteModel $paciente) {

		$delete = $paciente->from('tb_paciente_homecare')->where('id_paciente', $request->id)->delete();

		if ($delete) {
			$status  = 'success';
			$message = 'Paciente removido com sucesso!';
		} else {
			$status  = 'error';
			$message = 'Paciente não encontrado';
		}

		return redirect()->route('clinica.homecare.pacientes')->with(['message' => $message]);

	}

}
