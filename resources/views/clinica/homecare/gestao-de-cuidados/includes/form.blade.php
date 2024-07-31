<x-header-page data-href="{{ route('clinica.homecare.gestao-de-cuidados') }}" data-tooltip="Novo Programa" placeholder="Pesquisar programas...">
	<x-slot:add_button>
		add
	</x-slot:add_button>
</x-header-page>

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

<x-slot:form action="{{ route('clinica.homecare.gestao-de-cuidados.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	<x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#programa">Programa</a></li>
			<li class="tab"><a href="#tarefas">Tarefas</a></li>
		</ul>
	</x-slot:form_tabs>

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

					@php
						$responsaveis = [];
						$responsavel_tarefa = [];
						if (request('id')) {
						    $programaModel = App\Models\Clinica\ProgramaModel::from('tb_programas_responsavel')->where('id_programa', request('id'))->get();

						    if ($programaModel->count() > 0) {
						        foreach ($programaModel as $r) {
						            $responsaveis[] = $r->id_profissional;
						        }
						    }
						}

						$profissionais = [
						    [
						        'id' => '1',
						        'nome' => 'Alisson',
						    ],
						    [
						        'id' => '2',
						        'nome' => 'Guedes',
						    ],
						    [
						        'id' => '3',
						        'nome' => 'Pereira',
						    ],
						];

					@endphp

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

				<table id="table_tarefas" class="bordered">
					<thead>
						<tr>
							<th class="center-align">Descrição</th>
							<th class="center-align">Prazo de conclusão</th>
							<th class="center-align">Responsáveis</th>
							<th class="center-align">Tipo da tarefa</th>
							<th class="center-align"></th>
						</tr>
					</thead>
					<tbody>
						{{-- <tr>
							<td class="center-align">Aplicação de insulina</td>
							<td class="center-align">30 dias</td>
							<td class="center-align">Selecionar manualmente</td>
							<td class="center-align">Por Agendamento</td>
							<td class="center-align">Sim</td>
						</tr> --}}
					</tbody>
				</table>

			</div>

		</div>

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

							<select name="responsavel_tarefa[]" id="responsavel_tarefa" multiple>
								<option value="" disabled>Profissionais responsáveis</option>

								@if ($profissionais)

									@foreach ($profissionais as $value)
										@if ($responsavel_tarefa || old('responsavel_tarefa'))
											@php
												$selected = old() ? (old('responsavel_tarefa') ? in_array($value['id'], old('responsavel_tarefa')) : old('responsavel_tarefa')) : in_array($value['id'], $responsavel_tarefa);
											@endphp
										@endif

										<option value="{{ $value['id'] }}" @selected($selected ?? null)>{{ $value['nome'] }}</option>
									@endforeach

								@endif

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
						<button type="button" class="btn waves-effect save">
							<i class="material-symbols-outlined hide-on-small-only left">save</i>
							<span class="">Salvar</span>
						</button>
					</div>
				</div>

			</div>

		</div>

	</div>

	<x-slot:card_footer>
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
	</x-slot:card_footer>

	<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.css') }}">

	<script src="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.js') }}"></script>
	<script src="{{ asset('assets/js/clinica/homecare/gestao_cuidados.js') }}"></script>
	<script src="{{ asset('assets/js/clinica/homecare/modal_tarefas.js') }}"></script>

	<script>
		$(function() {

			function delete_convidado() {
				$('#lista_convidados').find('[name="deletar"]').unbind().bind('click', function() {
					$(this).parents('tr').remove();
				});
			}

			delete_convidado();

			var modal_tarefa = $('#modal_tarefa').modal({

				onCloseStart: function() {
					$('#modal_tarefa').find('.modal-content').find('.input-field input:not([placeholder]),.input-field textarea').parent().find('label').removeClass('active')
					$('#modal_tarefa').find('.modal-content').find('input:not([type="checkbox"]):not([type="radio"]),select,textarea').val('');
					$('#modal_tarefa').find('.modal-content').find('select').val('Classe do convidado').formSelect().trigger('change');
					$('#modal_tarefa').find('.modal-content').find('input:checkbox,input:radio').prop('checked', false).change();
					$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('invalid wrong').find('.invalid').remove();
				}

			});

			$('#modal_tarefa').find('.modal-footer button.save').bind('click', function() {

				var data = {};
				var values = [];
				var inputs = $('#modal_tarefa').find('.modal-content').find('input,select,textarea');

				inputs.each(function() {

					if ($(this).is(':valid') || $(this).is(':checked')) {

						var name = $(this).attr('name');

						Object.assign(data, {
							[name]: $(this).val()
						});

					}

				});

				$.ajax({

					method: 'post',
					// datatype: 'html',
					url: "{{ route('clinica.homecare.gestao-de-cuidados.tarefas') }}",
					data: inputs.serialize(),
					headers: {
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(response) {

						$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

						var table = $(response).find('tbody').html();

						$('#lista_convidados').find('tbody').append(table);

						modal_tarefa.modal('close')

						delete_convidado();

					},

					error: function(response) {

						var errors = response.responseJSON.errors;
						$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

						for (var i in errors) {

							var input = $('#modal_tarefa').find('.modal-content').find(`[name="${i}"]`);

							input.parents('.input-field').addClass('error').append(`<div class="error">${errors[i][0]}</div>`);

						}

					}

				})

			});

		});
	</script>

</x-slot:form>
