@props(['search'])

<x-slot:header>

	@if (isset($search))
		<div id="search-on-page">

			@php
				$attributes = $search->attributes->merge([
				    'type' => 'search',
				    'id' => 'input-search-header',
				    'url' => $search->attributes['url'] ?? null,
				    'data-target' => $search->attributes['target'] ?? 'main-form',
				    'placeholder' => $search->attributes['placeholder'] ?? null,
				    'class' => $search->attributes['class'] ?? null,
				]);
			@endphp

			<button id="open-search" class="btn btn-floating btn-flat">
				<i class="material-symbols-outlined">search</i>
			</button>

			<x-text-input {{ $attributes }}></x-text-input>

		</div>
	@endif

	@if (isset($add_button))
		@php
			$attributes = $add_button->attributes->merge([
			    'type' => 'button',
			    'class' => 'gradient-45deg-deep-orange-orange',
			    'data-trigger' => $add_button->attributes['trigger'] ?? 'form',
			    'data-target' => $add_button->attributes['target'] ?? 'main-form',
			]);
		@endphp

		<x-button {{ $attributes }}>{{ $add_button }}</x-button>
	@endif

</x-slot:header>
