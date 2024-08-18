<?php

namespace App\Http\Controllers\Clinica\Funcionarios;

use App\Http\Controllers\Controller;
use App\Models\Clinica\FuncionarioModel;
use Illuminate\Http\Request;

class PerfisController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, FuncionarioModel $funcionario) {

		$dados['perfis'] = $funcionario->setConnection('system')->select('id', 'grupo', 'status')->from('tb_acl_grupo')->where('id', '<>', 1)->where('is_deleted', '0')->get();
		$dados['perfil'] = $funcionario->setConnection('system')->from('tb_acl_grupo')->where('id', $request->id)->first();

		return view('clinica.funcionarios.perfil_acesso.index', $dados);

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
	public function store(Request $request, FuncionarioModel $perfil) {

		$data = $request->all();

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		$data['grupo'] = $data['perfil'];

		unset($data['id'], $data['_method'], $data['_token'], $data['categoria'], $data['perfil']);

		$perfil->setConnection('system')->from('tb_acl_grupo')->insert($data);

		if ($request->_method === 'put') {
			$message = 'Perfil atualizado com sucesso!';
		} else {
			$message = 'Perfil cadastrado com sucesso!';
		}

		return redirect()->route('clinica.grupos.usuarios.index')->with(['message' => $message]);

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
	public function update(Request $request, FuncionarioModel $perfil) {

		$data = $request->all();

		if (empty($data['imagem'])) {
			unset($data['imagem']);
		}

		if (empty($data['status'])) {
			$data['status'] = '0';
		}

		$data['grupo'] = $data['perfil'];

		unset($data['id'], $data['_method'], $data['_token'], $data['categoria'], $data['perfil']);

		$perfil->setConnection('system')->from('tb_acl_grupo')->where(['id' => $request->id])->update($data);

		if ($request->_method === 'put') {
			$message = 'Perfil atualizado com sucesso!';
		} else {
			$message = 'Perfil cadastrado com sucesso!';
		}

		return redirect()->route('clinica.grupos.usuarios.index')->with(['message' => $message]);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request, FuncionarioModel $funcionario) {

		// // $this->authorize('delete', PacienteModel::class);

		if ($funcionario->setConnection('system')->from('tb_acl_grupo')->where('id', $request->id)->update(['is_deleted' => '1', 'deleted_at' => date('Y-m-d H:i:s')])) {
			$message = 'Funcionário removido com sucesso!';
		} else {
			$message = 'Não foi possível encontrar o registro';
		}

		return redirect()->route('clinica.grupos.usuarios.index')->with(['message' => $message]);

	}

}
