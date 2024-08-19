<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Models\Clinica\ProfissionalModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfissionaisController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, ProfissionalModel $profissional) {

		$data['profissionais'] = $profissional->get();
		$data['profissional']  = $profissional->where('id', $request->id)->get()->first();
		$data['categorias']    = $profissional->from('tb_categoria_descricao')->get();

		return view('clinica.profissionais.index', $data);

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
	public function store(Request $request, ProfissionalModel $profissional) {

		$data          = $request->all();
		$especialidade = isset($data['especialidade']) ? $data['especialidade'] : null;

		unset($data['_method'], $data['_token'], $data['id'], $data['categoria'], $data['especialidade']);

		$request->validate([
			'nome' => 'required',
			'cpf'  => [
				'required',
				new \App\Rules\CPF(),
				Rule::unique('medicus.tb_profissional', 'cpf')->ignore($request->id, 'id'),
			],
		]);

		$data['data_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['data_nascimento'])));
		$data['status']          = $data['status'] ?? '0';

		$id_profissional = $profissional->updateOrCreate(['cpf' => $data['cpf']], $data);

		if (!empty($especialidade)) {

			$profissional->from('tb_medico_especialidade')->where('id_profissional', $id_profissional->id)->delete();

			foreach ($especialidade as $e) {
				$e                    = json_decode($e, true);
				$e['id_profissional'] = $id_profissional->id;

				if (!isset($e['id_especialidade'])) {
					$e['id_especialidade'] = $e['especialidade'];
				}

				unset($e['especialidade']);

				$issetEspecialidade = $profissional->from('tb_medico_especialidade')->where('id_profissional', $id_profissional->id)->where('id_especialidade', $e['id_especialidade'])->first();

				if (isset($issetEspecialidade)) {
					$profissional->from('tb_medico_especialidade')->where(['id_profissional' => $id_profissional->id, 'id_especialidade' => $e['id_especialidade']])->update($e);
				} else {
					$profissional->from('tb_medico_especialidade')->insert($e);
				}

			}

		}

		return redirect()->route('clinica.profissionais.index')->with(['message' => 'Profissional atualizado com sucesso!']);

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
	public function update(Request $request, ProfissionalModel $profissional) {

		$data = $request->all();

		dd($data, 'teste');
		unset($data['_method'], $data['_token'], $data['id'], $data['categoria']);

		$request->validate([
			'profissional' => [
				'required',
				Rule::unique('medicus.tb_profissional', 'profissional')->ignore($request->id, 'id'),
			],
		]);

		$data['status'] = $data['status'] ?? '0';

		$profissional->where('id', $request->id)->update($data);

		return redirect()->route('clinica.profissionais.index')->with(['message' => 'Profissional atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, ProfissionalModel $profissional) {

		// // $this->authorize('delete', PacienteModel::class);

		if ($profissional->where('id', $request->id)->delete()) {
			$message = 'Profissional removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.profissionais.index')->with(['message' => $message]);

	}

}
