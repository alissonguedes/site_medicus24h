<?php

namespace App\Http\Requests\Clinica;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteRequest extends FormRequest
{

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{

		$rules = [
			'nome'       => 'required',
			'mae'        => 'nullable',
			'pai'        => 'nullable',
			'telefone'   => 'required_if:celular,null',
			'celular'    => 'required_if:telefone,null|required_if:receber_sms,on',
			'email'      => 'nullable|email|required_if:receber_notificacoes,on',
			'data_obito' => 'required_if:obito,true',
			'hora_obito' => Rule::requiredIf($this->obito == 1 || $this->data_obito),
			'cpf'        => 'required',
		];

		if (isset($_POST['nome_paciente'])) {
			unset($rules['nome']);

			$id           = request()->paciente && is_numeric(request()->paciente) ? request()->paciente : null;
			$rules['cpf'] = ['required', Rule::unique('medicus.tb_paciente', 'cpf')->ignore($id, 'id')];

		} else {

			$rules['cpf'] = ['required', Rule::unique('medicus.tb_paciente', 'cpf')->ignore($this->id, 'id')];

		}

		if ($this->associado === 'yes') {
			// $rules['matricula']        = 'required';
			$rules['id_acomodacao']    = 'required';
			$rules['validade_mes']     = 'required';
			$rules['validade_ano']     = 'required';
			$rules['id_tipo_convenio'] = 'required';
		}

		return $rules;

	}

}
