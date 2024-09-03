<div class="row">
	<div class="col s12">
		<div class="card-title">Paciente</div>
	</div>
</div>

@if (isset($row))
	{? $paciente = $paciente_model->getPacienteById($row->id_paciente); ?}
@endif

<div class="row">
	<div class="col s12">
		<div class="flex">
			<div class="flex">
				<div class="circle" style="width: 100px;margin-top: 10px; margin-right: 20px;">
					<img src="{{ asset($row->imagem ?? 'assets/img/avatar/icon.png') }}" class="circle" style="width: inherit;{{ isset($row) && empty($row->imagem) ? 'opacity: 0.4;filter: grayscale(1);' : null }}" alt="">
				</div>
			</div>
			<div class="flex flex-column flex-auto">
				<div class="row">
					<div class="col s12">
						<div class="input-field @error('paciente') error @enderror">
							<label for="nome_paciente" class="grey-text text-accent-1  active">Paciente</label>
							@if (old('paciente'))
								@php
									$paciente = new App\Models\Clinica\PacienteModel();
									$paciente = $paciente->where('id', old('paciente'))->first();
									$old = json_encode(['id' => $paciente->id, 'text' => $paciente->nome]);
								@endphp
							@endif
							<select name="paciente" id="paciente" class="autocomplete" data-url="{{ route('clinica.pacientes.autocomplete') }}" data-placeholder="Informe o paciente" @isset($old) data-selected="{{ $old }}" @endisset></select>
							@error('paciente')
								<div class="error">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m6 l6">
						<div class="input-field">
							<label for="mae" class="grey-text text-accent-1 active">Nome da mãe</label>
							<input type="text" name="mae" id="mae" class="grey-text text-darken-4" value="{{ $paciente->mae ?? '-' }}" readonly="readonly">
						</div>
					</div>
					<div class="col s12 m6 l6">
						<div class="input-field">
							<label for="pai" class="grey-text text-accent-1 active">Nome do pai:</label>
							<input type="text" name="pai" id="pai" class="grey-text text-darken-4" value="{{ $paciente->pai ?? '-' }}" readonly="readonly">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m4 l4">
		<div class="input-field">
			<label for="data_nascimento" class="grey-text text-accent-1 active">Data de nascimento:</label>
			<input type="text" name="data_nascimento" id="data_nascimento" class="grey-text text-darken-4" value="{{ $paciente->data_nascimento ?? '-' }}" data-mask="date" readonly="readonly">
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field">
			<label for="cpf" class="grey-text text-accent-1 active">CPF:</label>
			<input type="text" name="cpf" id="cpf" class="grey-text text-darken-4" value="{{ $paciente->cpf ?? '-' }}" data-mask="cpf" readonly="readonly">
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field">
			<label for="telefone" class="grey-text text-accent-1 active">Telefone:</label>
			<input type="text" name="telefone" id="telefone" class="grey-text text-darken-4" value="{{ $paciente->telefone ?? ($paciente->celular ?? '-') }}" data-mask="phone" readonly="readonly">
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m4 l4">
		<div class="input-field @error('convenio') error @enderror">
			<label for="convenio" class="grey-text text-accent-1 active">Convênio:</label>
			<select name="convenio">
				<option value="" disabled="disabled" selected="selected">Informe o convênio</option>
				@if (isset($convenios) && $convenios->count() > 0)
					@foreach ($convenios as $tipo)
						<option value="{{ $tipo->id }}" @selected(old('convenio') ? old('convenio') == $tipo->id : isset($row) && $tipo->id === $row->id_convenio)>{{ $tipo->descricao }}</option>
					@endforeach
				@endif
			</select>
			@error('convenio')
				<div class="error">{{ $message }}</div>
			@enderror
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field">
			<label for="matricula" class="grey-text text-accent-1 active">Matrícula:</label>
			<input type="text" name="matricula" id="matricula" class="grey-text text-darken-4" value="{{ $paciente->matricula ?? '-' }}" readonly="readonly">
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field">
			<label for="validade" class="grey-text text-accent-1 active">Validade:</label>
			<input type="text" name="validade" id="validade" class="grey-text text-darken-4" value="{{ $paciente->validade_convenio ?? '-' }}" readonly="readonly">
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<div class="input-field">
			<label for="observacao" class="{{ isset($row) && $row->observacao ? 'active' : null }}">Observações</label>
			<textarea name="observacao" class="materialize-textarea">{{ isset($row) && $row->observacao ? $row->observacao : null }}</textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<div class="input flex flex-center space-between no-padding">
			<label for="enviar_email" class="grey-text text-accent-1">Enviar e-mail para o paciente?</label>
			<div class="switch">
				<label>
					<input type="checkbox" name="enviar_email" id="enviar_email" value="1" checked="checked">
					<span class="lever no-margin"></span>
				</label>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<a href="#" data-trigger="modal" data-target="modal-prontuario-paciente">Ver o prontuário</a>
	</div>
</div>

<script>
	if ($('select[name="paciente"]').length) {

		$('#paciente').on('change', function() {

			var id = $(this).val();

			$('input[name="paciente"]').val(id);

			var reg = /\d/;

			$.ajax({
				url: BASE_URL + 'pacientes/' + id + '/dados',
				method: 'get',
				success: (response) => {

					if (reg.test(id)) {

						for (var i in response) {

							var val = response[i] ? response[i] : '-';
							var input = $('[name="' + i + '"]')


							input.val(val)
								.parent()
								.attr('readonly', true)
								.find('label')
								.addClass('active');

						}

					} else {

						alert({
							'title': 'Paciente não cadastrado!',
							'message': 'Complete o cadastro do paciente preenchendo os campos obrigatórios.'
						});

						for (var i in response) {

							var val = response[i] ? response[i] : '';
							var input = $('[name="' + i + '"]')

							input.val('')
								.attr('readonly', false)
								.parent('.input-field')
								.find('label')
								.removeClass('active')

						}

					}

				}

			})


			if (reg.test(id)) {


			}

		});

	}
</script>
