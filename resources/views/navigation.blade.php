@if (isset($menus))

	@foreach ($menus as $ind => $item)
		@php($slide_out = $id_menu == 0 ? '' : null)
		@php($sidenav = $id_menu == 0 ? 'collapsible' : 'collapsible collapsible-sub')

		<ul class="{{ $sidenav }}" {{ $slide_out }}>
			@foreach ($item as $i)
				@if ($i['categoria'])
					<li class="navigation-header">
						<a class="navigation-header-text">{{ $i['titulo'] }}</a>
						<i class="navigation-header-icon material-symbols-outlined">more_horiz</i>
					</li>
				@else
					<li class="bold">
						@php($href = !empty($i['children']) ? 'javascript:void(0);' : (Route::has($i['route']) ? route($i['route']) : '#'))
						@php($header = !empty($i['children']) ? 'collapsible-header' : null)
						@php($icon = !empty($i['icon']) ? $i['icon'] : null)
						<x-nav-link :href="$href" :class="$header . ' waves-cyan'" :active="request()->routeIs($i['route'])">
							{{-- {{ Route::getCurrentRoute($i['route'])->uri() }} --}}
							{{-- @dump(Route::has($i['route']) ? Route::get($i['route']) : 'null') --}}
							<i class="material-symbols-outlined">{{ $icon }}</i>
							<span class="menu-title">{{ __($i['titulo']) }}</span>
						</x-nav-link>
						@if (!empty($i['children']))
							<div class="collapsible-body">
								{!! make_menu('main-menu', 'clinica', $i['id']) !!}
							</div>
						@endif
					</li>
				@endif
			@endforeach
		</ul>
	@endforeach

@endif
