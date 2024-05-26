<x-admin-layout>

	<x-slot:icon href="{{ request('id') ? route('admin.a-ibr.index') : route('admin.dashboard') }}"> wallpaper_slideshow </x-slot:icon>
	<x-slot:title> A IBR </x-slot:title>

	<x-slot:body>

		@if (isset($posts) && $posts->count() > 0)

			@foreach ($posts as $i => $post)
				@php
					$file = new App\Models\Admin\FileModel();
					$hasFile = $file->fileExists($post->id, 'post');
				@endphp

				<div class="row">

					<div class="col s12">

						<div class="card white @if ($i % 2 != 0) reverse @endif">
							@if (!$post->status)
								<i class="inactive material-symbols-outlined"> visibility_off </i>
							@endif
							<div class="card-content black-text">
								<div class="btn-group">
									<x-button class="btn activator btn-floating delete material-symbols-outlined font-weight-400">delete</x-button>
									<x-button class="icon-background btn btn-floating edit material-symbols-outlined font-weight-400" :data-href="route('admin.a-ibr.edit', $post->id)"> edit </x-button>
								</div>
								<div class="titulo">
									<h6 class="bold" style="">{{ $post->subtitulo }}</h6>
									<h4 class="bold no-margin" style="">{{ $post->titulo }}</h4>
								</div>
								<div class="flex flex-auto flex-center mt-3">
									@if ($hasFile)
										<div class="card-image">
											<div class="circle">
												<img src="{{ route('home.a-ibr.show-image', $post->id) . '?action=preview' }}" height="210">
											</div>
										</div>
									@endif
									<span class="">{!! $post->conteudo !!}</span>
								</div>
							</div>

							<div class="card-reveal red darken-4 white-text">
								<div class="row">
									<div class="col s12">
										Tem certeza que deseja remover este banner?
									</div>
								</div>
								<br>
								<br>
								<div class="row">
									<div class="col s6 left-align">
										<button class="btn card-title white black-text waves-effect" style="font-size: inherit; font-family: inherit;">Não</button>
									</div>
									<form action="{{ route('admin.a-ibr.delete') }}" method="post">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="id" value="{{ $post->id }}">
										<div class="col s6 right-align">
											<button class="btn red waves-effect">Sim</button>
										</div>
									</form>
								</div>
							</div>

						</div>

					</div>

				</div>
			@endforeach

		@endif

	</x-slot:body>

	@include('admin.a-ibr.includes.form')

	<x-slot:script>
	</x-slot:script>

</x-admin-layout>
