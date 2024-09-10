<x-slot:sidebar>

	<div id="slide-out" class="sidenav sidenav-fixed sidenav-collapsible leftside-navigation menu-shadow" data-menu="menu-navigation" data-collapsible="accordion">

		<a href="#mmenu" class="btn-menu btn-floating waves-effect z-depth-0">
			<i class="material-symbols-outlined">menu</i>
			{{-- Menu --}}
		</a>

		@include('clinica.logo')

		<button class="btn btn-flat btn-floating sidenav-close waves-effect mr-3 hide-on-large-only">
			<i class="material-symbols-outlined grey-text text-darken-4">close</i>
		</button>

	</div>

	<div id="mmenu" class="main-menu sidenav-active-rounded animated fadeIn">
		@include('clinica.navigation')
	</div>

</x-slot:sidebar>
