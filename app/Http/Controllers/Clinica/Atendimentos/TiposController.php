<?php

namespace App\Http\Controllers\Clinica\Atendimentos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiposController extends Controller {

	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		//
	}

	public function autocomplete(Request $request) {

		$atendimentos = [];

		$atendimento = DB::connection('medicus')
			->table('tb_atendimento_tipo')
			->select('tipo', 'id')
			->whereAny(['tipo'], 'like', request('search') . '%')
			->get();

		if ($atendimento->count() > 0) {
			foreach ($atendimento as $p) {
				$atendimentos[] = ['text' => $p->tipo, 'id' => $p->id];
			}
		}

		return $atendimentos;
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
