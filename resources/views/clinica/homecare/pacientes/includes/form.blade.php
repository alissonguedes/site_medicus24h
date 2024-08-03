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

<x-slot:forms>

	@include('clinica.homecare.pacientes.includes.tickets.form')

	<x-form action="{{ route('clinica.homecare.pacientes.post') }}">

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

						<select name="paciente" id="ppaciente" class="autocomplete" data-url="{{ route('clinica.homecare.pacientes.search') }}" placeholder="Pesquise pelo Nome, CPF, Matrícula ou RG"></select>

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

						<select name="programa[]" id="pprograma" class="autocomplete" data-url="{{ route('clinica.homecare.programas.search') }}" placeholder="" multiple></select>

						@error('programa')
							{{ $message }}
						@enderror

					</div>
				</div>
			</div>

		</div>

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

		@include('clinica.homecare.pacientes.includes.scripts')

	</x-form>

</x-slot:forms>
