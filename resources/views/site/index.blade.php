<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Médicus24h</title>

		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="{{ asset('assets/styles/defaults/colors.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/styles/defaults/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/styles/site.css') }}">

		<!-- Compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

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
					<h1 class="no-margin no-padding">
						<a class="brand-logo" href="#">
							<img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
						</a>
					</h1>
					<ul id="nav-mobile" class="right hide-on-med-and-down letterspacing">
						<li><a class="skew active" href="#">Início</a></li>
						<li><a class="skew" href="#">Sobre Nós</a></li>
						<li><a class="skew" href="#">Serviços</a></li>
						<li><a class="skew" href="#">ClubMédicus24h</a></li>
						<li><a class="skew" href="#">Atendimento</a></li>
					</ul>
				</div>
			</nav>
		</header>

		<div id="page">
			<div id="slider">
				<div class="slider fullscreen">
					<ul class="slides">
						@for ($i = 1; $i <= 2; $i++)
							<li>
								<img src="{{ asset('assets/img/site/banner/ambulancia.png') }}" class="animated delay-3s fadeInRight" style="position: absolute; top: 30px; left: 150px;">
								<div class="caption center-align">
									<h3 class="animated delay-1s fadeInLeft">This is our big Tagline!</h3>
									<h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
								</div>
							</li>
						@endfor
					</ul>
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

											<img src="{{ asset('assets/img/site/cards/ambulancia.jpg') }}" class="border-radius-8 z-depth-3 image-n-margin" alt="">

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

			<script>
				// $(function() {
				//     setInterval(function() {
				//         $('#slider').find('.slides li .animated').each(function() {
				//             if ($(this).is(':visible')) {
				//                 $(this).removeClass('fadeInRight');
				//                 $(this).addClass('fadeOutLeft');
				//             } else {
				//                 $(this).removeClass('fadeInLeft');
				//                 $(this).addClass('fadeOutRight');
				//             }
				//         });
				//     }, 1200);
				// })
			</script>
		</div>

	</body>

</html>
