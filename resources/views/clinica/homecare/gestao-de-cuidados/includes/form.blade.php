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

	<x-form action="{{ route('clinica.homecare.gestao-de-cuidados.post') }}">

		<x-slot:tabs>
			<ul class="tabs tabs-fixed-width">
				<li class="tab"><a href="#programa">Programa</a></li>
				<li class="tab"><a href="#tarefas">Tarefas</a></li>
			</ul>
		</x-slot:tabs>

		@csrf

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $id }}">
		@endif

		<div id="programa">

			<div class="row">
				<div class="col s12 mb-3">
					<h6>Programa</h6>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<div class="input-field @error('titulo') error @enderror">
						<label for="titulo">Nome do programa</label>
						<input type="text" name="titulo" id="titulo" value="{{ old('titulo', $titulo ?? null) }}">
						@error('titulo')
							<div class="error">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<div class="input-field @error('descricao') error @enderror">
						<label for="descricao">Descrição do programa</label>
						<input type="text" name="descricao" id="descricao" value="{{ old('descricao', $descricao ?? null) }}">
						@error('descricao')
							<div class="error">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<div class="input-field @error('sexo') error @enderror">
						<label for="sexo">Público alvo</label>
						<select name="sexo" id="sexo">
							<option value="A" @selected(old() ? old('sexo') == 'A' : isset($sexo) && $sexo == 'A' ?? null)>Indiferente</option>
							<option value="M" @selected(old() ? old('sexo') == 'M' : isset($sexo) && $sexo == 'M' ?? null)>Homens</option>
							<option value="F" @selected(old() ? old('sexo') == 'F' : isset($sexo) && $sexo == 'F' ?? null)>Mulheres</option>
						</select>
						@error('sexo')
							<div class="error">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<div class="range-field @error('faixa_etaria') error @enderror">
						<label for="faixa_etaria" class="active">Faixa etária</label>
						<input type="hidden" name="faixa_etaria" value="{{ $idade_minima ?? null }} - {{ $idade_maxima ?? null }}">
						<div id="faixa_etaria" class="mt-2 mb-1"></div>
						@error('faixa_etaria')
							<div class="error">{{ $message }}</div>
						@enderror
					</div>
					<div class="label">
						De <b id="slider-snap-value-lower"></b> a <b id="slider-snap-value-upper"></b> anos.
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<div class="input-field mt-3 @error('responsaiveis') error @enderror">
						<label for="responsaveis" class="active">Profissionais responsáveis</label>

						<select name="responsaveis[]" id="responsaveis" multiple>
							<option value="" disabled>Profissionais responsáveis</option>

							@if ($profissionais)

								@foreach ($profissionais as $value)
									@if ($responsaveis || old('responsaveis'))
										@php
											$selected = old() ? (old('responsaveis') ? in_array($value['id'], old('responsaveis')) : old('responsaveis')) : in_array($value['id'], $responsaveis);
										@endphp
									@endif

									<option value="{{ $value['id'] }}" @selected($selected ?? null)>{{ $value['nome'] }}</option>
								@endforeach

							@endif

						</select>
						@error('responsaveis')
							<div class="error">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>

		</div>

		<div id="tarefas">

			<div class="row">
				<div class="col s12 mb-3">
					<h6>Tarefas</h6>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<button type="button" id="criar-tarefa" class="btn mb-2">
						Criar Tarefa
					</button>
				</div>
			</div>

			<div class="row">

				<div class="col s12">

					<table id="table_tarefas">
						<thead>
							<tr>
								<th class="center-align">Tarefa</th>
								<th class="center-align">Descrição</th>
								<th class="center-align">Prazo de conclusão</th>
								<th class="center-align">Tipo da tarefa</th>
								<th class="center-align">Responsáveis</th>
								<th class="center-align"></th>
							</tr>
						</thead>
						<tbody>

							@if (request('id'))

								@php
									$tarefaModel = new App\Models\Clinica\ProgramaModel();
									$tarefas = $tarefaModel->from('tb_programas_tarefas')->where('id_programa', request('id'))->get();
								@endphp

								<tr class="nenhum_registro" style="display: none">
									<td class="center-align" colspan="6">Nenhuma tarefa cadastrada</td>
								</tr>

								@if (isset($tarefas))
									@foreach ($tarefas as $item)
										<tr>
											<td class="center-align">{{ $item->titulo }}</td>
											<td class="center-align">{{ $item->descricao }}</td>
											<td class="center-align">{{ $item->prazo }}</td>
											<td class="center-align">{{ $item->tipo }}</td>
											<td class="center-align">{{ $item->selecionar_responsavel }}</td>
											<td class="center-align">
												<button type="button" name="deletar" class="btn btn-flat btn-floating transparent waves-effect">
													<i class="material-symbols-outlined">delete</i>
												</button>
											</td>
											@php
												$dados_tarefa = json_encode([
												    'titulo_tarefa' => $item->titulo,
												    'descricao_tarefa' => $item->descricao,
												    'prazo_tarefa' => $item->prazo,
												    'tipo_tarefa' => $item->tipo,
												    'responsavel_tarefa' => $item->selecionar_responsavel,
												]);
											@endphp
											<input type="hidden" name="tarefa[]" value="{{ $dados_tarefa }}">
										</tr>
									@endforeach
								@else
									<tr class="nenhum_registro">
										<td class="center-align" colspan="6">Nenhuma tarefa cadastrada</td>
									</tr>
								@endif
							@else
								<tr class="nenhum_registro">
									<td class="center-align" colspan="6">Nenhuma tarefa cadastrada</td>
								</tr>
							@endif

						</tbody>
					</table>

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

		<div id="modal_tarefa" class="modal modal-fixed-footer">

			<div class="modal-content">

				<div class="row">
					<div class="col s12">
						<div class="input-field @error('titulo_tarefa') error @enderror">
							<label for="titulo_tarefa">Nome da Tarefa</label>
							<input type="text" name="titulo_tarefa" id="titulo_tarefa" value="">
							@error('titulo_tarefa')
								<div class="error">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12">
						<div class="input-field @error('descricao_tarefa') error @enderror">
							<label for="descricao_tarefa">Descrição da Tarefa</label>
							<input type="text" name="descricao_tarefa" id="descricao_tarefa" value="">
							@error('descricao_tarefa')
								<div class="error">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12">
						<div class="input-field @error('prazo_tarefa') error @enderror">
							<label for="prazo_tarefa">Prazo para conclusão</label>
							<input type="text" name="prazo_tarefa" id="prazo_tarefa" value="">
							@error('prazo_tarefa')
								<div class="error">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12">
						<div class="input-field @error('responsavel_tarefa') error @enderror">
							<label for="responsavel_tarefa">Responsáveis por esta tarefa</label>

							<select name="responsavel_tarefa" id="responsavel_tarefa">
								<option value="" disabled>Profissionais responsáveis</option>
								<option value="todos">Todos</option>
								<option value="manualmente">Selecionar Manualmente</option>
							</select>

							@error('responsavel_tarefa')
								<div class="error">{{ $message }}</div>
							@enderror

						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12">
						<div class="input-field @error('tipo_tarefa') error @enderror">
							<label for="tipo_tarefa">Tipo da tarefa</label>
							<input type="text" name="tipo_tarefa" id="tipo_tarefa" value="">
							@error('tipo_tarefa')
								<div class="error">{{ $message }}</div>
							@enderror
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer">

				<div class="row">
					<div class="col s12 right-align">
						<button type="button" class="btn white black-text waves-effect left modal-close">
							<i class="material-symbols-outlined hide-on-small-only left">cancel</i>
							<span class="">Cancelar</span>
						</button>
						<button type="button" class="btn waves-effect save" data-url="{{ route('clinica.homecare.gestao-de-cuidados.tarefas') }}" data-token="{{ csrf_token() }}">
							<i class="material-symbols-outlined hide-on-small-only left">save</i>
							<span class="">Salvar</span>
						</button>
					</div>
				</div>

			</div>

		</div>

		@include('clinica.homecare.gestao-de-cuidados.includes.scripts')

	</x-form>

	<x-slot:form_delete action="{{ route('clinica.homecare.gestao-de-cuidados.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este programa?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
