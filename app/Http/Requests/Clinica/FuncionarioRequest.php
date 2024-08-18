<?php

namespace App\Http\Requests\Clinica;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FuncionarioRequest extends FormRequest {

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
			'nome'   => 'required',
			'cpf'    => [
				'required',
				Rule::unique('medicus.tb_funcionario', 'cpf')->ignore($this->id, 'id'),
				new \App\Rules\CPF(),
			],
			'perfil' => 'required',
			// 'telefone'   => 'required_if:celular,null',
			// 'celular'    => 'required_if:telefone,null|required_if:receber_sms,on',
			// 'email'      => 'nullable|email|required_if:receber_notificacoes,on',
		];

		// if (isset($_POST['nome_paciente'])) {
		// 	unset($rules['nome']);

		// 	$id           = request()->paciente && is_numeric(request()->paciente) ? request()->paciente : null;
		// 	$rules['cpf'] = ['required', Rule::unique('medicus.tb_paciente', 'cpf')->ignore($id, 'id')];

		// } else {

		// 	$rules['cpf'] = ['required', Rule::unique('medicus.tb_paciente', 'cpf')->ignore($this->id, 'id')];

		// }

		// if ($this->associado === 'yes') {
		// 	// $rules['matricula']        = 'required';
		// 	$rules['id_acomodacao']    = 'required';
		// 	$rules['validade_mes']     = 'required';
		// 	$rules['validade_ano']     = 'required';
		// 	$rules['id_tipo_convenio'] = 'required';
		// }

		return $rules;

	}

}
