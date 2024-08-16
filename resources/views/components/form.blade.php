<form {{ $attributes->merge([
    'enctype' => 'multipart/form-data',
    'method' => 'post',
    'id' => 'main-form',
    'autocomplete' => 'off',
]) }}>

	<div class="card card-panel no-border no-margin no-padding" style="height: inherit;">

		@if (isset($tabs))
			<div {{ $tabs->attributes->merge(['class' => 'card-tabs']) }}>
				{{ $tabs }}
			</div>
		@endif

		@if (isset($content))
			<div {{ $content->attributes->merge(['class' => 'card-content']) }}>
				{{ $content }}
			</div>
		@endif

		{{ $slot }}

		@if (isset($footer))
			<div {{ $footer->attributes->merge(['class' => 'card-action right-align']) }}>
				{{ $footer }}
			</div>
		@endif

	</div>

	{{-- Carregar scripts vindo dos formulários, quando necessário --}}
	{{-- @stack('scripts') --}}

</form>

<style>
	.card-reveal form {
		height: 100%;
	}

	.card-reveal form .card-tabs~.card-content {
		height: calc(100% - 117px);
		top: 55px;
	}
</style>
