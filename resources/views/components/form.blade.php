<form {{ $attributes->merge([
    'enctype' => 'multipart/form-data',
    'method' => 'post',
    'id' => 'main-form',
    'autocomplete' => 'off',
    // 'class' => '',
]) }}>

	<div class="card card-panel no-border no-margin no-padding" style="height: inherit;">

		@if (isset($tabs))
			<div {{ $tabs->attributes->merge(['class' => 'card-tabs']) }}>
				{{ $tabs }}
			</div>
		@endif

		<div class="card-content">
			{{ $slot }}
		</div>

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
		position: absolute;
		left: 0;
		right: 0;
		bottom: 0;
		top: 0;
		height: inherit;
	}

	.card-reveal form .card-content {
		height: calc(100% - 140px);
		top: 55px;
	}
</style>
