<?php

namespace App\Http\Requests\Clinica;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest {
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

		$data = [
			'clinica' => 'required',
		];

		if (!isset($_POST['especialidades'])) {

			$data['especialidades'] = ['required'];

		}

		if (!isset($_POST['horario'])) {

			$data['horario'] = ['required'];

		}

		return $data;
	}

	public function messages(): array {
		return [
			'clinica'  => [
				'required' => 'Você deve informar a qual clínica onde o médico atenderá esta agenda',
			],
			'horarios' => [
				'required' => 'Você deve informar ao menos um horário disponível.',
			],
		];
	}
}
