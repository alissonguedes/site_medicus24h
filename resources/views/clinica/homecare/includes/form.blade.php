<x-header-page data-href="{{ route('clinica.homecare.gestao-de-cuidados') }}" data-tooltip="Novo Programa" placeholder="Pesquisar programas...">
	<x-slot:add_button>
		add
	</x-slot:add_button>
</x-header-page>

@if (request('id'))
	@php
		$id = request('id');
	@endphp
@endif

<x-slot:form action="{{ route('clinica.homecare.gestao-de-cuidados.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	<x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#programa">Programa</a></li>
			<li class="tab"><a href="#tarefas">Tarefas</a></li>
		</ul>
	</x-slot:form_tabs>

	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div id="programa">

		<div class="row">
			<div class="col s12 mb-3">
				<h6>Programa</h6>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="input-field @error('nome_programa') error @enderror">
					<label for="nome_programa">Nome do programa</label>
					<input type="text" name="nome_programa" id="nome_programa" value="{{ old('nome_programa', $progrma ?? null) }}">
					@error('nome_programa')
						{{ $message }}
					@enderror
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="input-field @error('sexo') error @enderror">
					<label for="sexo">Público alvo</label>
					<select name="sexo" id="sexo">
						<option value="T">Indiferente</option>
						<option value="M">Homens</option>
						<option value="F">Mulheres</option>
					</select>
					@error('sexo')
						{{ $message }}
					@enderror
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="range-field @error('faixa_etaria') error @enderror">
					<label for="faixa_etaria">Faixa etária</label>
					<input type="hidden" name="faixa_etaria" value="{{ 0 }} - {{ 100 }}">
					<div id="faixa_etaria" class="mt-2 mb-2"></div>
					@error('faixa_etaria')
						{{ $message }}
					@enderror
				</div>
				<div class="label">
					De <b id="slider-snap-value-lower"></b> a <b id="slider-snap-value-upper"></b> anos.
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="input-field mt-3 @error('responsaiveis') error @enderror">
					<label for="responsaveis" class="active">Profissionais responsáveis</label>
					@dump(old('responsavies'))
					<select name="responsaveis[]" id="responsaveis" multiple>
						<option value="" disabled>Profissionais responsáveis</option>
						@php
							$responsaveis = null;
							$id_responsavies = null;
						@endphp
						<option class="filled-in" value="" @selected(old('responsaveis' ?? isset($responsaveis) && $responsaveis == $id_responsaveis))>Alisson</option>
						<option class="filled-in" value="" @selected(old('responsaveis' ?? isset($responsaveis) && $responsaveis == $id_responsaveis))>Guedes</option>
						<option class="filled-in" value="" @selected(old('responsaveis' ?? isset($responsaveis) && $responsaveis == $id_responsaveis))>Pereira</option>
					</select>
					@error('responsaveis')
						{{ $message }}
					@enderror
				</div>
			</div>
		</div>

	</div>

	<div id="tarefas">

		<div class="row">
			<div class="col s12 mb-3">
				<h6>Tarefas</h6>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<button type="button" id="criar-tarefa" class="btn mb-2">
					Criar Tarefa
				</button>
			</div>
		</div>

		<div class="row">

			<div class="col s12">

				<table id="table-tarefa" class="bordered">
					<thead>
						<tr>
							<th class="center-align">Descrição</th>
							<th class="center-align">Prazo de conclusão</th>
							<th class="center-align">Responsáveis</th>
							<th class="center-align">Tipo da tarefa</th>
							<th class="center-align"></th>
						</tr>
					</thead>
					<tbody>
						{{-- <tr>
							<td class="center-align">Aplicação de insulina</td>
							<td class="center-align">30 dias</td>
							<td class="center-align">Selecionar manualmente</td>
							<td class="center-align">Por Agendamento</td>
							<td class="center-align">Sim</td>
						</tr> --}}
					</tbody>
				</table>

			</div>

		</div>

		<div id="modal_tarefa" class="modal">
			<div class="modal-content">
				Tarefas
			</div>
		</div>

	</div>

	<x-slot:card_footer>
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
	</x-slot:card_footer>

	<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.css') }}">

	<script src="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.js') }}"></script>
	<script src="{{ asset('assets/js/clinica/homecare/gestao_cuidados.js') }}"></script>
	<script src="{{ asset('assets/js/clinica/homecare/modal_tarefas.js') }}"></script>

</x-slot:form>

{{-- <x-slot:scripts_form>
	<script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}" defer></script>
</x-slot:scripts_form> --}}
