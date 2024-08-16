<x-slot:forms>

	<x-form action="{{ route('clinica.funcionarios.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		{{-- <input type="hidden" name="categoria" value="funcionario"> --}}

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $funcionario->id }}">
		@endif

		{{-- <x-slot:tabs>
			<ul class="tabs tabs-fixed-width">
				<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
				<li class="tab"><a href="#contato">Contato</a></li>
				<li class="tab"><a href="#endereco">Endereço</a></li>
				<li class="tab"><a href="#informacoes-adicionais">Informações adicionais</a></li>
			</ul>
		</x-slot:tabs> --}}

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
							<div class="col s12">
								<div class="input-field">
									<label for="nome" class="{{ isset($row) && $row->nome ? 'active' : null }}">Funcionário</label>
									<input type="text" name="nome" id="nome" value="{{ $row->nome ?? null }}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="cpf" class="{{ isset($row) && $row->cpf ? 'active' : null }}">CPF</label>
									<input type="tel" name="cpf" id="cpf" value="{{ $row->cpf ?? null }}" data-mask="cpf">
								</div>
							</div>
							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="rg" class="{{ isset($row) && $row->rg ? 'active' : null }}">RG</label>
									<input type="tel" name="rg" id="rg" value="{{ $row->rg ?? null }}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="funcao" class="active">Função</label>
									<select name="funcao" id="funcao">
										<option value="" disabled selected>Informe a função</option>
										@if (isset($funcoes))
											@foreach ($funcoes as $funcao)
												<option value="{{ $funcao->id }}" @selected(isset($row) && $funcao->id == $row->id_funcao)>{{ $funcao->funcao }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div>

						<div id="dados_medicos" class="row" @if (!isset($row) || (isset($row) && $row->id_funcao !== 2)) style="display: none;" @endif>

							<div class="col s12 m6">
								<div class="input-field">
									<label for="crm" class="{{ isset($row) && $row->crm ? 'active' : null }}">CRM</label>
									<input type="text" name="crm" id="crm" value="{{ $row->crm ?? null }}" @if (!isset($row) || (isset($row) && $row->id_funcao !== 2)) disabled="disabled" @endif>
								</div>
							</div>

							{{-- <div class="col s12 m6">
								<div class="input-field">
									<label for="especialidade" class="active">Especialidade</label>
									<select name="especialidade" id="especialidade" class="autocomplete" data-url="{{ route('clinica.especialidades.autocomplete') }}" data-placeholder="Informe a especialidade..." @if (!isset($row) || (isset($row) && $row->id_funcao !== 2)) disabled="disabled" @endif>
										<option value="" disabled>Informe a especialidade</option>
										@if (isset($row) && isset($especialidades))
											@foreach ($especialidades as $especialidade)
												<option value="{{ $especialidade->id }}" {{ isset($row) && $especialidade->id == $row->especialidade ? 'selected=selected' : null }}>{{ $especialidade->especialidade }}</option>
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
										@if (isset($row) && isset($clinicas))
											@foreach ($clinicas as $clinica)
												<option value="{{ $clinica->id }}" @selected(isset($row) && $clinica->id == $row->id_clinica)>{{ $clinica->titulo }}</option>
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
									<select name="departamento" id="departamento" class="autocomplete" data-url="{{ route('clinica.departamentos.autocomplete') }}" data-placeholder="Informe o departamento..." @empty($row) disabled="disabled" @endempty>
										<option value="" disabled selected>Informe o departamento</option>
										@if (isset($departamentos))
											@foreach ($departamentos as $departamento)
												<option value="{{ $departamento->id }}" @selected(isset($row) && $departamento->id == $row->id_departamento)>{{ $departamento->titulo }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
						</div> --}}

						<div class="row">
							<div class="col s12 m4 l4">
								<label for="status" class="active blue-text text-accent-1">Funcionário ativo</label>
								<div id="status" class="switch">
									<label>
										Não
										<input type="checkbox" name="status" id="status" value="1" @checked(!isset($row) || ($row && $row->status == 'Ativo'))>
										<span class="lever"></span>
										Sim
									</label>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- END dados-pessoais -->

				{{-- <!-- BEGIN contato -->
				<div id="contato">

					<div class="row">
						<div class="col s12 mb-3">
							<h5>Contato</h5>
						</div>
					</div>

				</div>
				<!-- END contato -->

				<!-- BEGIN endereco -->
				<div id="endereco">

					<div class="row">
						<div class="col s12 mb-3">
							<h5>Endereço</h5>
						</div>
					</div>

				</div>
				<!-- END endereco -->

				<!-- BEGIN informacoes-adicionais -->
				<div id="informacoes-adicionais">

					<div class="row">
						<div class="col s12 mb-3">
							<h5>Informações Adicionais</h5>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<ul class="tabs border-bottom">
								<li class="tab"><a href="#dados-acesso">Dados de acesso</a></li>
								<li class="tab"><a href="#permissoes">Permissões</a></li>
							</ul>
						</div>
					</div>

					<!-- BEGIN dados-acesso -->
					<div id="dados-acesso">

						<div class="row">
							<div class="col s12 mb-3">
								<h5>Dados de Acesso</h5>
							</div>
						</div>

					</div>
					<!-- END dados-acesso -->

					<!-- BEGIN permissoes -->
					<div id="permissoes">

						<div class="row">
							<div class="col s12 mb-3">
								<h5>Permissões</h5>
							</div>
						</div>

					</div>
					<!-- END permissoes -->

				</div>
				<!-- END informacoes-adicionais --> --}}

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
