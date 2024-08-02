<x-header-page data-href="{{ route('clinica.homecare.pacientes') }}" data-tooltip="Novo Programa" placeholder="Pesquisar programas...">
	<x-slot:add_button>
		add
	</x-slot:add_button>
</x-header-page>

@if (request('id'))
	@php
		$id = request('id');
		$titulo = $programa->titulo;
		$descricao = $programa->descricao;
		$sexo = $programa->publico;
		$idade_minima = $programa->idade_min;
		$idade_maxima = $programa->idade_max;
	@endphp
@endif

<x-slot:form action="{{ route('clinica.homecare.pacientes.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	{{-- <x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#programa">Paciente</a></li>
			<li class="tab"><a href="#tarefas">Tarefas</a></li>
		</ul>
	</x-slot:form_tabs> --}}

	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<div id="programa">

		<div class="row">
			<div class="col s12 mb-3">
				<h6>Gestão de Cuidados</h6>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="input-field @error('paciente') error @enderror">
					<label for="titulo" class="active">Paciente</label>

					<select name="paciente" id="paciente" class="autocomplete" data-url="{{ route('clinica.homecare.pacientes.search') }}" placeholder="Pesquise pelo Nome, CPF, Matrícula ou RG"></select>

					@error('paciente')
						{{ $message }}
					@enderror

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="input-field @error('programa') error @enderror">
					<label for="titulo" class="active">Programa</label>

					<select name="programa[]" id="programa" class="autocomplete" data-url="{{ route('clinica.homecare.programas.search') }}" placeholder="" multiple></select>

					@error('programa')
						{{ $message }}
					@enderror

				</div>
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

	{{-- <link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.css') }}">

	<script src="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.js') }}"></script>
	<script src="{{ asset('assets/js/clinica/homecare/gestao_cuidados.js') }}"></script>
	<script src="{{ asset('assets/js/clinica/homecare/modal_tarefas.js') }}"></script> --}}

	@include('clinica.homecare.pacientes.includes.scripts')

</x-slot:form>
