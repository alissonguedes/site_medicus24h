@if (isset($menus))

	@php($slide_out = $id_menu == 0 ? 'data-collapsible="accordion"' : null)
	@php($sidenav = $id_menu == 0 ? 'collapsible' : 'collapsible collapsible-sub')

	<ul class="in {{ $sidenav }}" {{ $slide_out }}>
		@foreach ($menus as $key => $val)
			@if ($val['categoria'])
				<li class="navigation-header">
					{{ $val['titulo'] }}
				</li>
			@else
				<li class="">
					@php($href = !empty($val['children']) ? 'javascript:void(0);' : (Route::has($val['route']) ? route($val['route']) : '#'))
					@php($header = !empty($val['children']) ? 'collapsible-header' : null)
					@php($icon = !empty($val['icon']) ? $val['icon'] : null)
					<x-nav-link :href="$href" :class="$header . ' waves-cyan'" :active="request()->routeIs($val['route'])">
						<i class="material-symbols-outlined">{{ $icon }}</i>
						<span class="menu-title">{{ __($val['titulo']) }}</span>
					</x-nav-link>
					@if (!empty($val['children']))
						<div class="collapsible-body">
							{!! make_menu('main-menu', 'clinica', $val['id']) !!}
						</div>
					@endif
				</li>
			@endif
		@endforeach
	</ul>

@endif
