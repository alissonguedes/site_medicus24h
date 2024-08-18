<div class="row">
	<div class="col s12">
		<ul class="tabs border-bottom">
			<li class="tab"><a href="#notas_alergias" class="active">Alergias</a></li>
			<li class="tab"><a href="#notas_clinicas">Notas Clínicas</a></li>
			<li class="tab"><a href="#notas_gerais">Outras Observações</a></li>
		</ul>
	</div>
</div>

<div class="row">
	<div id="notas_alergias" class="col s12 m12 l12 mb-1">
		<div class="input-field">
			<span class="label grey-text mb-1" style="display: block;">Descreva as possíveis alergias do paciente:</span>
			<textarea name="notas_alergias" id="notas_alergias" class="editor no-border" placeholder="Alergias" cols="30" rows="10">{{ old('notas_alergias', $notas_alergias ?? null) }}</textarea>
		</div>
	</div>
	<div id="notas_clinicas" class="col s12 m12 l12 mb-1">
		<div class="input-field">
			<span class="label grey-text mb-1" style="display: block;">Observações clínicas:</span>
			<textarea name="notas_clinicas" id="notas_clinicas" class="editor no-border" placeholder="Notas clínicas" cols="30" rows="10">{{ old('notas_clinicas', $notas_clinicas ?? null) }}</textarea>
		</div>
	</div>
	<div id="notas_gerais" class="col s12 m12 l12 mb-1">
		<div class="input-field">
			<span class="label grey-text mb-1" style="display: block;">Outras observações do paciente:</span>
			<textarea name="notas_gerais" id="notas_gerais" class="editor no-border" placeholder="Notas gerais" cols="30" rows="10">{{ old('notas_gerais', $notas_gerais ?? null) }}</textarea>
		</div>
	</div>
</div>
