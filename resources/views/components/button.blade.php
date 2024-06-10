<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-floating gradient-45deg-deep-orange-orange waves-effect']) }}>
	<i class="material-symbols-outlined">{{ $slot }}</i>
</button>
