<div class="row">
	<div class="col s12 mb-3">
		<h6>Endereço</h6>
	</div>
</div>
<div class="row">
	<div class="col s12 m3 l4">
		<div class="input-field">
			<label for="cep">CEP</label>
			<input type="tel" name="cep" id="cep" value="{{ old('cep', $cep ?? null) }}" data-mask="cep">
		</div>
	</div>
	<div class="col s18 m6 l6">
		<div class="input-field">
			<label for="logradouro">Logradouro</label>
			<input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $logradouro ?? null) }}">
		</div>
	</div>
	<div class="col s4 m3 l2">
		<div class="input-field">
			<label for="numero">Número</label>
			<input type="tel" name="numero" id="numero" value="{{ old('numero', $numero ?? null) }}">
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m6 l6">
		<div class="input-field">
			<label for="complemento">Complemento</label>
			<input type="text" name="complemento" id="complemento" value="{{ old('complemento', $complemento ?? null) }}">
		</div>
	</div>
	<div class="col s12 m6 l6">
		<div class="input-field">
			<label for="bairro">Bairro</label>
			<input type="text" name="bairro" id="bairro" value="{{ old('bairro', $bairro ?? null) }}">
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m5 l5">
		<div class="input-field">
			<label for="cidade">Cidade</label>
			<input type="text" name="cidade" id="cidade" value="{{ old('cidade', $cidade ?? null) }}">
		</div>
	</div>
	<div class="col s12 m3 l3">
		<div class="input-field">
			<label for="uf">UF</label>
			<input type="text" name="uf" id="uf" value="{{ old('uf', $uf ?? null) }}">
		</div>
	</div>
	<div class="col s12 m4 l4">
		<div class="input-field">
			<label for="pais">País</label>
			<input type="text" name="pais" id="pais" value="{{ old('pais', $pais ?? null) }}">
		</div>
	</div>
</div>
