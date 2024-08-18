<x-slot:forms>

	<x-form action="{{ route('clinica.grupos.usuarios.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		<input type="hidden" name="categoria" value="perfil">

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $perfil->id }}">
		@endif

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<!-- BEGIN dados-pessoais -->
					<div id="dados-pessoais">

						<div class="row">
							<div class="col s12 mb-3">
								<h5>Cadastro de Perfil</h5>
							</div>
						</div>

						{{-- @props(['perfis' => [1 => 'Super Administrador', 2 => 'Admin', 3 => 'Gerente de TI', 4 => 'Gerente Comercial', 5 => 'Vendedor', 6 => 'Recepcionista', 7 => 'Médico', 8 => 'Técnico de Enfermagem']]) --}}

						<div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="perfil" class="active">Perfil de acesso</label>
									<input type="text" name="perfil" id="perfil" value="{{ old('perfil', $perfil->grupo ?? null) }}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<label for="status" class="active">Perfil ativo</label>
									<div id="status" class="switch">
										<label>
											Não
											<input type="checkbox" name="status" id="status" value="1" @checked(!isset($perfil) || ($perfil && $perfil->status == '1'))>
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

		@include('clinica.funcionarios.perfil_acesso.includes.scripts')

	</x-form>

	{{-- @if (isset($id))
		<form action="{{ route('clinica.grupos.usuarios.delete') }}" method="post" id="form-delete">
			<div id="perfil_{{ $id }}" class="confirm_delete">
				<div class="card z-depth-4 gradient-45deg-teal-teal">
					@csrf
					<input type="hidden" name="_method" value="delete">
					<div class="card-content white-text">
						<input type="hidden" name="id" value="{{ $id ?? null }}">
						<p class="bold">Remover perfil.</p>
						<br>
						<p>Tem certeza que deseja remover este perfil?</p>
						<p>Perfil {{ $nome . ' - ' . $id }}</p>
					</div>
					<div class="card-footer border-top grey-border border-lighten-3 padding-2">
						<button type="reset" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
						<button type="submit" id="confirm" class="btn red waves-effect right" style="align-items: center; display: flex; background-color: var(--red) !important;">Confirmar</button>
					</div>
				</div>
			</div>
		</form>
	@endif --}}

	<x-slot:form_delete action="{{ route('clinica.grupos.usuarios.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este perfil?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
