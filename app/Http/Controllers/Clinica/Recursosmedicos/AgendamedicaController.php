<?php

namespace App\Http\Controllers\Clinica\Recursosmedicos;

use App\Http\Controllers\Controller;
use App\Models\FileModel;
use Illuminate\Http\Request;

class AgendamedicaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		return view('clinica.recursosmedicos.agenda.index');
	}

	/**
	 * Search banners
	 */
	public function search(Request $request)
	{

		// $data['pacientes'] = $paciente->search($request->search);

		// return view('clinica.pacientes.index', $data);

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
	public function store(Request $request)
	{

		$data = $request->all();

		$paciente->cadastra($request);

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente cadastrado com sucesso!']);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, FileModel $file, int $file_id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request)
	{

		return redirect()->route('clinica.pacientes.index')->with(['message' => 'Paciente atualizado com sucesso!']);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Request $request)
	{

		// return redirect()->route('clinica.pacientes.index')->with(['message' => $message]);

	}
}
