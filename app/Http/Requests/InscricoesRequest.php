<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscricoesRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {
		return [
			'cpf'         => 'required|regex:/^(\d){11}$/',
			'nome'        => ['required'],
			'email'       => ['required'],
			'celular'     => ['required'],
			'uf'          => ['required'],
			'cidade'      => ['required'],
			'igreja'      => ['required'],
			'funcao'      => ['required'],
			'transporte'  => ['required'],
			'data_viagem' => ['requiredIf:transporte,carro'],
		];
	}

	/**
	 * Get the messages rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function messages(): array {
		return [
			'cpf'        => ['required' => 'Campo obrigatório', 'regex' => 'Campo inválido. Apenas números.'],
			'nome'       => ['required' => 'Campo obrigatório'],
			'email'      => ['required' => 'Campo obrigatório'],
			'celular'    => ['required' => 'Campo obrigatório'],
			'uf'         => ['required' => 'Campo obrigatório'],
			'cidade'     => ['required' => 'Campo obrigatório'],
			'igreja'     => ['required' => 'Campo obrigatório'],
			'funcao'     => ['required' => 'Campo obrigatório'],
			'transporte' => ['required' => 'Campo obrigatório'],
			// 'data_viagem' => ['requiredIf' => 'Campo obrigatório'],
		];
	}

}
