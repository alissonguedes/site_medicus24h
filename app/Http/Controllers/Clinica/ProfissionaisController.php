<?php

namespace App\Http\Controllers\Clinica;

use App\Http\Controllers\Controller;
use App\Models\Clinica\ProfissionalModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfissionaisController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, ProfissionalModel $profissional)
	{

		$data['profissionais'] = $profissional->get();
		$data['profissional']  = $profissional->where('id', $request->id)->get()->first();
		$data['categorias']    = $profissional->from('tb_categoria_descricao')->get();

		return view('clinica.profissionais.index', $data);

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
	public function store(Request $request, ProfissionalModel $profissional)
	{

		$data = $request->all();

		$especialidade = isset($data['especialidade']) ? $data['especialidade'] : null;
		$empresas      = isset($data['empresas']) ? $data['empresas'] : null;

		unset($data['_method'], $data['_token'], $data['id'], $data['categoria'], $data['especialidade'], $data['empresas']);

		$request->validate([
			'nome' => 'required',
			'cpf'  => [
				'required',
				new \App\Rules\CPF(),
				Rule::unique('medicus.tb_medico', 'cpf')->ignore($request->id, 'id'),
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

		if (!empty($empresas)) {

			foreach ($empresas as $e) {

				$atendimento = $profissional->from('tb_atendimento')->where('id_clinica', $e)->where('id_medico', $id_profissional->id)->get()->first();

				if (isset($atendimento)) {
					$at = ['id_medico' => $atendimento->id_medico, 'id_empresa' => $atendimento->id_clinica];
					$profissional->from('tb_medico_clinica')->whereNot('id_empresa', $e)->where('id_medico', $id_profissional->id)->delete();
				}

				$medico_clinica = array('id_empresa' => $e, 'id_medico' => $id_profissional->id);

				$issetEmpresa = $profissional->from('tb_medico_clinica')->where('id_medico', $id_profissional->id)->where('id_empresa', $e)->first();

				if (isset($issetEmpresa)) {
					$profissional->from('tb_medico_clinica')->where(['id_medico' => $id_profissional->id, 'id_empresa' => $e])->update($medico_clinica);
				} else {
					$profissional->from('tb_medico_clinica')->insert($medico_clinica);
				}

			}

		}

		return redirect()->route('clinica.profissionais.index')->with(['message' => 'Profissional atualizado com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, ProfissionalModel $profissional)
	{

		$data     = $request->all();
		$empresas = $data['empresas'];

		dd($data, 'teste');
		unset($data['_method'], $data['_token'], $data['id'], $data['categoria'], $data['empresas']);

		$request->validate([
			'profissional' => [
				'required',
				Rule::unique('medicus.tb_medico', 'profissional')->ignore($request->id, 'id'),
			],
		]);

		$data['status'] = $data['status'] ?? '0';

		$profissional->where('id', $request->id)->update($data);

		return redirect()->route('clinica.profissionais.index')->with(['message' => 'Profissional atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, ProfissionalModel $profissional)
	{

		// // $this->authorize('delete', PacienteModel::class);

		if ($profissional->where('id', $request->id)->delete()) {
			$message = 'Profissional removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.profissionais.index')->with(['message' => $message]);

	}

}
