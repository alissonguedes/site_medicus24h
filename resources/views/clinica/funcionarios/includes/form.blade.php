<x-slot:forms>

	<x-form action="{{ route('clinica.funcionarios.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		<input type="hidden" name="categoria" value="funcionario">

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $funcionario->id }}">
		@endif

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<!-- BEGIN dados-pessoais -->
					<div id="dados-pessoais">

						<div class="row">
							<div class="col s12 mb-3">
								<h5>Cadastro do funcionário</h5>
							</div>
						</div>

						<div class="row">
							<div class="col s8">
								<div class="input-field">
									<label for="nome" class="{{ isset($funcionario) && $funcionario->nome ? 'active' : null }}">Funcionário</label>
									<input type="text" name="nome" id="nome" value="{{ $funcionario->nome ?? null }}">
								</div>
							</div>
							<div class="col s12 m6 l4">
								<div class="input-field @error('matricula') error @enderror">
									@php
										if (isset($matricula) && !empty($paciente->matricula)):
										    session()->forget('matricula');
										    $matricula = $paciente->matricula;
										endif;
									@endphp
									<label for="matricula">Matrícula</label>
									<input type="text" name="matricula" id="matricula" value="{{ old('matricula', isset($matricula) ? $matricula : null) }}" autocapitalize="on">
									<small class="info grey-text"> Em branco, será gerado automaticamente. </small>
									@error('matricula')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m6 l6">
								<div class="input-field @error('cpf') error @enderror">
									<label for="cpf" class="{{ isset($funcionario) && $funcionario->cpf ? 'active' : null }}">CPF</label>
									<input type="tel" name="cpf" id="cpf" value="{{ old('cpf', $funcionario->cpf ?? null) ?? null }}" data-mask="cpf" @readonly(request('id'))>
									@error('cpf')
										{{ $message }}
									@enderror
								</div>
							</div>
							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="rg" class="{{ isset($funcionario) && $funcionario->rg ? 'active' : null }}">RG</label>
									<input type="tel" name="rg" id="rg" value="{{ $funcionario->rg ?? null }}">
								</div>
							</div>
						</div>

						<div class="row">

							<div class="col s12 m6 l4">
								<div class="input-field @error('data_nascimento') error @enderror">
									<label for="data_nascimento" class="active">Data de nascimento</label>
									<input type="text" name="data_nascimento" class="datepicker" value="{{ old('data_nascimento', isset($funcionario) ? date('d/m/Y', strtotime($funcionario->data_nascimento)) : null) }}" data-mask="date" data-max-date="{{ date('d/m/Y') }}" placeholder="dd/mm/yyyy" maxlength="10">
									@error('data_nascimento')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>

							<div class="col s12 m6 l4">
								<div class="input-field @error('sexo') error @enderror">
									<label for="" class="active">Sexo</label>
									<div style="position: relative; top: 10px; margin: 15px 0; display: flex;">
										<label class="input mr-6">
											<input type="radio" name="sexo" class="with-gap" value="M" @checked(old('sexo', isset($funcionario->sexo) && $funcionario->sexo == 'M'))>
											<span>Masculino</span>
										</label>
										<label class="input">
											<input type="radio" name="sexo" class="with-gap" value="F" @checked(old('sexo', isset($funcionario->sexo) && $funcionario->sexo == 'F'))>
											<span>Feminino</span>
										</label>
									</div>
									@error('sexo')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="perfil" class="active">Perfil de acesso</label>
									<select name="perfil" id="perfil">
										<option value="" disabled selected>Informe o perfil de acesso</option>
										@if (isset($perfis))
											@foreach ($perfis as $perfil)
												<option value="{{ $perfil->id }}" @selected(isset($funcionario) && $perfil->id == $funcionario->perfil)>{{ $perfil->grupo }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>

						<div id="dados_medicos" class="row" @if (!isset($funcionario) || (isset($funcionario) && $funcionario->id_funcao !== 2)) style="display: none;" @endif>

							<div class="col s12 m6">
								<div class="input-field">
									<label for="crm" class="{{ isset($funcionario) && $funcionario->crm ? 'active' : null }}">CRM</label>
									<input type="text" name="crm" id="crm" value="{{ $funcionario->crm ?? null }}" @if (!isset($funcionario) || (isset($funcionario) && $funcionario->id_funcao !== 2)) disabled="disabled" @endif>
								</div>
							</div>

							{{-- <div class="col s12 m6">
								<div class="input-field">
									<label for="especialidade" class="active">Especialidade</label>
									<select name="especialidade" id="especialidade" class="autocomplete" data-url="{{ route('clinica.especialidades.autocomplete') }}" data-placeholder="Informe a especialidade..." @if (!isset($funcionario) || (isset($funcionario) && $funcionario->id_funcao !== 2)) disabled="disabled" @endif>
										<option value="" disabled>Informe a especialidade</option>
										@if (isset($funcionario) && isset($especialidades))
											@foreach ($especialidades as $especialidade)
												<option value="{{ $especialidade->id }}" {{ isset($funcionario) && $especialidade->id == $funcionario->especialidade ? 'selected=selected' : null }}>{{ $especialidade->especialidade }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div> --}}

						</div>

						{{-- <div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="clinica" class="active">Clínica</label>
									<select name="clinica" id="clinica" class="autocomplete" data-url="{{ route('clinica.funcionario.autocomplete_clinica') }}" data-placeholder="Informe a clínica...">
										<option value="" disabled selected>Informe a clínica</option>
										@if (isset($funcionario) && isset($clinicas))
											@foreach ($clinicas as $clinica)
												<option value="{{ $clinica->id }}" @selected(isset($funcionario) && $clinica->id == $funcionario->id_clinica)>{{ $clinica->titulo }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div> --}}

						{{-- <div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="departamento" class="active">Departamento</label>
									<select name="departamento" id="departamento" class="autocomplete" data-url="{{ route('clinica.departamentos.autocomplete') }}" data-placeholder="Informe o departamento..." @empty($funcionario) disabled="disabled" @endempty>
										<option value="" disabled selected>Informe o departamento</option>
										@if (isset($departamentos))
											@foreach ($departamentos as $departamento)
												<option value="{{ $departamento->id }}" @selected(isset($funcionario) && $departamento->id == $funcionario->id_departamento)>{{ $departamento->titulo }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div> --}}

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<label for="status" class="active">Funcionário ativo</label>
									<div id="status" class="switch">
										<label>
											Não
											<input type="checkbox" name="status" id="status" value="1" @checked(!isset($funcionario) || ($funcionario && $funcionario->status == '1'))>
											<span class="lever"></span>
											Sim
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- END dados-pessoais -->

			</div>

		</x-slot:content>

		<x-slot:footer>
			<div class="row">
				<div class="col s12 right-align">
					<button type="reset" class="btn btn-large waves-effect">
						<i class="material-symbols-outlined hide-on-small-only left">cancel</i>
						<span class="">Cancelar</span>
					</button>
					<button type="submit" class="btn btn-large waves-effect">
						<i class="material-symbols-outlined hide-on-small-only left">save</i>
						<span class="">Salvar</span>
					</button>
				</div>
			</div>
		</x-slot:footer>

		@include('clinica.funcionarios.includes.scripts')

	</x-form>

	{{-- @if (isset($id))
		<form action="{{ route('clinica.funcionarios.delete') }}" method="post" id="form-delete">
			<div id="funcionario_{{ $id }}" class="confirm_delete">
				<div class="card z-depth-4 gradient-45deg-teal-teal">
					@csrf
					<input type="hidden" name="_method" value="delete">
					<div class="card-content white-text">
						<input type="hidden" name="id" value="{{ $id ?? null }}">
						<p class="bold">Remover funcionario.</p>
						<br>
						<p>Tem certeza que deseja remover este funcionario?</p>
						<p>Funcionario {{ $nome . ' - ' . $id }}</p>
					</div>
					<div class="card-footer border-top grey-border border-lighten-3 padding-2">
						<button type="reset" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
						<button type="submit" id="confirm" class="btn red waves-effect right" style="align-items: center; display: flex; background-color: var(--red) !important;">Confirmar</button>
					</div>
				</div>
			</div>
		</form>
	@endif --}}

	<x-slot:form_delete action="{{ route('clinica.funcionarios.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este funcionario?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
