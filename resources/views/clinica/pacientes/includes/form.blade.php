<x-header-page class="" data-trigger="form-paciente" placeholder="Procurar pacientes..." title="Adicionar Paciente" data-url="{{ route('clinica.pacientes.index') }}">add</x-header-page>

@if (request('id'))
	@php
		$id = $paciente->id;
		$nome = $paciente->nome;
		$codigo = $paciente->codigo;
		$imagem = $paciente->imagem;
		$associado = $paciente->associado;
		$id_estado_civil = $paciente->id_estado_civil;
		$id_etnia = $paciente->id_etnia;
		$sexo = $paciente->sexo;
		$data_nascimento = $paciente->data_nascimento;
		$cpf = $paciente->cpf;
		$rg = $paciente->rg;
		$cns = $paciente->cns;
		$mae = $paciente->mae;
		$pai = $paciente->pai;
		$notas_gerais = $paciente->notas_gerais;
		$notas_alergias = $paciente->notas_alergias;
		$notas_clinicas = $paciente->notas_clinicas;
		$logradouro = $paciente->logradouro;
		$numero = $paciente->numero;
		$complemento = $paciente->complemento;
		$cidade = $paciente->cidade;
		$bairro = $paciente->bairro;
		$cep = $paciente->cep;
		$uf = $paciente->uf;
		$pais = $paciente->pais;
		$email = $paciente->email;
		$telefone = $paciente->telefone;
		$celular = $paciente->celular;
		$receber_notificacoes = $paciente->receber_notificacoes;
		$receber_email = $paciente->receber_email;
		$receber_sms = $paciente->receber_sms;
		$obito = $paciente->obito;
		$status = $paciente->status;
		$matricula = $paciente->matricula;
		$id_tipo_convenio = $paciente->id_tipo_convenio;
		$id_acomodacao = $paciente->id_acomodacao;
		$validade = $paciente->validade;
		$convenio = $paciente->convenio;
		$tipo_plano = $paciente->tipo_plano;
		$acomodacao = $paciente->acomodacao;
		$data_obito = $paciente->data_obito;
		$hora_obito = $paciente->hora_obito;
		$etnia = $paciente->etnia;
	@endphp
@endif

<x-slot:form action="{{ route('clinica.pacientes.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}">

	@csrf
	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:form_tabs>

	<div class="row">

		<div class="col s12 m12 l12">

			<!-- BEGIN #informacoes_pessoais -->
			<div id="dados-pessoais">
				@include('clinica.pacientes.includes.form.informacoes-pessoais')
			</div>
			<!-- END #informacoes_pessoais -->

			<!-- BEGIN #informacoes_contato -->
			<div id="contato">
				@include('clinica.pacientes.includes.form.contato')
			</div>
			<!-- END #informacoes_contato -->

			<!-- BEGIN #informacoes_convenio -->
			<div id="convenio">
				@include('clinica.pacientes.includes.form.convenio')
			</div>
			<!-- END #informacoes_convenio -->

			<!-- BEGIN #informacoes_endereco -->
			<div id="endereco">
				@include('clinica.pacientes.includes.form.endereco')
			</div>
			<!-- END #informacoes_endereco -->

			<!-- BEGIN #observacoes -->
			<div id="observacoes">
				@include('clinica.pacientes.includes.form.observacoes')
			</div>
			<!-- END #observacoes -->

			<!-- BEGIN #outras_informacoes -->
			<div id="outras_informacoes">
				@include('clinica.pacientes.includes.form.mais-informacoes')
			</div>
			<!-- END #outras_informacoes -->

		</div>

	</div>

	<x-slot:card_footer>
		<div class="row">
			<div class="col s12 right-align">
				<button type="reset" class="btn grey-text text-darken-4 white waves-effect mr-3 left">
					<i class="material-symbols-outlined left">cancel</i>
					<span>Cancelar</span>
				</button>
				<button type="submit" class="btn green waves-effect">
					<i class="material-symbols-outlined left">save</i>
					<span>Salvar</span>
				</button>
			</div>
		</div>
	</x-slot:card_footer>

</x-slot:form>
