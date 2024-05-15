<div {{ $attributes->merge(['class' => 'modal', 'style' => 'z-index: 99999999999;']) }}>
	<div class="modal-content">
		{{ $slot }}
	</div>
</div>
