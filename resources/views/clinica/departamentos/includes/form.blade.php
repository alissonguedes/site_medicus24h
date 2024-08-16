<x-slot:forms>

	<x-form action="{{ route('clinica.departamentos.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		<input type="hidden" name="categoria" value="departamento">

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $departamento->id }}">
		@endif

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<div class="row">
						<div class="col s12 mb-3">
							<h5>Cadastro do funcionário</h5>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<label for="titulo" class="{{ isset($departamento) && $departamento->titulo ? 'active' : null }}">Título</label>
								<input type="text" name="titulo" id="titulo" value="{{ $departamento->titulo ?? null }}" autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<label for="descricao" class="{{ isset($departamento) && $departamento->descricao ? 'active' : null }}">Descrição</label>
								<textarea name="descricao" id="descricao" class="materialize-textarea">{{ $departamento->descricao ?? null }}</textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<label for="status" class="active">Departamento ativo</label>
								<div id="status" class="switch">
									<label>
										Off
										<input type="checkbox" name="status" id="status" value="1" @checked(!isset($departamento) || (isset($departamento) && $departamento->status == '1'))>
										<span class="lever"></span>
										On
									</label>
								</div>
							</div>
						</div>
					</div>

				</div>

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

		@include('clinica.departamentos.includes.scripts')

	</x-form>

	{{-- @if (isset($id))
		<form action="{{ route('clinica.departamentos.delete') }}" method="post" id="form-delete">
			<div id="departamento_{{ $id }}" class="confirm_delete">
				<div class="card z-depth-4 gradient-45deg-teal-teal">
					@csrf
					<input type="hidden" name="_method" value="delete">
					<div class="card-content white-text">
						<input type="hidden" name="id" value="{{ $id ?? null }}">
						<p class="bold">Remover departamento.</p>
						<br>
						<p>Tem certeza que deseja remover este departamento?</p>
						<p>Departamento {{ $nome . ' - ' . $id }}</p>
					</div>
					<div class="card-footer border-top grey-border border-lighten-3 padding-2">
						<button type="reset" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
						<button type="submit" id="confirm" class="btn red waves-effect right" style="align-items: center; display: flex; background-color: var(--red) !important;">Confirmar</button>
					</div>
				</div>
			</div>
		</form>
	@endif --}}

	<x-slot:form_delete action="{{ route('clinica.departamentos.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este departamento?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
