<header>

	<div class="navbar-search-wrapper">
		<input type="search" id="input-search-header" placeholder="Pesquisar..." autocomplete="off">
	</div>

	<div class="navbar navbar-fixed">

		<nav class="navbar-main navbar-color navbar-dark z-depth-0">

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
						<a href="#" class="waves-effect waves-block waves-light notification-button">
							<i class="material-symbols-outlined">
								notifications
								<small class="notification-badge">+99</small>
							</i>
						</a>
					</li>
					<li>
						<a href="#" class="waves-effect waves-block waves-light profile-button">
							<span class="avatar-status avatar-online">
								<img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="">
								<i></i>
							</span>
						</a>
					</li>
				</ul>

				<ul class="navbar-nav right">
					<li>
						<a class="waves-effect">
							<i class="material-symbols-outlined">event</i>
						</a>
					</li>
					<li>
						<a class="waves-effect">
							<i class="material-symbols-outlined">mail</i>
						</a>
					</li>
					<li class="logo animated infinite slow hide-on-large-only">
						<a href="{{ route('admin.index') }}">
							<span></span>
						</a>
					</li>
					<li class="search">
						<a id="open-search" class="waves-effect" style="position: relative;">
							<i class="material-symbols-outlined">search</i>
						</a>
					</li>
					<li>
						<a class="waves-effect sidenav-trigger" data-target="slide-out">
							<i class="material-symbols-outlined">menu</i>
						</a>
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
						<button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
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
					<form method="POST" action="{{ route('logout') }}">
						@csrf

						<x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
							{{ __('Log Out') }}
						</x-responsive-nav-link>
					</form>
				</div>
			</div>

			<div class="progress">
				<div class="indeterminate teal lighten-1"></div>
			</div>

		</nav>

	</div>

</header>
