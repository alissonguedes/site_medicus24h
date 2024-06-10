<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.home.pastores.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> Corpo Pastoral </x-slot:title>

	<x-slot:body>

		@if (isset($pastores) && $pastores->count() > 0)
			<div class="row">
				@foreach ($pastores as $pastor)
					<div class="col s6 m3 l3 mb-3">
						<div class="avatar card transparent z-depth-0 no-padding">

							@if (!$pastor->status)
								<i class="inactive material-symbols-outlined"> visibility_off </i>
							@endif

							<div class="card-image">
								<div class="circle light-green-border border-lighten-4 border-10">
									<img src="{{ route('home.pastores.show-image', $pastor->id) . '?action=preview' }}">
									<div class="btn-group">
										<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
										<x-button class="icon-background btn btn-floating edit material-symbols-outlined font-weight-400" :data-href="route('admin.home.pastores.edit', $pastor->id)"> edit </x-button>
									</div>
								</div>
							</div>

							<div class="card-content no-margin no-padding center-align black-text">
								<h5 class="white-text">{{ $pastor->nome }}</h5>
							</div>
							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este pastor?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.home.pastores.delete') }}" method="post">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="id" value="{{ $pastor->id }}">
										<div class="col s6 right-align">
											<button class="btn red waves-effect">Sim</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="row">
				<div class="col s12">
					Nenhum pastor cadastrado.
				</div>
			</div>
		@endif

		@include('admin.home.pastores.includes.form')

	</x-slot:body>

	<x-slot:script>
		{{-- <script>
			$('.materialboxed').materialbox();
		</script> --}}
		<x-modal id="form_plano_saude">
			Teasdfste
		</x-modal>
	</x-slot:script>

</x-admin-layout>
