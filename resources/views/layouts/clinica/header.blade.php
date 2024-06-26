<header>

	{{--
	<div class="navbar-search-wrapper">
		<input type="search" id="input-search-header" placeholder="Pesquisar..." autocomplete="off">
	</div>
	--}}

	<div class="navbar navbar-fixed">

		<nav class="navbar-main navbar-color z-depth-0">

			<div class="nav-wrapper">

				@if (isset($title))
					<h1 id="page-title">

						@if (isset($icon))
							@var($attributes = $icon->attributes ?? null)
							<x-icon-page {{ $attributes }}>{{ $icon }}</x-icon-page>
						@endif

						{{ $title }}

					</h1>
				@endif

				<ul class="navbar-list right">
					<li>
						<!-- Authentication -->
						<form action="{{ route('logout') }}" method="post">
							@csrf
							<x-nav-link class="waves-effect waves-blue profile-button" onclick="event.preventDefault(); this.closest('form').submit();">
								<i class="material-symbols-outlined">logout</i>
								{{-- <span class="avatar-status avatar-online">
									<img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="">
								</span> --}}
							</x-nav-link>
						</form>
					</li>
				</ul>

				<ul class="navbar-nav right">
					<li>
						<a href="{{ site_url('/') }}" class="waves-effect waves-blue" target="_blank">
							<i class="material-symbols-outlined">web</i>
						</a>
					</li>
					<li>
						<a class="waves-effect waves-blue">
							<i class="material-symbols-outlined sonar">mail</i>
						</a>
					</li>
					<li class="logo animated infinite slow hide-on-large-only">
						<a href="{{ route('clinica.dashboard') }}">
							<img src="{{ asset('assets/img/logo/coracao-white.png') }}" alt="" width="35px">
						</a>
					</li>
					<li>
						<a href="#" class="waves-effect waves-blue notification-button">
							<i class="material-symbols-outlined">
								notifications
								<small class="notification-sonar sonar"></small>
								{{-- <small class="notification-badge">+99</small> --}}
							</i>
						</a>
					</li>
					<li>
						<a href="#mmenu" id="mm-open-menu">
							<i class="material-symbols-outlined">menu</i>
						</a>
						{{-- <button type="button" class="btn-floating waves-effect z-depth-0 sidenav-trigger" data-target="sidebar-menu">
							<i class="material-symbols-outlined">menu</i>
						</button> --}}
						{{-- <a class="waves-effect waves-green sidenav-trigger" data-target="slide-out">
							<i class="material-symbols-outlined">menu</i>
						</a> --}}
					</li>
				</ul>

			</div>

			{{-- @if (Route::has('login') && Auth::id() === 1)
				@auth
					@if (Route::has('register'))
						<x-nav-link :href="route('register')" :active="request()->routeIs('register')">{{ __('Usuários') }}</x-nav-link>
					@endif
				@endauth
			@endif --}}

			<!-- Settings Dropdown -->
			<div class="hide">
				<x-dropdown align="right" width="48">
					<x-slot name="trigger">
						<button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
							<div>{{ Auth::user()->name }}</div>

							<div class="ms-1">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
									<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
								</svg>
							</div>
						</button>
					</x-slot>

					<x-slot name="content"></x-slot>

				</x-dropdown>

			</div>

			<!-- Responsive Navigation Menu -->
			<div class="hide">
				<x-responsive-nav-link href="route('dashboard')" :active="request()->routeIs('dashboard')">
					{{ __('Dashboard') }}
				</x-responsive-nav-link>
			</div>

			<!-- Responsive Settings Options -->
			<div class="hide">
				<div class="">
					<div class="">{{ Auth::user()->name }}</div>
					<div class="">{{ Auth::user()->email }}</div>
				</div>

				<div class="mt-3 space-y-1">
					<x-responsive-nav-link href="#">
						{{ __('Profile') }}
					</x-responsive-nav-link>

					<!-- Authentication -->
					<form action="{{ route('logout') }}" method="post">
						@csrf

						<x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
							{{ __('Log Out') }}
						</x-responsive-nav-link>
					</form>
				</div>
			</div>

		</nav>

	</div>

</header>
