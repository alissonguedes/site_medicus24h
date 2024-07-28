@props(['search'])
@php
	$attr = $attributes->getAttributes();
	$placeholder = $attr['placeholder'] ?? null;
	$url = $attr['url'] ?? null;
	$btn_title = $attr['title'] ?? null;
	$trigger = $attr['data-trigger'] ?? null;
@endphp

<x-slot:header>

	<div id="search-on-page">
		<button id="open-search" class="btn btn-floating btn-flat mr-3 waves-effect">
			<i class="material-symbols-outlined">search</i>
		</button>
		<x-text-input type="search" id="input-search-header" :data-url="$url" :placeholder="$placeholder" autocomplete="off" />
	</div>

	@if (isset($col_right))
		<div class="right">
			{{ $col_right }}
		</div>
	@endif

	@if (isset($add_button))
		<x-button id="card-button" {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-floating waves-effect']) }} :data-url="$url" :title="$btn_title" :data-trigger="$trigger">
			{{ $add_button }}
		</x-button>
	@endif

</x-slot:header>
