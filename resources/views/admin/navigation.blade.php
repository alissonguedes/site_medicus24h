<ul id="menu-1" class="in">
	<li><x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">{{ __('Dashboard') }}</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-2" :active="request()->routeIs('admin.teste')">Menu 2 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">Menu 3</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">Menu 4</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-5" :active="request()->routeIs('admin.teste')">Menu 5 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
</ul>

<ul id="menu-2" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-1" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> Menu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-6" :active="request()->routeIs('admin.teste')">SubMenu 6 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-7" :active="request()->routeIs('admin.teste')">SubMenu 7 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-8" :active="request()->routeIs('admin.teste')">SubMenu 8 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
</ul>

<ul id="menu-5" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-1" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> Menu 5</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-6" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-2" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> SubMenu 6</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-7" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-2" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> SubMenu 7</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 3</x-nav-link></li>
</ul>

<ul id="menu-8" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-2" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> SubMenu 8</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-9" :active="request()->routeIs('admin.teste')">SubMenu 3 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
</ul>

<ul id="menu-9" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-8" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> SubMenu 9</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 2</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-10" :active="request()->routeIs('admin.teste')">SubMenu 3 <i class="material-symbols-outlined right">keyboard_arrow_right</i></x-nav-link></li>
</ul>


<ul id="menu-10" class="submenu">
	<li><x-nav-link href="javascript:void(0);" data-id="#menu-9" class="menu-close" :active="request()->routeIs('admin.teste')"> <i class="material-symbols-outlined left">keyboard_arrow_left</i> SubMenu 10</x-nav-link></li>
	<li><x-nav-link href="#" :active="request()->routeIs('admin.teste')">SubMenu 1</x-nav-link></li>
</ul>
