@props(['active'])

@php
	$classes = $active ?? false ? '' : '';
@endphp

<li>
	<a {{ $attributes->merge(['class' => $classes]) }}>
		{{ $slot }}
	</a>
</li>
