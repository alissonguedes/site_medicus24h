<div class="row">
	<div class="col s12 mb-3">
		<h6>Convênios</h6>
	</div>
</div>

<div class="row">
	<div class="col s12 l12 mb-3">
		<h6>
			<label for="associado" style="font-size: inherit; color: inherit;">
				<input type="checkbox" name="associado" id="associado" class="filled-in" value="yes">
				<span class="left">Paciente associado ao Plano Médicus24h</span>
			</label>
		</h6>
	</div>
</div>

<div id="conv_medicus24h" class="@if (!isset($paciente) || (isset($paciente) && $paciente->associado === 'no')) hide @endif" data-title="{{ isset($paciente) && $paciente->nome ? replace($paciente->nome) : null }}">

	<div class="row">
		<div class="col s7">
			<div class="row">
				<div class="col s6">
					<div class="input-field">
						<label for="convenio-{{ 2 }}">Convênio</label>
						<div class="input-label disabled">
							Médicus24h
							<input type="hidden" name="convenio" id="convenio-{{ 2 }}" value="{{ 2 }}">
						</div>
					</div>
				</div>
				<div class="col s6">
					<div class="input-field">
						<label for="matricula-{{ 3 }}">Matrícula</label>
						<div class="input-label disabled">
							{{ $matricula ?? null }}
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="input-field">
						<label>Tipo do plano</label>
						<select name="id_tipo_convenio">
							<option value="" disabled="disabled" selected="selected">Tipo do plano</option>
							@if (isset($tipo_planos) && $tipo_planos->count() > 0)
								@foreach ($tipo_planos as $tipo)
									@if ($tipo->id_convenio === 2)
										<option value="{{ $tipo->id }}" @selected(isset($paciente) && $tipo->id === $paciente->id_tipo_convenio)>{{ $tipo->descricao }}</option>
									@endif
								@endforeach
							@endif
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s6">
					<div class="input-field">
						<label>Tipo de acomodação</label>
						<select name="id_acomodacao">
							<option value="" disabled="disabled" selected="selected">Tipo de acomodação</option>
							@if (isset($acomodacoes) && $acomodacoes->count() > 0)
								@foreach ($acomodacoes as $acomodacao)
									<option value="{{ $acomodacao->id }}" @selected(isset($paciente) && $acomodacao->id === $paciente->id_acomodacao)>{{ $acomodacao->descricao }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col s6">
					<div class="input-field">
						@php
							$mes = null;
							$ano = null;
							if (isset($paciente) && !empty($paciente->validade)):
							    $replace = str_replace('/', '-', $paciente->validade);
							    $validade = array_reverse(explode('-', $replace));
							    $mes = $validade[1];
							    $ano = $validade[0];
							endif;
							$meses = [
							    '01' => 'Jan',
							    '02' => 'Fev',
							    '03' => 'Mar',
							    '04' => 'Abr',
							    '05' => 'Mai',
							    '06' => 'Jun',
							    '07' => 'Jul',
							    '08' => 'Ago',
							    '09' => 'Set',
							    '10' => 'Out',
							    '11' => 'Nov',
							    '12' => 'Dez',
							];
						@endphp
						<label for="validade">Validade</label>
						<div class="row">
							<div class="col s6">
								<select name="validade_mes" id="mes">
									<option value="" disabled="disabled" selected="selected">Mês</option>
									@foreach ($meses as $i => $m)
										<option value="{{ $i }}" @selected(isset($paciente) && $i == $mes)>{{ $m }}</option>
									@endforeach
								</select>
							</div>
							<div class="col s6">
								<select name="validade_ano" id="ano">
									<option value="" disabled="disabled" selected="selected">Ano</option>
									@for ($i = date('Y'); $i <= date('Y') + 20; $i++)
										<option value="{{ $i }}" @selected(isset($paciente) && $i == $ano)>{{ $i }}</option>
									@endfor
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

			</div>
		</div>

		<div class="col s5">
			<div id="cartao_convenio" class="credit_card flex flex-end">
				<div class="frente z-depth-2 animated flipInY slow">
					<div class="logo left"></div>
					<div class="logo right">
						<h4>Assitência</h4>
						<h5>Saúde</h5>
					</div>
					<div class="content">
						<div class="row">
							<div class="col s12">
								<div class="row">
									<div class="col s12 mt-6 mb-4">
										<p id="nome_paciente">
											{{ $paciente->nome ?? null }}</p>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										{{--
										<span>CPF</span>
										<p id="cpf_paciente">{{ $paciente->cpf ?? null }}</p>
										--}}
									</div>
									<div class="col s6">
										{{--
										<span>Data de nascimento</span>
										<p id="data_nascimento_paciente">{{ $paciente->data_nascimento ?? null }}</p>
		                                --}}
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<span>Matrícula</span>
										<p>{{ $matricula ?? null }}</p>
									</div>
									<div class="col s6">
										<span>Validade</span>
										<p id="validade_convenio_paciente">
											{{-- {{ isset($paciente) && $paciente->validade ? $mes . '/' . $ano[2] . $ano[3] : null }} --}}
											{{ isset($paciente) && $paciente->validade ? $mes . '/' . $ano : null }}
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer center-align">
						<p>www.medicus24h.com.br</p>
					</div>
				</div>
				<div class="verso z-depth-2">
					<div class="content">
						<div class="row">
							<div class="col s12">
								<div class="row">
									<div class="col s6">
										<span>Tipo do plano</span>
										<p id="id_tipo_convenio">
											{{ $tipo_plano ?? null }}
										</p>
									</div>
									<div class="col s6">
										<span>Acomodação</span>
										<p id="id_acomodacao">
											{{ $acomodacao ?? null }}
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										<span>CNS</span>
										<p id="cns_paciente">
											{{ $cns ?? null }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer center-align black"></div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div id="print_card" class="pointer btn waves-effect orange darken-1">
						<i class="material-symbols-outlined left">print</i>
						Imprimir cartão
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col s12 mb-3">
		<div class="divider"></div>
	</div>
</div>

<div class="row">
	<div class="col s12 mb-3">
		<button type="button" class="btn green flex blue darken-1 waves-effect" data-url="{{ Route::has('clinica.pacientes.addplano') ? route('clinica.pacientes.addplano') : null }}" data-trigger="add_plano">
			<i class="material-symbols-outlined">add</i>
			<span>Adicionar Convenios</span>
		</button>
	</div>
</div>

<div class="row">
	<div class="col s12 mb-3">
		<table id="plano_saude" data-ajax="false">
			<thead>
				<tr>
					{{-- <th>Definido</th> --}}
					<th>Convênio</th>
					<th>Tipo</th>
					<th>Acomodação</th>
					<th>Nº da Carteira</th>
					<th>Validade</th>
				</tr>
			</thead>
			<tbody>
				@if (isset($paciente_convenios) && $paciente_convenios->count() > 0)
					@foreach ($paciente_convenios as $convenio)
						<tr id="{{ $convenio->id }}">
							{{--
							<td class="center-align">
									<label>
								<input type="radio" name="plano_padrao" value="1">
								<i class="material-symbols-outlined mt-1 pointer {{ null }}" data-tooltip="Convênio ativo">verified</i>
				<span class="hide"></span>
				</label>
			</td>
			--}}
							<td>{{ $convenio->convenio }}</td>
							<td>{{ $convenio->tipo }}</td>
							<td>{{ $convenio->acomodacao }}</td>
							<td>{{ $convenio->matricula }}</td>
							<td>{{ $convenio->validade_mes . '/' . $convenio->validade_ano }}
							</td>
							<td>

								{{-- <button type="button" id="{{ $convenio->id }}" data-url="{{ go('clinica.pacientes.editplano', $convenio->id) }}" class="btn btn-floating btn-small teal lighten-2 waves-effect mr-6" data-trigger="edit_plano">
									<i class="material-symbols-outlined">edit</i>
								</button>
								<button type="button" class="btn btn-floating btn-small red lighten-2 waves-effect">
									<i class="material-symbols-outlined">delete</i>
								</button> --}}

								{{-- @var($planos_de_saude = json_encode([
											'id_convenio' => $convenio->id_convenio,
											'id_tipo' => $convenio->id_tipo,
											'id_acomodacao' => $convenio->id_acomodacao,
											'matricula' => $convenio->matricula,
											'validade_ano' => $convenio->validade_ano,
											'validade_mes' => $convenio->validade_mes,
										]);
									) --}}

								<input type="hidden" name="convenios[]" value="{{ $planos_de_saude ?? null }}">

							</td>

						</tr>
					@endforeach
				@else
					<tr id="convenio_vazio">
						<td class="center-align" colspan="6">Nenhum convênio cadastrado</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
