@if (isset($menus))

	<ul>
		@foreach ($menus as $key => $val)
			@if ($val['categoria'])
				<li class="menu-title">
					{{ $val['titulo'] }}
				</li>
			@else
				<li>
					@php($href = !empty($val['children']) ? 'javascript:void(0);' : (Route::has($val['route']) ? route($val['route']) : '#'))
					@php($header = !empty($val['children']) ? '' : null)
					@php($icon = !empty($val['icon']) ? $val['icon'] : null)
					<x-nav-link :href="$href" :class="$header . ' waves-cyan'" :active="request()->routeIs($val['route'])">
						<i class="material-symbols-outlined">{{ $icon }}</i>
						{{ __($val['titulo']) }}
					</x-nav-link>
					@if (!empty($val['children']))
						{!! make_menu('main-menu', 'clinica', $val['id']) !!}
					@endif
				</li>
			@endif
		@endforeach
	</ul>

@endif
