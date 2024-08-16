<div class="row">
	<div class="col s12 mb-3">
		<h6>Informações de contato</h6>
	</div>
</div>
<div class="row">
	<div class="col s12 m4 l4">
		<div class="input-field @error('email') error @enderror">
			<label for="email" class="active">E-mail</label>
			<input type="email" name="email" id="email" value="{{ old('email', $email ?? null) }}">
			@error('email')
				<small class="error">{{ $message }}</small>
			@enderror
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field @error('telefone') error @enderror">
			<label for="telefone" class="active">Telefone</label>
			<input type="tel" name="telefone" id="telefone" value="{{ old('telefone', $telefone ?? null) }}" data-mask="phone" maxlength="15">
			@error('telefone')
				<small class="error">{{ $message }}</small>
			@enderror
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field @error('celular') error @enderror">
			<label for="celular" class="active">Celular</label>
			<input type="tel" name="celular" id="celular" value="{{ old('celular', $celular ?? null) }}" data-mask="celular" maxlength="16">
			@error('celular')
				<small class="error">{{ $message }}</small>
			@enderror
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m4 l4 mb-3">
		<label for="receber_notificacoes" class="">Receber notificações</label>
		<div class="switch">
			<label>
				Off
				<input type="checkbox" name="receber_notificacoes" id="receber_notificacoes" value="on" @checked(old('receber_notificacoes', isset($receber_notificacoes) && $receber_notificacoes == 'on'))>
				<span class="lever"></span>
				On
			</label>
		</div>
	</div>
	<div class="col s12 m4 l4 mb-3">
		<label for="receber_email" class="active">Enviar notificações por e-mail</label>
		<div class="switch">
			<label>
				Off
				<input type="checkbox" name="receber_email" id="receber_email" value="on" @checked(old('receber_email', isset($receber_email) && $receber_email == 'on'))>
				<span class="lever"></span>
				On
			</label>
		</div>
	</div>
	<div class="col s12 m4 l4 mb-3">
		<label for="receber_sms" class="active">Enviar notificações por whatsapp</label>
		<div class="switch">
			<label>
				Off
				<input type="checkbox" name="receber_sms" id="receber_sms" value="on" @checked(old('receber_sms', isset($receber_sms) && $receber_sms == 'on'))>
				<span class="lever"></span>
				On
			</label>
		</div>
	</div>
</div>
