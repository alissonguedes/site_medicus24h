<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Clinica\DepartamentoRequest;
use App\Models\Clinica\DepartamentoModel;
use Illuminate\Http\Request;

class DepartamentosController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, DepartamentoModel $departamento) {

		$dados['departamentos'] = $departamento->where('is_deleted', '0')->get();
		$dados['departamento']  = $departamento->where('id', $request->id)->first();

		return view('clinica.departamentos.index', $dados);

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
	public function store(Request $request, DepartamentoModel $departamento) {

		$data = $request->all();

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		unset($data['id'], $data['_method'], $data['_token'], $data['categoria']);

		$departamento->insert($data);

		if ($request->_method === 'put') {
			$message = 'Departamento atualizado com sucesso!';
		} else {
			$message = 'Departamento cadastrado com sucesso!';
		}

		return redirect()->route('clinica.departamentos.index')->with(['message' => $message]);

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
	public function update(Request $request, DepartamentoModel $departamento) {

		$data = $request->all();

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		unset($data['id'], $data['_method'], $data['_token'], $data['categoria']);

		$departamento->where(['id' => $request->id])->update($data);

		if ($request->_method === 'put') {
			$message = 'Departamento atualizado com sucesso!';
		} else {
			$message = 'Departamento cadastrado com sucesso!';
		}

		return redirect()->route('clinica.departamentos.index')->with(['message' => $message]);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, DepartamentoModel $departamento) {

		// // $this->authorize('delete', PacienteModel::class);

		if ($departamento->where('id', $request->id)->update(['is_deleted' => '1', 'deleted_at' => date('Y-m-d H:i:s')])) {
			$message = 'Departamento removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.departamentos.index')->with(['message' => $message]);

	}
}
