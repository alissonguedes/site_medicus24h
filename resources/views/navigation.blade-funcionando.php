@php
	// dump($menus);
@endphp

@if (isset($menus['menus']))

	@php
		$class = $id_menu == 0 ? 'in' : 'submenu';
	@endphp

	<ul id="menu-{{ $id_menu }}" class="{{ $class }} scroller">
		{{-- @if ($id_menu != 0)
			<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#menu-{{ $id_menu }}" :active="request()->routeIs('admin.teste')"> Menu 2</x-nav-link> </li>
		@endif --}}
		@foreach ($menus['menus'] as $key => $val)
			@php
				$href = isset($menus['submenus'][$val['id']]) ? 'javascript:void(0);' : $val['route'];
				$data_id = isset($menus['submenus'][$val['id']]) ? '#menu-' . $val['id'] : null;
			@endphp
			<li>
				<x-nav-link :href="$href" :data-id="$data_id" :active="request()->routeIs($val['route'])">{{ $val['titulo'] }}</x-nav-link>
			</li>
		@endforeach

	</ul>

@endif

@if (isset($menus['submenus']))

	@foreach ($menus['submenus'] as $key => $val)
		{!! make_menu('main-menu', 'clinica', $key) !!}
	@endforeach

@endif

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
