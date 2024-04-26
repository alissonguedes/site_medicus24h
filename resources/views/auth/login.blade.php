<x-guest-layout>

	<style>
		.flex {
			display: flex;
			align-items: center;
			place-content: center;
		}

		.space-between {
			place-content: space-between;
		}

		#main {
			padding-top: 0;
		}

		#login {
			height: calc(100vh - 61px);
		}

		#login .card {
			margin-top: 0;
		}
	</style>
	<div id="login" class="flex items-center mx-auto">

		<div class="card">

			<div class="card-content">

				<!-- Session Status -->
				<x-auth-session-status class="mb-4" :status="session('status')" />

				<form method="POST" action="{{ route('login') }}">
					@csrf

					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<x-input-label for="email" :value="__('Email')" />
								<x-text-input type="email" name="email" id="email" class="block mt-1 w-full" :value="old('email')" required
									autofocus autocomplete="username" />
								<x-input-error class="mt-2" :messages="$errors->get('email')" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<div class="input-field">
								<x-input-label for="password" :value="__('Password')" />
								<x-text-input type="password" name="password" id="password" class="block mt-1 w-full" required
									autocomplete="current-password" />
								<x-input-error class="mt-2" :messages="$errors->get('password')" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<label for="remember_me" class="inline-flex items-center">
								<input type="checkbox" name="remember" id="remember_me" class="filled-in">
								<span>{{ __('Remember me') }}</span>
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col s12">
							<div class="flex items-center space-between">
								@if (Route::has('password.request'))
									<a href="{{ route('password.request') }}"
										class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
										{{ __('Forgot your password?') }}
									</a>
								@endif
								<x-primary-button class="btn teal black-text waves-effect">
									{{ __('Log in') }}
								</x-primary-button>
							</div>
						</div>
					</div>

				</form>

			</div>

		</div>

	</div>
</x-guest-layout>
