<div class="row">
	<div class="col s12">
		<div class="card-title">Agendamento</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<div class="input-field @error('especialidade') error @enderror">
			<label for="especialidade" class="active">Especialidade</label>
			@php
				$especialidade = new App\Models\Clinica\EspecialidadeModel();
				$especialidade = $especialidade->select('id', 'especialidade')->where('id', request('id_especialidade'))->first();
			@endphp
			<select name="especialidade" id="especialidade" class="autocomplete" data-url="{{ route('clinica.especialidades.autocomplete') }}" data-placeholder="Informe a especialidade..." @isset($especialidade) data-selected="{{ json_encode(['id' => $especialidade->id, 'text' => $especialidade->especialidade]) }}" @endisset></select>
			@error('especialidade')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<div class="input-field @error('clinica') error @enderror">
			<label for="clinica" class="active">Local</label>
			@php
				$clinica = new App\Models\Clinica\ClinicaModel();
				$clinica = $clinica->select('id', 'razao_social')->where('id', request('id_clinica'))->where('status', '1')->first();
			@endphp
			<select name="clinica" id="clinica" class="autocomplete" data-url="{{ route('clinica.unidades.autocomplete') }}" data-placeholder="Informe a clínica..." @isset($clinica) data-selected="{{ json_encode(['id' => $clinica->id, 'text' => $clinica->razao_social]) }}" @endisset></select>
			@error('clinica')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<div class="input-field @error('medico') error @enderror">
			<label for="medico" class="active">Médico</label>
			@php
				$medico = new App\Models\Clinica\ProfissionalModel();
				$medico = $medico->select('id', 'nome')->where('id', request('id_medico'))->first();
			@endphp
			<select name="medico" id="medico" class="autocomplete" data-url="{{ route('clinica.medicos.autocomplete') }}" data-placeholder="Informe o médico..." @isset($medico) data-selected="{{ json_encode(['id' => $medico->id, 'text' => $medico->nome]) }}" @endisset></select>
			@error('medico')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		@if (old('tipo'))
			@php
				$tipo = new App\Models\Clinica\PacienteModel();
				$tipo = DB::connection('medicus')->table('tb_atendimento_tipo')->where('id', old('tipo'))->first();
				$old_tipo = json_encode(['id' => $tipo->id, 'text' => $tipo->tipo]);
			@endphp
		@endif
		<div class="input-field @error('tipo') error @enderror">
			<label for="tipo" class="active">Tipo de atendimento</label>
			<select name="tipo" id="tipo" class="autocomplete" value="{{ isset($row) && $row->tipo_atendimento ? $row->tipo_atendimento : null }}" data-url="{{ route('clinica.atendimentos.tipos.autocomplete', 'tipos') }}" data-placeholder="Informe o tipo de atendimento..." @isset($old_tipo) data-selected="{{ $old_tipo }}" @endisset></select>
			@error('tipo')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		@if (old('categoria'))
			@php
				$categoria = DB::connection('medicus')->table('tb_categoria_descricao')->where('id_categoria', old('categoria'))->first();
				$old_categoria = json_encode(['id' => $categoria->id_categoria, 'text' => $categoria->titulo]);
			@endphp
		@endif
		<div class="input-field @error('categoria') error @enderror">
			<label for="categoria" class="active">Classificação</label>
			<select name="categoria" id="categoria" class="autocomplete" data-url="{{ route('clinica.atendimentos.categorias.autocomplete', '') }}" data-placeholder="Informe a classificação do atendimento..." @isset($old_categoria) data-selected="{{ $old_categoria }}" @endisset></select>
			@error('categoria')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
	</div>
</div>

<div class="row" style="margin: 0 !important;">
	<div class="col s12 mt-5 blue darken-2 z-depth-4" style="border-radius: 24px;">
		<div class="row">
			<div class="col s12 mt-5 mb-5">
				<h6 class="white-text" style="font-family: open-sans; font-weight: bold; text-transform: uppercase;">Agendar</h6>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="input-field">
					<label for="data" class="white-text">Data</label>
					<input type="text" name="data" class="white-text transparent datepicker" value="{{ isset($row) && $row->data ? $row->data : (request('horario') ? date('d/m/Y', request('horario')) : null) ?? null }}" data-mask="date" placeholder="dd/mm/yyyy">
				</div>
			</div>
			<div class="col s6">
				<div class="input-field">
					<label for="local" class="white-text">Horário</label>
					<input type="text" name="hora" class="white-text transparent" value="{{ (isset($row) && $row->hora_agendada ? date('H:i', strtotime($row->hora_agendada)) : request('horario')) ? date('H:i', request('horario')) : null ?? null }}" data-mask="time" placeholder="hh:mm" maxlength="5">
				</div>
			</div>
		</div>
		{{-- <div class="row">
			<div class="col s12">
				<div class="gradient-45deg-indigo-purple mb-10" style="border-radius: 10px; padding: 0px 10px;">
					<div class="input">
						<label for="recorrente" class="label">Repetir evento</label>
						<div class="switch">
							<label>
								<input type="checkbox" name="recorrente" id="recorrente" value="1">
								<span class="lever no-margin"></span>
							</label>
						</div>
					</div>
					<div class="days-of-week">
						<div class="row days white pt-5 pb-5">
							<label for="domingo" class="col s4 active">
								<input type="checkbox" name="domingo" id="domingo" class="filled-in" value="1">
								<span>Dom</span>
							</label>
							<label for="segunda" class="col s4 active">
								<input type="checkbox" name="segunda" id="segunda" class="filled-in" value="1">
								<span>Seg</span>
							</label>
							<label for="terca" class="col s4 active">
								<input type="checkbox" name="terca" id="terca" class="filled-in" value="1">
								<span>Ter</span>
							</label>
							<label for="quarta" class="col s4 active">
								<input type="checkbox" name="quarta" id="quarta" class="filled-in" value="1">
								<span>Qua</span>
							</label>
							<label for="quinta" class="col s4 active">
								<input type="checkbox" name="quinta" id="quinta" class="filled-in" value="1">
								<span>Qui</span>
							</label>
							<label for="sexta" class="col s4 active">
								<input type="checkbox" name="sexta" id="sexta" class="filled-in" value="1">
								<span>Sex</span>
							</label>
							<label for="sabado" class="col s4 active">
								<input type="checkbox" name="sabado" id="sabado" class="filled-in" value="1">
								<span>Sáb</span>
							</label>
						</div>
						<div class="row">
							<div class="col s12 no-padding">
								<div class="input-field">
									<label for="limite" class="white-text">Repetir até</label>
									<input type="text" name="limite" id="limite" class="white-text" value="" data-mask="date" data-min-date="{{ date('d/m/Y') }}">
									<small class="white-text">Data limite da repetição. Deixe este campo em branco, caso deseje manter a repetição por tempo indeterminado.</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
	</div>
</div>
