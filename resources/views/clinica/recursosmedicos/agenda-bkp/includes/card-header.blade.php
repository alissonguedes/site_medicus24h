<div id="search-on-page">
	<button id="open-search" class="btn btn-floating btn-flat mr-3 waves-effect waves-green">
		<i class="material-symbols-outlined">search</i>
	</button>
	<x-text-input type="search" id="input-search-header" :data-url="route('clinica.recursosmedicos.agenda.index')" placeholder="Pesquisar eventos" autocomplete="off" />
</div>

<button type="button" class="btn btn-floating waves-effect gradient-45deg-deep-orange-orange" data-href="{{ route('clinica.recursosmedicos.agenda.index') }}" data-tooltip="Criar Agenda" data-trigger="form" data-target="main-form">
	<i class="material-symbols-outlined">add</i>
</button>

{{-- <div class="column-center" style="width: calc(100% - 130px);">

	<div class="">
		<button type="button" id="calendar-btn-back" class="btn btn-floating btn-flat waves-effect waves-teal transparent material-symbols-outlined white-text no-margin" data-tooltip="Adicionar Evento">
			arrow_back
		</button>
		<button type="button" id="calendar-btn-forward" class="btn btn-floating btn-flat waves-effect waves-teal transparent material-symbols-outlined white-text no-margin" data-tooltip="Adicionar Evento">
			arrow_forward
		</button>
		<button type="button" id="calendar-btn-back" class="btn waves-effect waves-teal transparent outlined border white-text no-margin" data-tooltip="Adicionar Evento">
			Hoje
		</button>
	</div>

	<div class="">
		<!-- Dropdown Trigger -->
		<button class="btn transparent z-depth-0 dropdown-trigger" data-target="dropdown1">
			<span>{{ date('M, d Y') }}</span>
			<i class="material-symbols-outlined right">
				arrow_drop_down
			</i>
		</button>
	</div>

	<div class="">
		<!-- Dropdown Structure -->
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="#!">one</a></li>
			<li><a href="#!">two</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a href="#!">three</a></li>
			<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
			<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
		</ul>

		<!-- Dropdown Trigger -->
		<button class="dropdown-trigger btn" data-target="dropdown1">
			Drop Me!
			<i class="material-symbols-outlined right">
				arrow_drop_down
			</i>
		</button>

		<!-- Dropdown Structure -->
		<ul id='dropdown1' class='dropdown-content'>
			<li><a href="#!">one</a></li>
			<li><a href="#!">two</a></li>
			<li class="divider" tabindex="-1"></li>
			<li><a href="#!">three</a></li>
			<li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
			<li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
		</ul>
	</div>
</div>
<div class="column-right">
	@can('create', App\Models\Admin\AgendaModel::class)
		<x-button type="button" id="card-button" class="btn btn-floating waves-effect" data-href="{{ route('admin.paginas.agenda.index') }}" data-tooltip="Adicionar Evento">
			add
		</x-button>
	@endcan
</div> --}}
