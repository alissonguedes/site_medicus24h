@php
	dump($menus);
@endphp

@foreach ($menus as $ind => $menu)
	@php
		$class = $id_menu == 0 ? 'in' : 'out';
	@endphp
	<ul id="menu-{{ $ind }}" class="">

		@foreach ($menu as $m)
			@if (!empty($m['id']))
				<li>
					<a href="#">{{ $m['titulo'] }}</a>
				</li>
			@endif
		@endforeach

	</ul>
	{{-- {!! make_menu('main-menu', 'clinica', $ind) !!} --}}
@endforeach

{{-- @foreach ($menus as $key => $menu)
	@if ($key != 'submenus')
		<ul id="menu-{{ $key }}" class="in scroller">
			@foreach ($menu as $m)
				<li>
					@var($in = in_array($m['id'], array_keys($menus['submenus'])))
					@var($url = $in ? 'javascript:void(0);' : route('admin.index'))
					@php
						$data_id = $in ? '#menu-' . $m['id'] : null;
					@endphp
					<x-nav-link data-id="{{ $data_id }}" :href="$url">{{ $m['titulo'] }}</x-nav-link>
				</li>
			@endforeach
		</ul>
	@endif
@endforeach

@if (isset($menus['submenus']))
	@foreach ($menus['submenus'] as $key => $sub)
		@if (!empty($sub))
			@foreach ($sub as $i => $s)
				<ul id="menu-{{ $key }}" class="submenu scroller">
					@php
						dump($s);
					@endphp
					{{-- {!! make_menu('main-menu', 'clinica', $s['id']) !!} --}}
{{-- @var($url = !isset($menus['submenu'][$key]) ? url($menu['route']) : 'javascript:void(0);') --}}
{{-- <x-nav-link :href="$url">@php echo($menu['titulo']) @endphp</x-nav-link> --}}
{{-- </ul>
@endforeach
@endif
@endforeach
@endif --}}

{{-- @if (isset($ul))
	@foreach ($ul as $ul => $li)
		<ul id="menu-{{ $ul }}" class="in">
			@foreach ($li as $i => $l)
				@if ($l['category'])
					<li>
						<h3 style="">{{ $l['titulo'] }}</h3>
					</li>
				@else
					@var($url = empty($l['children']) ? url($l['route']) : 'javascript:void(0);')
					<li>
						<x-nav-link :href="$url">{{ $l['titulo'] }}</x-nav-link>
					</li>
				@endif
			@endforeach
		</ul>
		@foreach ($li as $i => $l)
			@if (!empty($l['children']))
				{!! make_menu('main-menu', 'clinica', $l['id']) !!}
			@endif
		@endforeach
	@endforeach
@endif --}}

{{-- {!! getMenu('main-menu', 'clinica') !!} --}}
{{-- <ul id="menu-1" class="in scroller">
	<li><x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">{{ __('Dashboard') }}</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-2" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">dashboard</i> Menu 2 </x-nav-link></li>
	<li><x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"><i class="material-symbols-outlined left">group</i>Menu 3</x-nav-link> </li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')"><i class="material-symbols-outlined left">event</i>Menu 4</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-5" :active="request()->routeIs('admin.teste')">Menu 5 </x-nav-link></li>
</ul>

<ul id="menu-2" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-1" :active="request()->routeIs('admin.teste')"> Menu 2</x-nav-link> </li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-6" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">dashboard</i> SubMenu 6 </x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-7" :active="request()->routeIs('admin.teste')">SubMenu 7 </x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-8" :active="request()->routeIs('admin.teste')">SubMenu 8 </x-nav-link></li>
</ul>

<ul id="menu-5" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-1" :active="request()->routeIs('admin.teste')"> Menu 5</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-6" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-2" :active="request()->routeIs('admin.teste')"> SubMenu 6</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-7" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-2" :active="request()->routeIs('admin.teste')"> SubMenu 7</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-8" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-2" :active="request()->routeIs('admin.teste')"> SubMenu 8</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-9" :active="request()->routeIs('admin.teste')">SubMenu 3 </x-nav-link></li>
</ul>

<ul id="menu-9" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-8" :active="request()->routeIs('admin.teste')"> SubMenu 9</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#menu-10" :active="request()->routeIs('admin.teste')">SubMenu 3 </x-nav-link></li>
</ul>

<ul id="menu-10" class="submenu scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-9" :active="request()->routeIs('admin.teste')"> SubMenu 10</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
</ul> --}}
