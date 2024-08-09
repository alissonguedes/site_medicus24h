<?php

namespace App\Http\Requests\Clinica;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteHomecareRequest extends FormRequest {

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

		$rules = [
			'paciente' => 'required',
		];

		// if (isset($_POST['nome_paciente'])) {
		// 	unset($rules['nome']);

		// 	$id           = request()->paciente && is_numeric(request()->paciente) ? request()->paciente : null;
		// 	$rules['cpf'] = ['required', Rule::unique('medicus.tb_paciente', 'cpf')->ignore($id, 'id')];

		// } else {

		// 	$rules['cpf'] = ['required', Rule::unique('medicus.tb_paciente', 'cpf')->ignore($this->id, 'id')];

		// }

		if (!isset($_POST['programa'])) {
			$rules['programa'] = 'required';
		}

		return $rules;

	}

}
