<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Models\Clinica\ClinicaModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadesController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, ClinicaModel $clinica) {

		$dados['unidades'] = $clinica->where('is_deleted', '0')->get();
		$dados['row']      = $clinica->where('id', $request->id)->first();
		return view('clinica.unidades.index', $dados);

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
	public function store(Request $request, ClinicaModel $clinica) {

		$request->validate([
			'razao_social' => 'required',
			'cnpj'         => ['required', Rule::unique('medicus.tb_empresa', 'cnpj')->ignore($request->id, 'id')],
		]);

		$data = $request->all();

		unset($data['_method'], $data['_token']);

		$clinica->updateOrCreate(['cnpj' => $data['cnpj']], $data);

		return redirect()->route('clinica.unidades.index')->with(['message' => 'Unidade atualizada com sucesso!']);

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
	public function update(Request $request, string $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, ClinicaModel $unidade) {

		if ($unidade->where('id', $request->id)->update(['is_deleted' => '1', 'deleted_at' => date('Y-m-d H:i:s')])) {
			$message = 'Unidade removida com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.unidades.index')->with(['message' => $message]);

	}

}
