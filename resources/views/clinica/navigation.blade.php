<ul id="main-menu" class="in scroller">
	<li><x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"> <i class="material-symbols-outlined">dashboard</i> {{ __('Dashboard') }}</x-nav-link></li>
	<li><x-nav-link href="javascript:void(0);" class="submenu-open" data-id="#home-page"> <i class="material-symbols-outlined">home</i> Página Inicial </x-nav-link> </li>
	<li><x-nav-link :href="route('admin.a-ibr.index')" :active="request()->routeIs('admin.a-ibr.index')"> <i class="material-symbols-outlined">church</i> A IBR</x-nav-link> </li>
	<li><x-nav-link :href="route('admin.ministerios.index')" :active="request()->routeIs('admin.ministerios.index') || request()->routeIs('admin.ministerios.edit')"> <i class="material-symbols-outlined">groups</i> Ministérios</x-nav-link></li>
	<li><x-nav-link :href="route('admin.cultos.index')" :active="request()->routeIs('admin.cultos.index') || request()->routeIs('admin.cultos.edit')"> <i class="material-symbols-outlined">diversity_3</i> Cultos </x-nav-link> </li>
	<li><x-nav-link :href="route('admin.eventos.index')" :active="request()->routeIs('admin.eventos.index') || request()->routeIs('admin.eventos.edit')"> <i class="material-symbols-outlined">event</i> Eventos </x-nav-link></li>
</ul>

<ul id="home-page" class="{{ request()->routeIs('admin.home.banners.index') || request()->routeIs('admin.home.banners.edit') || request()->routeIs('admin.home.apresentacao.index') || request()->routeIs('admin.home.pastores') || request()->routeIs('admin.home.pastores.index') || request()->routeIs('admin.home.pastores.edit') ? 'in' : 'submenu' }} scroller">
	<li><x-nav-link href="javascript:void(0);" class="menu-close" data-id="#main-menu"> Página Inicial </x-nav-link></li>
	<li>
		<x-nav-link :href="route('admin.home.banners.index')" :active="request()->routeIs('admin.home.banners.index') || request()->routeIs('admin.home.banners.edit')">
			<i class="material-symbols-outlined">wallpaper_slideshow</i>
			Banners
		</x-nav-link>
	</li>
	<li>
		<x-nav-link :href="route('admin.home.apresentacao.index')" :active="request()->routeIs('admin.home.apresentacao.index')">
			<i class="material-symbols-outlined">face</i>
			Apresentação
		</x-nav-link>
	</li>
	<li>
		<x-nav-link :href="route('admin.home.pastores.index')" :active="request()->routeIs('admin.home.pastores.index') || request()->routeIs('admin.home.pastores.edit')">
			<i class="material-symbols-outlined">group</i>
			Corpo Pastoral
		</x-nav-link>
	</li>
</ul>
