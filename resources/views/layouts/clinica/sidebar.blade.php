{{-- <x-slot:sidebar class="sidenav-active-rounded">

	<div id="slide-out" class="sidenav sidenav-fixed sidenav-collapsible leftside-navigation menu-shadow" data-menu="menu-navigation" data-collapsible="accordion">

		<button type="button" class="btn-menu btn-floating waves-effect z-depth-0 hide-on-med-and-down">
			<i class="material-symbols-outlined">menu</i>
		</button>

		<button class="btn btn-flat btn-floating sidenav-close waves-effect mr-3 hide-on-large-only">
			<i class="material-symbols-outlined grey-text text-darken-4">close</i>
		</button>

		@include('clinica.logo')

		<div class="main-menu">
			{!! make_menu('main-menu', 'clinica') !!}
		</div>

	</div>

</x-slot:sidebar> --}}

<x-slot:sidebar>

	<div id="slide-out" class="sidenav sidenav-fixed sidenav-collapsible leftside-navigation menu-shadow" data-menu="menu-navigation" data-collapsible="accordion">

		<a href="#mmenu" class="btn-menu btn-floating waves-effect z-depth-0">
			<i class="material-symbols-outlined">menu</i>
		</a>

		{{-- <button type="button" class="btn-menu btn-floating waves-effect z-depth-0 hide-on-med-and-down">
			<i class="material-symbols-outlined">menu</i>
		</button> --}}

		@include('clinica.logo')

		<button class="btn btn-flat btn-floating sidenav-close waves-effect mr-3 hide-on-large-only">
			<i class="material-symbols-outlined grey-text text-darken-4">close</i>
		</button>

	</div>

	<div id="mmenu" class="main-menu sidenav-active-rounded">
		@include('clinica.navigation')
	</div>

</x-slot:sidebar>
