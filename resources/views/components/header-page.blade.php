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
		<button id="open-search" class="btn btn-floating btn-flat -45deg-blue-grey-blue mr-3 waves-effect">
			<i class="material-symbols-outlined grey-text">search</i>
		</button>
		<x-text-input type="search" id="input-search-header" :data-url="$url" :placeholder="$placeholder" autocomplete="off" />
	</div>
	<x-button id="card-button" :title="$btn_title" :data-trigger="$trigger" {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-floating gradient-45deg-deep-orange-orange waves-effect']) }}>{{ $slot }}</x-button>
</x-slot:header>
