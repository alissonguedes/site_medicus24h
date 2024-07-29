<?php

namespace App\Http\Controllers\Clinica\Homecare;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\GestaoDeCuidadoRequest;
use App\Models\Clinica\PacienteModel;
use App\Models\Clinica\ProgramaModel;
use Illuminate\Http\Request;

class GestaoDeCuidadosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, ProgramaModel $programa)
	{

		$data['programas'] = $programa->get();
		$data['programa']  = $programa->where(['id' => $request->id])->get()->first();

		return view('clinica.homecare.index', $data);

	}

	/**
	 * Search banners
	 */
	public function search(Request $request, PacienteModel $paciente)
	{

		$data['pacientes'] = $paciente->search($request->search);

		return view('clinica.homecare.index', $data);

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
	public function store(GestaoDeCuidadoRequest $request, ProgramaModel $programa)
	{

		$data = $request->all();

		$responsaveis      = $data['responsaveis'];
		$faixa_etaria      = explode(' - ', $data['faixa_etaria']);
		$data['idade_min'] = $faixa_etaria[0];
		$data['idade_max'] = $faixa_etaria[1];
		$data['publico']   = $data['sexo'];

		unset($data['sexo'], $data['responsaveis'], $data['faixa_etaria'], $data['_token'], $data['id'], $data['_method']);

		$id_programa = $programa->insertGetId($data);

		// Cadastrar os responsáveis pelo programa
		foreach ($responsaveis as $r) {

			$id_responsavel = $r;

			$issetResponsavel = $programa->select('id_programa', 'id_profissional')->from('tb_programas_responsavel')
				->where('id_programa', $id_programa)
				->where('id_profissional', $id_responsavel)
				->get()
				->first();

			if (!isset($issetResponsavel)) {
				$programa->from('tb_programas_responsavel')
					->insert(['id_programa' => $id_programa, 'id_profissional' => $id_responsavel]);
			}

		}

		return redirect()->route('clinica.homecare.index')->with(['message' => 'Programa cadastrado com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(PacienteModel $pacienteModel)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(ProgramaModel $programa)
	{

		$data = $request->all();

		$responsaveis      = $data['responsaveis'];
		$faixa_etaria      = explode(' - ', $data['faixa_etaria']);
		$data['idade_min'] = $faixa_etaria[0];
		$data['idade_max'] = $faixa_etaria[1];
		$data['publico']   = $data['sexo'];

		unset($data['sexo'], $data['responsaveis'], $data['faixa_etaria'], $data['_token'], $data['id'], $data['_method']);

		$id_programa = $programa->where('id', $data['id'])->update($data);

		// Cadastrar os responsáveis pelo programa
		// foreach ($responsaveis as $r) {

		// 	$id_responsavel = $r;

		// 	$issetResponsavel = $programa->select('id_programa', 'id_profissional')->from('tb_programas_responsavel')
		// 		->where('id_programa', $id_programa)
		// 		->where('id_profissional', $id_responsavel)
		// 		->get()
		// 		->first();

		// 	if (!isset($issetResponsavel)) {
		// 		$programa->from('tb_programas_responsavel')
		// 			->insert(['id_programa' => $id_programa, 'id_profissional' => $id_responsavel]);
		// 	}

		// }

		// return redirect()->route('clinica.homecare.index')->with(['message' => 'Programa cadastrado com sucesso!']);

	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(GestaoDeCuidadoRequest $request, ProgramaModel $programa)
	{

		$data = $request->all();

		$id_programa       = $data['id'];
		$responsaveis      = $data['responsaveis'];
		$faixa_etaria      = explode(' - ', $data['faixa_etaria']);
		$data['idade_min'] = $faixa_etaria[0];
		$data['idade_max'] = $faixa_etaria[1];
		$data['publico']   = $data['sexo'];

		unset($data['sexo'], $data['responsaveis'], $data['faixa_etaria'], $data['_token'], $data['id'], $data['_method']);

		$programa->where('id', $id_programa)->update($data);

		$programa->from('tb_programas_responsavel')->where('id_programa', $id_programa)->delete();

		// Cadastrar os responsáveis pelo programa
		foreach ($responsaveis as $r) {

			$id_responsavel = $r;

			$issetResponsavel = $programa->select('id_programa', 'id_profissional')->from('tb_programas_responsavel')
				->where('id_programa', $id_programa)
				->where('id_profissional', $id_responsavel)
				->get()
				->first();

			if (!isset($issetResponsavel)) {
				$programa->from('tb_programas_responsavel')
					->insert(['id_programa' => $id_programa, 'id_profissional' => $id_responsavel]);
			}

		}

		return redirect()->route('clinica.homecare.index')->with(['message' => 'Programa alterado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(PacienteModel $pacienteModel)
	{

		//

	}
}
