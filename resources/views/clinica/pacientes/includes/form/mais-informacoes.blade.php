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

<hr class="border mt-4 mb-4">

<form action="{{ route('clinica.pacientes.delete') }}" method="post" id="delete_data" data-target="paciente">

	<div class="row">
		<div class="col s12">
			<label for="">Excluir este paciente:</label>
		</div>
		<div class="col s12 mt-1">
			<input type="hidden" name="id" value="{{ $id ?? null }}">
			<button type="button" class="btn delete left waves-effect" data-target="paciente" style="align-items: center; display: flex; background-color: var(--red) !important;">
				<i class="material-symbols-outlined">delete</i>
				Excluir
			</button>
		</div>
	</div>

</form>

<div id="confirm_delete" class="modal modal-fixedfooter">
	<div class="modal-content">
		<h3>ATENÇÃO!!!</h3>
		<p>Tem certeza que deseja excluir este paciente?</p>
		<p>Esta ação não poderá ser defeita.</p>
	</div>
	<div class="modal-footer border-top grey-border border-lighten-3">
		<button type="button" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
		<button type="button" id="confirm" class="btn red waves-effect">Confirmar</button>
	</div>
</div>
