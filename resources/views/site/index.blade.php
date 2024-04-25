<x-site-layout>

	<x-slot:title>Página Inicial</x-slot:title>

	<div id="home" class="scrollspy">
		<div id="slider" class="splide">
			<div class="splide__track">
				<ul class="splide__list">
					@for ($i = 0; $i <= 10; $i++)
						<li class="splide__slide">
							<img src="{{ asset('assets/img/site/banner/ambulancia.png') }}" alt="">
							<span class="teal-text text-lighten-1">DRª. Maria da Conceição</span>
							<small> {{ $i }} - Pediatra</small>
						</li>
					@endfor
				</ul>
			</div>
		</div>
	</div>

	<div id="about-us" class="row scrollspy">
		<div class="col s12 l12">
			<div class="container services">
				<div class="row">
					@for ($i = 0; $i < 3; $i++)
						<div class="col s12 m6 l4">
							<div class="card-panel card-animation-1 card z-depth-0">

								<div class="card-content teal lighten-1 border">

									<img src="{{ asset('assets/img/site/cards/ambulancia.jpg') }}" class="border-radius-8 z-depth-3 image-n-margin" alt="">

									<h6 class="card-title">
										<a href="#" class="mt-5 letterspacing white-text">UTI Móvel</a>
									</h6>

									<ul>
										<li>
											<span>Profissionais especializados</span>
										</li>
										<li>
											<span>Suporte básico e avançado</span>
										</li>
										<li>
											<span>Proteção médica</span>
										</li>
										<li>
											<span>Profissionais capacitados</span>
										</li>
										<li>
											<span>Atendimento ágil</span>
										</li>
									</ul>
								</div>

							</div>
						</div>
					@endfor
				</div>
			</div>
		</div>
	</div>

	<div id="outros-servicos" class="row red scrollspy">

		<div class="header">
			<h4 class="espec center-align">Outros Serviços</h4>
		</div>

		<div class="container">

			<div class="row">

				@for ($i = 0; $i < 3; $i++)
					<div class="col s12 m6 l4">

						<div class="card-panel outlined card-animation-1 card z-depth-0">

							<div class="card-content teal lighten-1 border">

								<img src="{{ asset('assets/img/site/cards/ambulancia.jpg') }}" class="border-radius-8 z-depth-3 image-n-margin" alt="">

								<h6 class="card-title">
									<a href="#" class="mt-5 letterspacing white-text">UTI Móvel</a>
								</h6>

								<ul>
									<li>
										<span>Profissionais especializados</span>
									</li>
									<li>
										<span>Suporte básico e avançado</span>
									</li>
									<li>
										<span>Proteção médica</span>
									</li>
									<li>
										<span>Profissionais capacitados</span>
									</li>
									<li>
										<span>Atendimento ágil</span>
									</li>
								</ul>
							</div>

						</div>

					</div>
				@endfor

			</div>

		</div>

		<div class="footer"></div>

	</div>

	<div id="nossa-equipe" class="row scrollspy">
		<div class="col s12">
			<div class="container">
				<div class="row">
					<div class="col s12 l12">
						<div class="row">
							<div class="col s12">
								<h4 class="right-align"><small>Nossa</small><br>Equipe</h4>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<div id="slideshow" class="splide">
									<div class="splide__track">
										<ul class="splide__list">
											@for ($i = 0; $i <= 10; $i++)
												<li class="splide__slide">
													<div class="card card-panel profile z-depth-3">
														<div class="card-content">
															<div class="img">
																<img src="{{ asset('assets/img/site/profiles/profile.jpg') }}" alt="">
															</div>
														</div>
														<div class="card-title center-align">
															<span class="teal-text text-lighten-1">DRª. Maria da Conceição</span>
															<small> {{ $i }} - Pediatra</small>
														</div>
													</div>
												</li>
											@endfor
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<x-slot:script>
		<script>
			// #slider
			Splide.defaults = {
				type: 'loop',
				speed: 1000,
				perPage: 1,
				autoplay: true,
				wheel: false,
				arrows: false,
				pauseOnHover: false,
				pagination: false,
			};
			new Splide('#slider').mount();

			// #slideshow
			Splide.defaults = {
				type: 'loop',
				speed: 1000,
				perPage: 4,
				perMove: 4,
				autoplay: true,
				wheel: false,
				arrows: false,
				pauseOnHover: false,
				pagination: false,
				gap: '1rem',
			};
			new Splide('#slideshow').mount();
		</script>
	</x-slot:script>

</x-site-layout>
