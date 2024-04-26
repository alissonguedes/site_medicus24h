<header>

	<nav class="navbar-main navbar-color navbar-fixed z-depth-0">

		<div class="nav-wrapper">

			<ul>
				<li>
					<a class="waves-effect">
						<i class="material-symbols-outlined">event</i>
					</a>
				</li>
				<li>
					<a class="waves-effect">
						<i class="material-symbols-outlined">search</i>
					</a>
				</li>
				<li>
					<a class="waves-effect">
						<i class="material-symbols-outlined">search</i>
					</a>
				</li>
			</ul>

			{{-- <a href="#" class="brand-logo">
				@if (isset($header))
					{{ $header }}
				@else
					<img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
				@endif
			</a> --}}

			{{-- @include('admin.navigation') --}}

			<button id="btn-menu" class="btn btn-flat transparent btn-floating btn-menu-nav waves-effect right">
				<i class="material-symbols-outlined">menu</i>
			</button>

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
					<button
						class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
						<div>{{ Auth::user()->name }}</div>

						<div class="ms-1">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
								<path fill-rule="evenodd"
									d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
									clip-rule="evenodd" />
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

</header>
