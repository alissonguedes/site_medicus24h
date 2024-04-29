@props(['active'])

@php
	$classes = $active ?? false ? 'active' : '';
@endphp

<a {{ $attributes->merge(['class' => implode(' ', [$classes, 'waves-effect'])]) }}>
	{{ $slot }}
</a>
