<x-app-layout>

	<div class="row">

		<div class="col s12 l4 offset-l4">

			<form method="POST" action="{{ route('register') }}">

				@csrf

				<div class="card">

					<div class="card-content">

						<!-- Name -->
						<div class="input-field">
							<x-input-label for="name" :value="__('Name')" />
							<x-text-input type="text" name="name" id="name" class="block mt-1 w-full" :value="old('name')" required autofocus autocomplete="name" />
							<x-input-error class="mt-2" :messages="$errors->get('name')" />
						</div>

						<!-- Email Address -->
						<div class="input-field">
							<x-input-label for="email" :value="__('Email')" />
							<x-text-input type="email" name="email" id="email" class="block mt-1 w-full" :value="old('email')" required autocomplete="username" />
							<x-input-error class="mt-2" :messages="$errors->get('email')" />
						</div>

						<!-- Password -->
						<div class="input-field">
							<x-input-label for="password" :value="__('Password')" />
							<x-text-input type="password" name="password" id="password" class="block mt-1 w-full" required autocomplete="new-password" />
							<x-input-error class="mt-2" :messages="$errors->get('password')" />
						</div>

						<!-- Confirm Password -->
						<div class="input-field">
							<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
							<x-text-input type="password" name="password_confirmation" id="password_confirmation" class="block mt-1 w-full" required autocomplete="new-password" />
							<x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
						</div>

						<div class="flex items-center justify-end mt-4">
							<x-primary-button class="ms-4">{{ __('Cadastrar') }}</x-primary-button>
						</div>

					</div>

				</div>

			</form>

		</div>

	</div>

</x-app-layout>
