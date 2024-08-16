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

		$dados['perfis'] = $funcionario->setConnection('system')->from('tb_acl_grupo')->get();
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
	public function store(Request $request) {
		//
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
	public function destroy(string $id) {
		//
	}
}
