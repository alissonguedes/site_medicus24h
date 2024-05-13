<div class="fixed-action-btn direction-top active" style="bottom: 60px; right: 40px;">

	<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-floating btn-large z-depth-3 gradient-shadow waves-effect blue']) }}>
		<i class="material-symbols-outlined">{{ $slot }}</i>
	</button>

</div>
