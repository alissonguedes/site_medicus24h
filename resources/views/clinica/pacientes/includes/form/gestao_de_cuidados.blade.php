<div class="row">

	<div class="col s12">

		<div class="row">
			<div class="col s12">
				<h6 class="mb-3">Gestão de Cuidados</h6>
			</div>
		</div>

		<div class="row">

			<div class="col s12 m4 l4 mb-1">

				<div class="input-field">

					<label for="status" class="grey-text active">Paciente faz parte do grupo de gestão de cuidados?</label>
					<div id="status" class="switch">
						<label>
							Não
							<input type="checkbox" name="status" id="status" value="1" @checked(old('status', isset($status) ? $status === 'Ativo' : 'Ativo'))>
							<span class="lever"></span>
							Sim
						</label>
					</div>

				</div>

			</div>

		</div>

		{{-- <div class="row">
			<div class="col s12">
				<hr>
			</div>
		</div> --}}

		<div class="row">

			<div class="col s12">

				<div class="row">
					<div class="col s12">
						<ul class="tabs border-bottom mb-2">
							<li class="tab"><a href="#gestao_de_cuidados">Gestão de Cuidados</a></li>
							<li class="tab"><a href="#tarefas">Tarefas</a></li>
						</ul>
					</div>
				</div>

				<div id="gestao_de_cuidados">

					<div class="row">
						<div class="col s12 mb-3">
							<h6>Gestão de Cuidados</h6>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<button type="button" id="criar-programa" class="btn mb-2">
								Adicionar Programa
							</button>
						</div>
					</div>

					<div class="row">

						<div class="col s12">

							<table id="table-programa" class="bordered">
								<thead>
									<tr>
										<th class="center-align">Descrição</th>
										<th class="center-align">Programa</th>
										<th class="center-align">Data de entrada</th>
										<th class="center-align">Data de saída/alta</th>
										<th class="center-align">Recorrência</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="center-align">Aplicação de insulina</td>
										<td class="center-align">Aplicação de medicamentos</td>
										<td class="center-align">28/07/2024</td>
										<td class="center-align">Não</td>
										<td class="center-align">Sim</td>
									</tr>
								</tbody>
							</table>
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

							<table id="table-tarefa" class="bordered">
								<thead>
									<tr>
										<th class="center-align">Descrição</th>
										<th class="center-align">Programa</th>
										<th class="center-align">Data de entrada</th>
										<th class="center-align">Data de saída/alta</th>
										<th class="center-align">Recorrência</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="center-align">Aplicação de insulina</td>
										<td class="center-align">Aplicação de medicamentos</td>
										<td class="center-align">28/07/2024</td>
										<td class="center-align">Não</td>
										<td class="center-align">Sim</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

@pushOnce('scripts')
	<script src="{{ asset('assets/js/apps/pacientes/modal_programa.js') }}"></script>
@endPushOnce

<div id="modal_programa" class="modal modal-fixed-footer">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5>Adicionar Programa</h5>
			</div>
		</div>

		<div class="row">
			<div class="col s12">
				<div class="input-field">
					<label for="programa">Programa</label>
					<input type="text" name="programa" id="programa">
				</div>
			</div>
		</div>

	</div>
	<div class="modal-footer">

	</div>
</div>

<div id="modal_tarefa" class="modal">
	<div class="modal-content">
		Tarefas
	</div>
</div>
