<div class="row">
	<div class="col s12 mb-3">
		<h6>Outras informações</h6>
	</div>
</div>

<div class="row">
	{{-- <div class="col s12 m4 l4">
		<label for="obito" class="active">Quadro clínico evoluiu para óbito</label>
		<div id="obito" class="switch mt-3">
			<label>
				Não
				<input type="checkbox" name="obito" id="obito" value="1" @checked(old('obito', isset($obito) && $obito === '1'))>
				<span class="lever"></span>
				Sim
			</label>
		</div>
		<br>
		<div class="row">
			<div class="col s4 m4 l12">
				<div class="input-field">
					<label for="data_obito" class="active">Data e hora do óbito</label>
					<input type="text" name="data_obito" id="data_obito" class="col s8 m4" value="{{ old('data_obito', isset($data_obito) ? $data_obito : null) }}" data-mask="date" data-max-date="{{ date('d/m/Y') }}" placeholder="dd/mm/yyyy" @disabled(!isset($obito) || (isset($obito) && $obito == '0'))>
					<input type="text" name="hora_obito" id="hora_obito" class="col s4 m3" value="{{ old('hora_obito', isset($hora_obito) ? $hora_obito : null) }}" data-mask="time" placeholder="00:00" maxlength="5" @disabled(!isset($obito) || (isset($obito) && $obito == '0'))>
				</div>
			</div>
		</div>
	</div> --}}
	<div class="col s12 m4 l4">
		<label for="status" class="active">Paciente ativo</label>
		<div id="status" class="switch mt-3">
			<label>
				Não
				<input type="checkbox" name="status" id="status" value="1" @checked(old('status', isset($status) ? $status === 'Ativo' : 'Ativo'))>
				<span class="lever"></span>
				Sim
			</label>
		</div>
	</div>
</div>

@if (request('id'))
	<hr class="">
	<div class="row">
		<div class="col s12">
			<div class="input-field">
				<label for="" class="active">Excluir este paciente:</label>
				<button type="button" class="btn delete red mt-1 waves-effect" data-trigger="delete" data-id="{{ $paciente->id }}" data-target="paciente_{{ $paciente->id }}" data-tooltip="Remover">
					<i class="material-symbols-outlined">delete</i>
				</button>
			</div>
		</div>
	</div>
@endif
