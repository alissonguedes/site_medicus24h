<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Models\Clinica\EspecialidadeModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EspecialidadesController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, EspecialidadeModel $especialidade) {

		$data['especialidades'] = $especialidade->get();
		$data['especialidade']  = $especialidade->where('id', $request->id)->get()->first();
		$data['categorias']     = $especialidade->from('tb_categoria_descricao')->get();

		return view('clinica.especialidades.index', $data);

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
	public function store(Request $request, EspecialidadeModel $especialidade) {

		$data = $request->all();

		unset($data['_method'], $data['_token'], $data['id'], $data['categoria']);

		$request->validate([
			'especialidade' => [
				'required',
				Rule::unique('medicus.tb_especialidade', 'especialidade')->ignore($request->id, 'id'),
			],
		]);

		$data['status'] = $data['status'] ?? '0';

		$especialidade->insert($data);

		return redirect()->route('clinica.especialidades.index')->with(['message' => 'Especialidade atualizado com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, EspecialidadeModel $especialidade) {

		$data = $request->all();

		unset($data['_method'], $data['_token'], $data['id'], $data['categoria']);

		$request->validate([
			'especialidade' => [
				'required',
				Rule::unique('medicus.tb_especialidade', 'especialidade')->ignore($request->id, 'id'),
			],
		]);

		$data['status'] = $data['status'] ?? '0';

		$especialidade->where('id', $request->id)->update($data);

		return redirect()->route('clinica.especialidades.index')->with(['message' => 'Especialidade atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, EspecialidadeModel $especialidade) {

		// // $this->authorize('delete', PacienteModel::class);

		if ($especialidade->where('id', $request->id)->delete()) {
			$message = 'Especialidade removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.especialidades.index')->with(['message' => $message]);

	}

}
