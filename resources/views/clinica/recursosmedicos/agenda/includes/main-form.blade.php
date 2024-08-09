@php
	$id = null;
@endphp

<x-form action="{{ route('clinica.recursosmedicos.agenda.index') }}">

	@csrf
	<input type="hidden" name="categoria" value="agenda">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	{{-- <x-slot:tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:tabs> --}}

	<div class="row">
		<div class="col s12">
			<p>Aqui, você pode informar os dias e horários que está disponível para atendimento na clínica.</p>
		</div>
	</div>

	<hr class="">

	<div class="row">
		{{-- <div class="col s12">
			<div class="input-field">
				<div class="row">
					<div class="col s12">
						<label for="duracao_horarios" class="active strong black-text">Duração dos horários</label>
						<br>
						<small class="grey-text">Qual será a duração de cada horário?</small>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-2">
						<select name="duracao_horarios" id="duracao_horarios" class="">
							<option value="15" selected>15 minutos</option>
						</select>
					</div>
				</div>
			</div>
		</div> --}}
	</div>

	<div class="row">
		<div class="col s12">
			<div class="input-field">

				{{-- <div class="row">
					<div class="col s12">
						<label for="duracao_horarios" class="active strong black-text">Disponibilidade</label>
						<br>
						<small class="grey-text">Defina os horários em que você está disponível.</small>
					</div>
				</div> --}}
				{{--
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-2">
						<select name="duracao_horarios" id="duracao_horarios" class="">
							<option value="" selected>Repetir semanalmente</option>
						</select>
					</div>
				</div> --}}

				<style>
					/* .day-range,
					.time-range {
						display: flex;
						align-items: center;
						place-content: space-between;
					}

					.time-range input {
						width: 100px;
						padding: 10px;
						border: none;
						outline: none;
						background-color: var(--grey-accent-2);
						text-align: center;
						margin: 0 15px;
					}

					.day-range,
					.time-range {
						-webkit-box-orient: vertical;
						-webkit-box-direction: normal;
						-webkit-flex-direction: column;
						flex-direction: column;
						-webkit-transition: height .3s cubic-bezier(.4, 0, .2, 1);
						transition: height .3s cubic-bezier(.4, 0, .2, 1);
						padding-bottom: 4px;
						padding-top: 4px;
					}

					.V3VAR,
					.jGuwL {
						-webkit-box-align: center;
						-webkit-align-items: center;
						align-items: center;
					}

					.x8gipc,
					.V3VAR,
					.jGuwL {
						display: -webkit-box;
						display: -webkit-flex;
						display: flex;
					}

					.MlP2sf {
						-webkit-box-flex: 0;
						-webkit-flex: none;
						flex: none;
						width: 54px;
					}

					.Ozodyc {
						width: 221px;
						color: rgb(95, 99, 104);
						padding-left: 8px;
					}

					.WJCotb {
						min-width: 32px;
					} */
				</style>

				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="day-range">
							<div class="dia_semana">
								<label class="strong black-text">Domingo</label>
							</div>
							<div class="time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
								<div class="Ozodyc">
									Indisponível
								</div>
							</div>
							<div class="acao">
								<button type="button" class="btn btn-small btn-flat btn-floating transparent" style="margin-left: 15px;">
									<i class="material-symbols-outlined">block</i>
								</button>
								<button type="button" class="btn btn-small btn-flat btn-floating transparent" style="margin-left: 15px;">
									<i class="material-symbols-outlined">add</i>
								</button>
								<button type="button" class="btn btn-small btn-flat btn-floating transparent" style="margin-left: 15px;">
									<i class="material-symbols-outlined">content_copy</i>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="day-range">
							<div class="">
								<label class="strong black-text">Segunda</label>
							</div>
							<div class="time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
							</div>
							<div class="">
								<button type="button" class="btn btn-flat btn-floating transparent">
									<i class="material-symbols-outlined">content_copy</i>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="row day-range">
							<div class="col s4">
								<label class="strong black-text">Terça</label>
							</div>
							<div class="col s4 time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
							</div>
							<div class="col s4">

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="row day-range">
							<div class="col s4">
								<label class="strong black-text">Quarta</label>
							</div>
							<div class="col s4 time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
							</div>
							<div class="col s4">

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="row day-range">
							<div class="col s4">
								<label class="strong black-text">Quinta</label>
							</div>
							<div class="col s4 time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
							</div>
							<div class="col s4">

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="row day-range">
							<div class="col s4">
								<label class="strong black-text">Sexta</label>
							</div>
							<div class="col s4 time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
							</div>
							<div class="col s4">

							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-1">
						<div class="row day-range">
							<div class="col s4">
								<label class="strong black-text">Sábado</label>
							</div>
							<div class="col s4 time-range">
								<input type="text" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" class="autocomplete timer browser-default" placeholder="hh:mm">
							</div>
							<div class="col s4">

							</div>
						</div>
					</div>
				</div>
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

	<script>
		$(function() {

			var times = {};

			var razao = 30;

			for (var h = 0; h <= 23; h++) {

				var hora = h < 10 ? '0' + h : h;

				for (var i = 0; i <= 59 / razao; i++) {

					var m = i * razao;
					var minuto = m < 10 ? '0' + m : m;

					Object.assign(times, {
						[hora + ':' + minuto]: null
					});

				}

			}

			var input_timer = $('input.autocomplete.timer');
			var autocomplete = input_timer.autocomplete({
				data: times,
				minLength: 0
			})

		});
	</script>
</x-form>
