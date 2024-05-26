<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.home.apresentacao.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Apresentação </x-slot:title>

	<x-slot:main>

		@include('admin.home.apresentacao.includes.form')

	</x-slot:main>

</x-admin-layout>
