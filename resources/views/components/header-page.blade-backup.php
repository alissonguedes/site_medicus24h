@props(['search'])
@php
	$attr = $attributes->getAttributes();
	$placeholder = $attr['placeholder'] ?? null;
	$url = $attr['url'] ?? null;
	$btn_title = $attr['title'] ?? null;
	$trigger = $attr['data-trigger'] ?? 'form';
	$target = $attr['data-target'] ?? 'main-form';
@endphp

<x-slot:header>

	<div id="search-on-page">
		<button id="open-search" class="btn btn-floating btn-flat mr-3 waves-effect">
			<i class="material-symbols-outlined">search</i>
		</button>
		<x-text-input type="search" id="input-search-header" :data-href="$url" :placeholder="$placeholder" autocomplete="off" />
	</div>

	@if (isset($col_right))
		<div class="right">
			{{ $col_right }}
		</div>
	@endif

	@if (isset($add_button))
		@php
			$attr = $add_button->attributes;
			$url = $attr['data-href'];
		@endphp
		{{-- :data-href="$url" :title="$btn_title" :data-target="$target" --}}
		<x-button {{ $attributes->merge([
		    'type' => 'button',
		    'class' => 'btn btn-floating waves-effect',
		    'id' => 'card-button',
		    'data-trigger' => 'form',
		]) }}>
			{{ $add_button }}
		</x-button>
	@endif
	@dump($url)

</x-slot:header>
