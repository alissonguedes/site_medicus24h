<?php

namespace App\Http\Controllers\Clinica\Funcionarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinica\FuncionarioRequest;
use App\Models\Clinica\FuncionarioModel;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, FuncionarioModel $funcionario)
	{

		$dados['funcionarios'] = $funcionario->where('is_deleted', '0')->get();
		$dados['funcionario']  = $funcionario->where('id', $request->id)->first();
		$dados['perfis']       = $funcionario->setConnection('system')->select('id', 'grupo', 'status')->from('tb_acl_grupo')->where('id', '<>', 1)->where('is_deleted', '0')->get();

		return view('clinica.funcionarios.index', $dados);

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
	public function store(FuncionarioRequest $request, FuncionarioModel $funcionario)
	{

		$data = $request->all();

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		unset($data['id'], $data['_method'], $data['_token'], $data['categoria']);

		$data['data_nascimento'] = isset($data['data_nascimento']) ? date('Y-m-d', strtotime(str_replace('/', '-', $data['data_nascimento']))) : null;
		$data['cpf']             = format($request->cpf, 'cpf');

		$funcionario->updateOrCreate(['cpf' => $request->cpf], $data);

		if ($request->_method === 'put') {
			$message = 'Funcionário atualizado com sucesso!';
		} else {
			$message = 'Funcionário cadastrado com sucesso!';
		}

		return redirect()->route('clinica.funcionarios.index')->with(['message' => $message]);

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
	public function update(Request $request, FuncionarioModel $funcionario)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, FuncionarioModel $funcionario)
	{

		// // $this->authorize('delete', PacienteModel::class);

		if ($funcionario->where('id', $request->id)->update(['is_deleted' => '1', 'deleted_at' => date('Y-m-d H:i:s')])) {
			$message = 'Funcionário removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.funcionarios.index')->with(['message' => $message]);

	}
}
