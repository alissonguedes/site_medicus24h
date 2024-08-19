<x-slot:forms>

	<x-form action="{{ route('clinica.profissionais.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		<input type="hidden" name="categoria" value="profissional">

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $profissional->id }}">
		@endif

		<x-slot:tabs>
			<ul class="tabs tabs-fixed-width">
				<li class="tab"><a href="#dados-profissional" class="active">Dados do Profissional</a></li>
				<li class="tab"><a href="#especialidades">Especialidades</a></li>
				<li class="tab"><a href="#regras">Regras</a></li>
				<li class="tab"><a href="#informacoes-adicionais">Informações adicionais</a></li>
			</ul>
		</x-slot:tabs>

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<!-- BEGIN dados-profissional -->
					<div id="dados-profissional">

						<div class="row">
							<div class="col s12 mb-2">
								<h6>Dados do Profissional</h6>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m12 l8">
								<div class="input-field @error('nome') error @enderror">
									<label for="nome" class="{{ isset($profissional->nome) ? 'active' : null }}">Nome</label>
									<input type="text" name="nome" id="nome" value="{{ old('nome', isset($profissional->nome) ? $profissional->nome : null) }}" autocapitalize="on">
									@error('nome')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>
							<div class="col s12 m6 l4">
								<div class="input-field @error('sexo') error @enderror">
									<label for="" class="active">Sexo</label>
									<div style="position: relative; top: 10px; margin: 20px 0; display: flex;">
										<label class="input mr-6">
											<input type="radio" name="sexo" class="with-gap" value="M" @checked(old('sexo', isset($profissional->sexo) && $profissional->sexo == 'M'))>
											<span>Masculino</span>
										</label>
										<label class="input">
											<input type="radio" name="sexo" class="with-gap" value="F" @checked(old('sexo', isset($profissional->sexo) && $profissional->sexo == 'F'))>
											<span>Feminino</span>
										</label>
									</div>
									@error('sexo')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>
						</div>

						<div class="row">

							<div class="col s12 m6 l3">
								<div class="input-field @error('data_nascimento') error @enderror">
									<label for="data_nascimento" class="active">Data de nascimento</label>
									<input type="text" name="data_nascimento" class="datepicker" value="{{ old('data_nascimento', isset($profissional->data_nascimento) ? date('d/m/Y', strtotime( $profissional->data_nascimento)) : null) }}" data-mask="date" data-max-date="{{ date('d/m/Y') }}" placeholder="dd/mm/yyyy" maxlength="10">
									@error('data_nascimento')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>

							<div class="col s12 m6 l3">
								<div class="input-field @error('cpf') error @enderror">
									<label for="cpf">CPF</label>
									<input type="tel" name="cpf" id="cpf" value="{{ old('cpf', isset($profissional->cpf) ? $profissional->cpf : null) }}" data-mask="cpf" maxlength="14">
									@error('cpf')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>

							<div class="col s12 m6 l3">
								<div class="input-field @error('rg') error @enderror">
									<label for="rg">RG</label>
									<input type="tel" name="rg" id="rg" value="{{ old('rg', isset($profissional->rg) ? $profissional->rg : null) }}" maxlength="18">
									@error('rg')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>

							<div class="col s12 m6 l3">
								<div class="input-field @error('cns') error @enderror">
									<label for="cns">CNS</label>
									<input type="tel" name="cns" id="cns" value="{{ old('cns', isset($profissional->cns) ? $profissional->cns : null) }}" maxlength="18">
									@error('cns')
										<small class="error">{{ $message }}</small>
									@enderror
								</div>
							</div>

						</div>

					</div>
					<!-- END dados-profissional -->

					<!-- BEGIN especialidades -->
					<div id="especialidades">

						<div class="row">
							<div class="col s12 mb-2">
								<h6>Especialidades</h6>
							</div>
						</div>

						<div class="row">
							<div class="col s12 mb-2">
								<button type="button" class="btn purple waves-effect flex modal-trigger" data-target="modal-especialidade">
									<i class="material-symbols-outlined">add</i>
									<span>Adicionar Especialidade</span>
								</button>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<table id="table-especialidades">
									<thead>
										<tr>
											<th class="center-align">Especialidade</th>
											<th class="center-align">RQE</th>
											<th class="center-align">Conselho</th>
											<th class="center-align">Registro</th>
											<th class="center-align">UF</th>
											<th class="center-align">Ação</th>
										</tr>
									</thead>
									<tbody>
										@if (request('id'))
											@php
												$especialidades = DB::connection('medicus')
												    ->table('tb_medico_especialidade')
												    ->select('id_especialidade', 'rqe', 'conselho', 'registro', 'uf_registro')
												    ->where('id_profissional', $profissional->id)
												    ->get();
											@endphp
											@if ($especialidades->count() > 0)
												@foreach ($especialidades as $e)
													@php
														$especialidade = DB::connection('medicus')
														    ->table('tb_especialidade')
														    ->select('especialidade')
														    ->where('id', $e->id_especialidade)
														    ->first();
													@endphp
													<tr>
														<td class="center-align">{{ $especialidade->especialidade }}</td>
														<td class="center-align">{{ $e->rqe ?? 'Não informado' }}</td>
														<td class="center-align">{{ $e->conselho ?? 'Não informado' }}</td>
														<td class="center-align">{{ $e->registro ?? 'Não informado' }}</td>
														<td class="center-align">{{ $e->uf_registro ?? 'Não informado' }}</td>
														<td class="center-align">
															<input type="hidden" name="especialidade[]" value="{{ json_encode($e) }}">
															<button type="button" class="btn btn-flat btn-floating transparent waves-effect">
																<i class="material-symbols-outlined">delete</i>
															</button>
														</td>
													</tr>
												@endforeach
											@endif
										@endif
									</tbody>
								</table>
							</div>
						</div>

					</div>
					<!-- END especialidades -->

					<!-- BEGIN regras -->
					<div id="regras">

					</div>
					<!-- END regras -->

					<!-- BEGIN informacoes-adicionais -->
					<div id="informacoes-adicionais">

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<label for="status" class="active">Profissional ativo</label>
								</div>
								<div id="status" class="switch">
									<label>
										Não
										<input type="checkbox" name="status" id="status" value="1" @checked(!isset($profissional) || ($profissional && $profissional->status == '1'))>
										<span class="lever"></span>
										Sim
									</label>
								</div>
							</div>
						</div>

					</div>
					<!-- END informacoes-adicionais -->

				</div>

			</div>

		</x-slot:content>

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

		@include('clinica.profissionais.includes.scripts')
		@include('clinica.homecare.pacientes.includes.scripts')

		<script>
			$(function() {

				var modal_especialidade = $('#modal-especialidade').modal({
					dismissible: false
				});

				$('button[type="button"][data-target="modal-especialidade"]').bind('click', function() {
					modal_especialidade.modal('open');
				});

				$('#modal-especialidade').find('.modal-footer button').bind('click', function() {

					var btn = $(this);
					var action = btn.data('submit');
					var data = btn.parents('#modal-especialidade').find('input,select,textarea').serialize();
					var url = btn.data('url');

					var especialidade = $('#modal-especialidade select[name="especialidade"]').val();

					if (action === 'cancelar') {

					}

					if (action === 'inserir') {

						$.ajax({
							url: url,
							method: 'post',
							data: data,
							headers: {
								'X-CSRF-Token': '{{ csrf_token() }}',
							},
							beforeSend: () => {

								if (!especialidade) {
									alert('Informe a especialidade');
									return false;
								}

							},
							success: (response) => {

								var especialidades = $(response).find('tbody').html();

								$('#table-especialidades').find('tbody').append(especialidades);
								$('#modal-especialidade').find('input,select,textarea').val('').trigger('change');
								modal_especialidade.modal('close');

							}

						});

					}

				});

			});
		</script>

	</x-form>

	<x-slot:form_delete action="{{ route('clinica.profissionais.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este profissional?</p>
		<div id="item"></div>
	</x-slot:form_delete>

	<div id="modal-especialidade" class="modal modal-fixed-footer">

		<div class="modal-content white">

			<div class="row">
				<div class="col s12 m12 l8">
					<div class="input-field">
						<label for="especialidade">Especialidade</label>
						{{-- <input type="text" name="especialidade" id="especialidade" value=""> --}}
						<select name="especialidade" class="autocomplete" data-url="{{ route('clinica.especialidades.autocomplete') }}"></select>
					</div>
				</div>

				<div class="col s12 m12 l4">
					<div class="input-field">
						<label for="rqe">RQE</label>
						<input type="text" name="rqe" id="rqe" value="">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12 m6 l5">
					<div class="input-field">
						<label for="conselho">Conselho</label>
						<input type="text" name="conselho" id="conselho" value="">
					</div>
				</div>

				<div class="col s12 m6 l5">
					<div class="input-field">
						<label for="registro">Registro</label>
						<input type="text" name="registro" id="registro" value="">
					</div>
				</div>

				<div class="col s12 m12 l2">
					<div class="input-field">
						<label for="uf_registro">UF</label>
						<input type="text" name="uf_registro" id="uf_registro" value="">
					</div>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<button type="button" class="btn white black-text flex border-radius left modal-close waves-effect" data-submit="cancelar">
				<i class="material-symbols-outlined">cancel</i>
				Cancelar
			</button>
			<button type="button" class="btn purple flex border-radius right waves-effect" data-submit="inserir" data-url="{{ route('clinica.profissionais.especialidade.add') }}">
				<i class="material-symbols-outlined">add</i>
				Inserir
			</button>
			<div class="clearfix"></div>
		</div>

	</div>

</x-slot:forms>
