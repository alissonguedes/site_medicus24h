<x-slot:forms>

	<x-form action="{{ route('clinica.especialidades.post') }}" method="post" id="main-form" autocomplete="off">

		@csrf

		{{-- <input type="hidden" name="categoria" value="especialidade"> --}}

		@if (request('id'))
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id" value="{{ $especialidade->id }}">
		@endif

		{{-- <x-slot:tabs>
			<ul class="tabs tabs-fixed-width">
				<li class="tab"><a href="#dados-exame" class="active">Dados do Exame</a></li>
				<li class="tab"><a href="#condicoes">Condições</a></li>
				<li class="tab"><a href="#regras">Regras</a></li>
				<li class="tab"><a href="#informacoes-adicionais">Informações adicionais</a></li>
			</ul>
		</x-slot:tabs> --}}

		<x-slot:content>

			<div class="row">

				<div class="col s12 m12 l12">

					<div id="dados-exame">

						<div class="row">
							<div class="col s12">
								<h6>Dados da Especialidade</h6>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m6 l6">
								<div class="input-field">
									<label for="especialidade" class="{{ isset($especialidade) && $especialidade->especialidade ? 'active' : null }}">Nome da especialidade</label>
									<input type="text" name="especialidade" id="especialidade" value="{{ $especialidade->especialidade ?? null }}">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<div class="input-field">
									<label for="descricao" class="{{ isset($especialidade) && $especialidade->descricao ? 'active' : null }}">Descrição</label>
									<textarea name="descricao" id="descricao" class="materialize-textarea">{{ $especialidade->descricao ?? null }}</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<label for="status" class="active">Especialidade ativa</label>
								</div>
								<div id="status" class="switch">
									<label>
										Não
										<input type="checkbox" name="status" id="status" value="1" @checked(!isset($especialidade) || ($especialidade && $especialidade->status == '1'))>
										<span class="lever"></span>
										Sim
									</label>
								</div>
							</div>
						</div>

					</div>

					<!-- BEGIN condicoes -->
					<div id="condicoes">

					</div>
					<!-- END condicoes -->

					<!-- BEGIN regras -->
					<div id="regras">

					</div>
					<!-- END regras -->

					<!-- BEGIN informacoes-adicionais -->
					<div id="informacoes-adicionais">

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

		@include('clinica.especialidades.includes.scripts')

	</x-form>

	<x-slot:form_delete action="{{ route('clinica.especialidades.delete') }}">
		<p class="bold">Esta ação não poderá ser desfeita.</p>
		<br>
		<p>Tem certeza que deseja remover este especialidade?</p>
		<div id="item"></div>
	</x-slot:form_delete>

</x-slot:forms>
