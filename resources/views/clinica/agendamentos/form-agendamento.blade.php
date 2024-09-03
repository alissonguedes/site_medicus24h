<form action="{{ route('clinica.agendamentos.post', [request('year'), request('month'), request('day')]) }}" method="post" enctype="multipart/form-data" autocomplete="random-string" novalidate>

	@if (isset($row))
		<input type="hidden" name="id" value="{{ $row->id }}">
		<input type="hidden" name="_method" value="put">
	@endif

	@csrf

	<div class="card no-margin" style="position: absolute; left: 0; right: 0; top: 0; bottom: 0;">

		<div class="card-content no-padding" style="height: calc(100% - 60px); overflow: auto;">

			<div class="row">

				<div class="col s12 l4 border-right no-padding" style="border-color: var(--grey-lighten-2)">
					<div class="padding-6" style="overflow: auto; height: calc(100vh - 167px);">
						@include('clinica.agendamentos.left_agendamento')
					</div>
				</div>

				<div class="col s12 l8 border-right no-padding">
					<div class="padding-3" style="overflow: auto; height: calc(100vh - 167px);">
						@include('clinica.agendamentos.right_paciente')
					</div>
				</div>

			</div>

			<div class="card-action">

				<div class="col s6 left-align no-padding">

					@if (isset($row))
						<button type="button" id="delete_event" class="btn red white-text waves-effect" data-url="{{ go('clinica.agendamentos.delete', $row->id) }}" data-tooltip="Cancelar este agendamento" data-position="right">
							<i class="material-icons-outlined">delete</i>
						</button>
					@endif

				</div>

				<div class="col s6 right-align no-padding">

					<button type="button" class="btn white black-text waves-effect mr-2 modal-close left" data-href="{{ route('clinica.agendamento.data', [request('year'), request('month'), request('day')]) }}" data-tooltip="Voltar" data-position="top">
						<i class="material-symbols-outlined left">arrow_back</i>
						<span>cancelar</span>
					</button>

					<button type="submit" class="btn green waves-effect" data-tooltip="Salvar" data-position="top">
						<i class="material-symbols-outlined left">save</i>
						<span>salvar</span>
					</button>

				</div>

			</div>

		</div>

		<style>
			.modal.datepicker-modal {
				z-index: 9999999999 !important;
			}

			.modal-overlay {
				z-index: 999999999 !important;
			}

			button[type="button"] {
				border-radius: 24px;
				height: 45px;
				line-height: 45px;
				padding: 0 15px;
			}
		</style>
</form>
