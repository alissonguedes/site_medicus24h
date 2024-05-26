<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-floating waves-effect']) }}>
	<i class="material-symbols-outlined">{{ $slot }}</i>
</button>
