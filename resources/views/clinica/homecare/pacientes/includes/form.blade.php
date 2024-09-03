<x-slot:forms>

	{{-- @include('clinica.homecare.pacientes.includes.tickets.form') --}}
	@if (request('id'))
		@php
			$id = request('id');
			$nome = $paciente->nome;
			$descricao = $paciente->descricao;
			$sexo = $paciente->publico;
			$idade_minima = $paciente->idade_min;
			$idade_maxima = $paciente->idade_max;
		@endphp
	@endif

	<x-form action="{{ route('clinica.homecare.pacientes.post') }}">

		@csrf

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $id }}">
		@endif

		<x-slot:content>

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

							@if (request('id'))
								<div for="" class="input-label disabled">{{ $paciente->nome }}</div>
								<input type="hidden" name="paciente" value="{{ $paciente->id }}">
							@else
								<select name="paciente" id="ppaciente" class="autocomplete" data-url="{{ route('clinica.homecare.pacientes.autocomplete') }}" placeholder="Pesquise pelo Nome, CPF, Matrícula ou RG"></select>
							@endif

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

							@if (request('id'))
								@php
									$programas = [];
									$paciente_programas = new App\Models\Clinica\ProgramaModel();
									$programas_paciente = $paciente_programas->select('id', 'titulo AS text')->from('tb_paciente_programa AS PP')->join('tb_programas AS P', 'P.id', 'PP.id_programa')->where('PP.id_paciente', request('id'))->get();
									if ($programas_paciente->count() > 0) {
									    foreach ($programas_paciente as $p) {
									        $programas[] = ['id' => $p->id, 'text' => $p->text];
									    }
									}
								@endphp
							@endif

							<select name="programa[]" id="pprograma" class="autocomplete" data-url="{{ route('clinica.homecare.programas.search') }}" @if (isset($programas) && !empty($programas)) data-selected="{{ json_encode($programas) }}" @endif placeholder="" multiple></select>

							@error('programa')
								{{ $message }}
							@enderror

						</div>
					</div>
				</div>

				@if (isset($paciente))
					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<label for="">Remover paciente do programa:</label>
								<button type="button" class="btn delete red mt-1 waves-effect" data-trigger="delete" data-id="{{ $paciente->id }}" data-target="paciente_{{ $paciente->id }}" data-tooltip="Remover">
									<i class="material-symbols-outlined">delete</i>
								</button>
							</div>
						</div>
					</div>
				@endif
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

		@include('clinica.homecare.pacientes.includes.scripts')

	</x-form>

	<x-slot:form_delete action="{{ route('clinica.homecare.pacientes.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este paciente do programa?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
