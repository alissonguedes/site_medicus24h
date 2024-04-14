<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Médicus24h</title>

		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/materialize/materialize.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/styles/defaults/colors.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/styles/defaults/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/styles/site.css') }}">

		<!-- Compiled and minified JavaScript -->
		<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/materialize/materialize.min.js') }}"></script>

		<script>
			$(function() {
				$('.slider').slider({

				});
			});
		</script>
	</head>

	<body>

		<header>
			<nav class="navbar-color navbar-fixed z-depth-0">
				<div class="nav-wrapper">
					<a class="brand-logo skew" href="#">
						<img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
					</a>
					<ul id="nav-mobile" class="navbar-main right hide-on-med-and-down letterspacing">
						<li><a class="active" href="#">Início</a></li>
						<li><a class="" href="#">Sobre Nós</a></li>
						<li><a class="" href="#">Serviços</a></li>
						<li><a class="" href="#">ClubMédicus24h</a></li>
						<li><a class="" href="#">Atendimento</a></li>
					</ul>
				</div>
			</nav>
		</header>

		<div id="page">
			<div id="slider">
				<div class="slider fullscreen">
					<ul class="slides">
						@for ($i = 1; $i <= 10; $i++)
							@php
								$delay = ['delay-2s', 'delay-3s', 'delay-4s'];
								$animation = ['fadeIn' => 'fadeOut', 'fadeInRight' => 'fadeOutRight', 'fadeInLeft' => 'fadeOutLeft'];
								$rand = rand(0, count($animation) - 1);
								$delay = $delay[rand(0, count($delay) - 1)];
								$inAnimation = array_keys($animation)[$rand];
								$outAnimation = array_values($animation)[$rand];
							@endphp
							<li>
								<img src="{{ asset('assets/img/site/banner/ambulancia.png') }}" class=""
									data-in-animation="{{ $inAnimation }}" data-out-animation="{{ $outAnimation }}">
								<div class="caption center-align">
									<h3 class="animated delay-2s fadeInLeft black-text">This is our big Tagline!</h3>
									<h5 class="red-text">Here's our small slogan.</h5>
								</div>
							</li>
						@endfor
					</ul>
				</div>
				<div class="base">
					<div class="box-1"></div>
					<div class="box-2"></div>
					<div class="box-3"></div>
					<div class="box-4"></div>
					<div class="box-5"></div>
				</div>
			</div>

			<div class="row">
				<div class="col s12 l12">
					<div class="container services">
						<div class="row">
							@for ($i = 0; $i < 3; $i++)
								<div class="col s12 m4">
									<div class="card-panel card-animation-1 card z-depth-0">

										<div class="card-content teal lighten-1 border">

											<img src="{{ asset('assets/img/site/cards/ambulancia.jpg') }}"
												class="border-radius-8 z-depth-3 image-n-margin" alt="">

											<h6 class="card-title">
												<a class="mt-5 letterspacing white-text" href="#">UTI Móvel</a>
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

		</div>

	</body>

</html>
