<x-header-page data-href="{{ route('clinica.homecare.index') }}" placeholder="Pesquisar pacientes..." title="Adicionar Paciente">
	<x-slot:add_button>
		add
	</x-slot:add_button>

	<x-slot:col_right>

		<!-- Dropdown Trigger -->
		<a href="#" class="dropdown-trigger btn right" data-target="dropdown1">Gestão de cuidados</a>

		<!-- Dropdown Structure -->
		<ul id="dropdown1" class="dropdown-content" style="min-width: 200px;">
			<li><a href="{{ route('clinica.homecare.gestao-de-cuidados') }}">Gestão de Cuidados</a></li>
			<li><a href="{{ route('clinica.homecare.tarefas') }}">Tarefas</a></li>
			<li><a href="{{ route('clinica.homecare.pacientes') }}">Pacientes</a></li>
		</ul>

		@push('scripts')
			<script>
				$('.dropdown-trigger').dropdown();
				var $url = window.location.href;
				var link = $('#dropdown1').find('a[href="' + $url + '"]');
				if (link.text())
					$('.dropdown-trigger[data-target="dropdown1"]').text(link.text());
			</script>
		@endpush

		{{--
		<ul class="tabs">
			<li class="tab"><x-nav-link href="{{ route('clinica.homecare.gestao-de-cuidados') }}" :active="request()->routeIs('clinica.homecare.gestao-de-cuidados')" target="_self">Gestão de Cuidados</x-nav-link></li>
			<li class="tab"><x-nav-link href="{{ route('clinica.homecare.tarefas') }}" :active="request()->routeIs('clinica.homecare.tarefas')" target="_self">Tarefas</x-nav-link></li>
			<li class="tab"><x-nav-link href="{{ route('clinica.homecare.pacientes') }}" :active="request()->routeIs('clinica.homecare.pacientes')" target="_self">Pacientes</x-nav-link></li>
		</ul> --}}

		<style>
			.card-header .tabs {
				background-color: transparent;
				height: 55px;
				line-height: 55px;
			}

			.card-header .tabs .tab {
				height: inherit;
				line-height: inherit;
			}

			.card-header .tabs .tab a {
				line-height: inherit;
				height: inherit;
			}

			.card-header .tabs .indicator {
				display: none;
			}
		</style>

	</x-slot:col_right>

</x-header-page>

@if (request('id'))
	@php
	@endphp
@endif

<x-slot:form action="{{ route('clinica.pacientes.post') }}" method="post" style="{{ $errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);' }}" autocomplete="off">

	@csrf

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<x-slot:form_tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Paciente</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:form_tabs>

	<div class="row">

		<div class="col s12 m12 l12">

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

</x-slot:form>

{{-- <x-slot:scripts_form>
	<script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}" defer></script>
</x-slot:scripts_form> --}}
