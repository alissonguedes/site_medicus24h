<x-slot:forms>

	<x-form action="{{ route('clinica.procedimentos.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		{{-- <input type="hidden" name="categoria" value="procedimento"> --}}

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $procedimento->id }}">
		@endif

		{{-- <x-slot:tabs>
			<ul class="tabs tabs-fixed-width">
				<li class="tab"><a href="#dados-exame" class="active">Dados do Exame</a></li>
				<li class="tab"><a href="#condicoes">Condições</a></li>
				<li class="tab"><a href="#regras">Regras</a></li>
				<li class="tab"><a href="#informacoes-adicionais">Informações adicionais</a></li>
			</ul>
		</x-slot:tabs> --}}

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<div id="dados-exame">

						<div class="row">
							<div class="col s12">
								<h6>Dados do Exame</h6>
							</div>
						</div>

						<div class="row">

							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="titulo" class="{{ isset($procedimento) && $procedimento->titulo ? 'active' : null }}">Nome do exame</label>
									<input type="text" name="titulo" id="titulo" value="{{ $procedimento->titulo ?? null }}">
								</div>
							</div>

							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="valor" class="{{ isset($procedimento) && $procedimento->valor ? 'active' : 'active' }}">Valor</label>
									<input type="tel" name="valor" id="valor" value="{{ isset($procedimento) ? number_format($procedimento->valor, 2, ',', '.') : '0,00' }}" data-mask="decimal" data-onevent="keydown" data-align="right" maxlength="16">
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="descricao" class="{{ isset($procedimento) && $procedimento->descricao ? 'active' : null }}">Descrição</label>
									<textarea name="descricao" id="descricao" class="materialize-textarea">{{ $procedimento->descricao ?? null }}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m6 l8">
								<div class="input-field">
									<label for="categoria" class="active">Tipo de exame</label>
									<select name="categoria" id="categoria">
										<option value="1" selected>Informe o tipo de exame</option>
										@if (isset($categorias))
											@foreach ($categorias as $categoria)
												<option value="{{ $categoria->id_categoria }}" @selected(isset($procedimento) && $categoria->id_categoria == $procedimento->id_categoria)>{{ $categoria->titulo }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>

							<div class="col s12 m6 l4">

								<div class="row">

									<div class="col s8">
										<div class="input-field">
											<label for="tempo" class="{{ isset($procedimento) && $procedimento->tempo ? 'active' : 'active' }}">Tempo estimado</label>
											@props(['count' => 60, 'step' => 1])
											<select name="tempo" id="tempo">
												@for ($i = 1; $i <= $count / $step; $i++)
													<option value="{{ $i }}" @selected(old('tempo', isset($procedimento) ? $procedimento->tempo == $i : null))> {{ $i * $step }} </option>
												@endfor
											</select>
										</div>
									</div>

									<div class="col s4">
										<div class="input-field">
											<select name="formato" id="formato">
												<option value="m" @selected(old('formato', (isset($procedimento) ? $procedimento->formato == 'm' : null)))>Minutos</option>
												<option value="h" @selected(old('formato', (isset($procedimento) ? $procedimento->formato == 'h' : null)))>Horas</option>
											</select>
										</div>
									</div>

								</div>

							</div>

						</div>

						{{-- <div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<label for="status" class="active">Exame ativo</label>
								</div>
								<div id="status" class="switch">
									<label>
										Não
										<input type="checkbox" name="status" id="status" value="1" @checked(!isset($procedimento) || ($procedimento && $procedimento->status == 'Ativo'))>
										<span class="lever"></span>
										Sim
									</label>
								</div>
							</div>
						</div> --}}

					</div>

					<!-- BEGIN condicoes -->
					<div id="condicoes">

					</div>
					<!-- END condicoes -->

					<!-- BEGIN regras -->
					<div id="regras">

					</div>
					<!-- END regras -->

					<!-- BEGIN informacoes-adicionais -->
					<div id="informacoes-adicionais">

					</div>
					<!-- END informacoes-adicionais -->

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

		@include('clinica.procedimentos.includes.scripts')

	</x-form>

	{{-- @if (isset($id))
		<form action="{{ route('clinica.procedimentos.delete') }}" method="post" id="form-delete">
			<div id="procedimento_{{ $id }}" class="confirm_delete">
				<div class="card z-depth-4 gradient-45deg-teal-teal">
					@csrf
					<input type="hidden" name="_method" value="delete">
					<div class="card-content white-text">
						<input type="hidden" name="id" value="{{ $id ?? null }}">
						<p class="bold">Remover procedimento.</p>
						<br>
						<p>Tem certeza que deseja remover este procedimento?</p>
						<p>Procedimento {{ $nome . ' - ' . $id }}</p>
					</div>
					<div class="card-footer border-top grey-border border-lighten-3 padding-2">
						<button type="reset" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
						<button type="submit" id="confirm" class="btn red waves-effect right" style="align-items: center; display: flex; background-color: var(--red) !important;">Confirmar</button>
					</div>
				</div>
			</div>
		</form>
	@endif --}}

	<x-slot:form_delete action="{{ route('clinica.procedimentos.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este procedimento?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
