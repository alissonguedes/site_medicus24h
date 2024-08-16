<div class="row">
	<div class="col s12 mb-3">
		<h6>Informações pessoais</h6>
	</div>
</div>

<div class="row">

	<div class="col s12 m3 l2">
		<div class="profile flex flex-column flex-center">
			<div class="profile-image circle z-depth-2">
				<img src="{{ $imagem ?? asset('assets/img/avatar/avatar-0.png') }}" style="@if (isset($img) && !getImg($img)) opacity: 0.45; filter: grayscale(1); @endif" alt="">
			</div>
			<div class="change-photo btn btn-floating z-depth-3 waves-effect blue lighten-1">
				<label for="imagem" class="material-symbols-outlined white-text cursor-pointer" style="line-height: inherit;">photo_camera</label>
				<input type="file" name="imagem" id="imagem" style="position: absolute; left: 0; top: 0; bottom: 0; opacity: 0; z-index: -1; cursor: pointer">
			</div>
		</div>
	</div>

	<div class="col s12 m9 l10">

		<div class="row">
			<div class="col s12 m12 l7">
				<div class="input-field @error('nome') error @enderror">
					<label for="nome" class="{{ isset($nome) ? 'active' : null }}">Nome</label>
					<input type="text" name="nome" id="nome" value="{{ old('nome', isset($nome) ? $nome : null) }}" autocapitalize="on">
					@error('nome')
						<small class="error">{{ $message }}</small>
					@enderror
				</div>
			</div>

			<div class="col s12 m6 l4">
				<div class="input-field @error('matricula') error @enderror">
					@php
						if (isset($matricula) && !empty($paciente->matricula)):
						    session()->forget('matricula');
						    $matricula = $paciente->matricula;
						endif;
					@endphp
					<label for="matricula">Matrícula</label>
					<input type="text" name="matricula" id="matricula" value="{{ old('matricula', isset($matricula) ? $matricula : null) }}" autocapitalize="on">
					<small class="info grey-text"> Em branco, será gerado automaticamente. </small>
					@error('matricula')
						<small class="error">{{ $message }}</small>
					@enderror
				</div>
			</div>
			<div class="col s12 m6 l12">
				<div class="input-field @error('sexo') error @enderror">
					<label for="" class="active">Sexo</label>
					<div style="position: relative; top: 10px; margin: 20px 0; display: flex;">
						<label class="input mr-6">
							<input type="radio" name="sexo" class="with-gap" value="M" @checked(old('sexo', isset($sexo) && $sexo == 'M'))>
							<span>Masculino</span>
						</label>
						<label class="input">
							<input type="radio" name="sexo" class="with-gap" value="F" @checked(old('sexo', isset($sexo) && $sexo == 'F'))>
							<span>Feminino</span>
						</label>
					</div>
					@error('sexo')
						<small class="error">{{ $message }}</small>
					@enderror
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="col s12 m6 l4">
						<div class="input-field @error('data_nascimento') error @enderror">
							<label for="data_nascimento" class="active">Data de nascimento</label>
							<input type="text" name="data_nascimento" class="datepicker" value="{{ old('data_nascimento', isset($data_nascimento) ? $data_nascimento : null) }}" data-mask="date" data-max-date="{{ date('d/m/Y') }}" placeholder="dd/mm/yyyy" maxlength="10">
							@error('data_nascimento')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
					<div class="col s12 m6 l4">
						<div class="input-field @error('cpf') error @enderror">
							<label for="cpf">CPF</label>
							<input type="tel" name="cpf" id="cpf" value="{{ old('cpf', isset($cpf) ? $cpf : null) }}" data-mask="cpf" maxlength="14">
							@error('cpf')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
			</div>
			<div class="col s12">
				<div class="row">
					<div class="col s12 m6 l4">
						<div class="input-field @error('rg') error @enderror">
							<label for="rg">RG</label>
							<input type="tel" name="rg" id="rg" value="{{ old('rg', isset($rg) ? $rg : null) }}" maxlength="18">
							@error('rg')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
					<div class="col s12 m6 l4">
						<div class="input-field @error('cns') error @enderror">
							<label for="cns">CNS</label>
							<input type="tel" name="cns" id="cns" value="{{ old('cns', isset($cns) ? $cns : null) }}" maxlength="18">
							@error('cns')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
			</div>
			<div class="col s12">
				<div class="row">
					<div class="col s12 m6 l4">
						<div class="input-field @error('estado_civil') error @enderror">
							<label for="estado_civil" class="active">Estado civil</label>
							<select name="estado_civil" id="estado_civil">
								<option value="" disabled selected>Informe o estado civil</option>
								@if (isset($estado_civil) && $estado_civil->count() > 0)
									@foreach ($estado_civil as $est)
										<option value="{{ $est->id }}" @selected(old('estado_civil', isset($id_estado_civil) && $est->id == $id_estado_civil))>{{ $est->descricao }}</option>
									@endforeach
								@endif
							</select>
							@error('estado_civil')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
					<div class="col s12 m6 l4">
						<div class="input-field @error('etnia') error @enderror">
							<label for="etnia" class="active">Cor da pele</label>
							<select name="etnia" id="etnia">
								<option value="" disabled selected>Informe a cor da pele</option>
								@if (isset($etnias) && $etnias->count() > 0)
									@foreach ($etnias as $etnia)
										<option value="{{ $etnia->id }}" @selected(old('etnia', isset($id_etnia) && $etnia->id == $id_etnia))>{{ $etnia->descricao }}</option>
									@endforeach
								@endif
							</select>
							@error('etnia')
								<small class="error">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 m12 l6">
				<div class="input-field @error('mae') error @enderror">
					<label for="mae">Nome da mãe</label>
					<input type="text" name="mae" id="mae" value="{{ old('mae', isset($mae) ? $mae : null) }}" autocapitalize="on">
					@error('mae')
						<small class="error">{{ $message }}</small>
					@enderror
				</div>
			</div>
			<div class="col s12 m12 l6">
				<div class="input-field @error('pai') error @enderror">
					<label for="pai">Nome do pai</label>
					<input type="text" name="pai" id="pai" value="{{ old('pai', isset($pai) ? $pai : null) }}" autocapitalize="on">
					@error('pai')
						<small class="error">{{ $message }}</small>
					@enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="input-field mb-6">
					<label for="notas">Observações</label>
					<textarea name="notas" id="notas" class="materialize-textarea">{{ old('notas', isset($notas) ? $notas : null) }}</textarea>
					@error('observacoes')
						<small class="error">{{ $message }}</small>
					@enderror
				</div>
			</div>
		</div>
	</div>
</div>
