<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Models\Clinica\ProcedimentoModel;
use Illuminate\Http\Request;

// use Illuminate\Validation\Rule;

class ProcedimentosController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, ProcedimentoModel $procedimento) {

		$data['procedimentos'] = $procedimento->get();
		$data['procedimento']  = $procedimento->where('id', $request->id)->get()->first();
		$data['categorias']    = $procedimento->from('tb_categoria_descricao')->get();
		return view('clinica.procedimentos.index', $data);

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
	public function store(Request $request, ProcedimentoModel $procedimento) {

		$data = $request->all();

		$request->validate([
			// 'titulo'    => ['required', Rule::unique('medicus.tb_procedimento', 'titulo')->ignore($request->id, 'id')],
			'titulo'    => 'required',
			'categoria' => 'required',
			'valor'     => 'required',
			'tempo'     => 'required',
		]);

		$data['id_categoria'] = $data['categoria'];

		unset($data['_method'], $data['_token'], $data['id'], $data['categoria']);

		$procedimento->insert($data);

		return redirect()->route('clinica.procedimentos.index')->with(['message' => 'Procedimento atualizado com sucesso!']);

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
	public function update(Request $request, ProcedimentoModel $procedimento) {

		$data = $request->all();

		unset($data['_method'], $data['_token'], $data['id'], $data['categoria']);

		$request->validate([
			// 'titulo'    => ['required', Rule::unique('medicus.tb_procedimento', 'titulo')->ignore($request->id, 'id')],
			'titulo'    => 'required',
			'categoria' => 'required',
			'valor'     => 'required',
			'tempo'     => 'required',
		]);

		$data['id_categoria'] = $request->categoria;
		$data['valor']        = str_replace(',', '.', str_replace('.', '', $request->valor));

		$procedimento->where('id', $request->id)->update($data);

		return redirect()->route('clinica.procedimentos.index')->with(['message' => 'Procedimento atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, ProcedimentoModel $procedimento) {

		// // $this->authorize('delete', PacienteModel::class);

		if ($procedimento->where('id', $request->id)->delete()) {
			$message = 'Procedimento removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.procedimentos.index')->with(['message' => $message]);

	}

}
