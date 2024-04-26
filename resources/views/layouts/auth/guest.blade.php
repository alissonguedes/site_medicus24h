<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@php
			$path = Route::getCurrentRoute()->getName();
			$name = explode('.', $path)[0];
		@endphp
		<title>
			@if ($name === 'eventos')
				@yield('title', 'Eventos')
			@else
				{{ config('app.name', 'Laravel') }}
			@endif
		</title>

		<!-- Scripts -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])

		{{-- <!-- Fonts -->
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"> --}}
		<link rel="stylesheet" href="{{ asset('assets/styles/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/styles/colors.css') }}">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
		<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css">

		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

		<script>
			$(document).ready(function() {
				let table = new DataTable('#myTable');

				// setTimeout(function() {
				//     $('#message').remove();
				// }, 5000);

				$('select').formSelect();
			})
		</script>
		<!-- Scripts -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])

		<style>
			p {
				margin: 15px 0 0 !important;
			}

			nav,
			nav .nav-wrapper i,
			nav a.sidenav-trigger,
			nav a.sidenav-trigger i {
				height: 61px;
				line-height: 61px;
			}

			.row .modal {
				width: inherit;
			}

			.material-icons,
			.material-symbols-outlined {
				font-size: 24px;
			}

			.mr-1 {
				margin-right: 1% !important;
			}

			.mr-2 {
				margin-right: 2% !important;
			}

			.mr-3 {
				margin-right: 3% !important;
			}

			.ml-1 {
				margin-left: 1% !important;
			}

			.ml-2 {
				margin-left: 2% !important;
			}

			.ml-3 {
				margin-left: 3% !important;
			}

			.invalid,
			.invalid label {
				color: red !important;
			}

			.padding-1 {
				padding: 1%;
			}

			.border {
				border-width: 1px;
				border-style: solid;
			}

			.green-border {
				border-color: var(--gren);
			}

			.border-lighten-2 {
				border-color: var(--green-lighten-2);
			}

			.bold {
				font-weight: bold;
			}

			header nav .nav-wrapper {
				padding: 0 170px;
				border-bottom: 1px solid var(--grey-lighten-2);
			}

			header .mx-auto {
				display: flex;
				flex: 1 100%;
				align-items: center;
				justify-content: space-between;
			}

			.brand-logo {
				margin: 10px 0;
			}

			.brand-logo img {
				width: 135px;
			}

			ul.stepper.horizontal .step .step-content .step-actions {
				/* justify-content: end; */
				position: relative;
			}

			ul.stepper.horizontal .step .step-title {
				position: relative;
				/* cursor: text; */
				background: transparent !important;
			}

			ul.stepper.horizontal {
				min-height: 458px;
			}

			ul.stepper .step.wrong .step-title::before {
				font-family: 'Material Symbols Outlined' !important;
			}

			.input-field {
				margin-bottom: 0;
			}

			.dropdown-content.select-dropdown {
				max-height: 200px;
			}
		</style>

		<!-- JS -->
		<script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>

		<script>
			$(function() {
				// var stepper = document.querySelector('.stepper');
				// var stepperInstace = new MStepper(stepper, {
				// 	// options
				// 	firstActive: 0 // this is the default
				// })

				var stepper = document.querySelector('.stepper');

				if (stepper) {
					var stepperInstace = new MStepper(stepper, {
						// Default active step.
						firstActive: 0,
						// Allow navigation by clicking on the next and previous steps on linear steppers.
						linearStepsNavigation: true,
						// Auto focus on first input of each step.
						autoFocusInput: true,
						// Set if a loading screen will appear while feedbacks functions are running.
						showFeedbackPreloader: true,
						// Auto generation of a form around the stepper.
						autoFormCreation: true,
						// Function to be called everytime a nextstep occurs. It receives 2 arguments, in this sequece: stepperForm, activeStepContent.
						// validationFunction: defaultValidationFunction, // more about this default functions below
						validationFunction: validate,
						// Enable or disable navigation by clicking on step-titles
						stepTitleNavigation: true,
						// Preloader used when step is waiting for feedback function. If not defined, Materializecss spinner-blue-only will be used.
						feedbackPreloader: '<div class="spinner-layer spinner-blue-only">...</div>'
					});

					$('#step-action button').bind('click', function() {
						$('.next-step').click();
					});

					$('#next').bind('click', function() {
						stepperInstace.nextStep();
					});

				}

				function validate(stepperForm, activeStepContent) {

					var _token = $(stepperForm).find('input[name="_token"]').val();
					var _step = $(stepperForm).find('li.active').attr('id');

					var valid = $.ajax({
						method: 'post',
						url: '#',
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}',
							// 'X-CSRF-TOKEN': _token,
						},
						data: $(stepperForm).serialize() + '&step=' + _step,
						success: (response) => {

							$('li.step.active').removeClass('wrong');

							$(stepperForm).find('.input-field').removeClass('invalid')
								.find('.invalid').remove();

							if (response.valid) {

								$('li.step.active').removeClass('active wrong')
									.next()
									.addClass('active')
									.find('.input-field');

								console.log($('li.step.active').index() + 1, $('li.step').length);

								if ($('li.step.active').index() + 1 === $('li.step').length) {
									$('button[type="submit"]#last').attr('disabled', false).show();
									$('button[type="button"]#next').attr('disabled', true).hide();
									// $('li.step.active').find('button[type="submit"]').attr('disabled', false);
								}

								setTimeout(function() {
									$('#message').html(response).show();
								}, 5000);

							}

						},
						error: (response) => {

							var errors = response.responseJSON.errors;
							$(stepperForm).find('.input-field').removeClass('invalid wrong')
								.find('.invalid').remove();

							for (var i in errors) {

								var input = $(stepperForm).find('[name="' + i + '"]');

								input.parents('.input-field').addClass('invalid')
									.append(`<div class="invalid">${errors[i][0]}</div>`);

							}

							// $('#message').show().find('.message').addClass('wrong').html('Error');
							// setTimeout(function() {
							// 	$('#message').hide();
							// }, 5000);

						}

					});

				}

				$('#form-perguntas').unbind().bind('submit', function(e) {

					e.preventDefault();

					var self = $(this);
					var _token = $(this).find('input[name="_token"]').val();
					var _step = $(this).find('li.active').attr('id');

					$.ajax({
						url: location.href,
						success: (response) => {

							console.log(response);

							var _token = response;

							setTimeout(function() {

								$.ajax({
									url: self.attr('action'),
									method: self.attr('method'),
									headers: {
										'X-CSRF-TOKEN': response,
										// 'X-CSRF-TOKEN': _token,
									},
									data: self.serialize(),
									beforeSend: () => {
										self.find('.input-field').removeClass(
												'invalid wrong')
											.find('.invalid').remove();
									},
									success: function(response) {

										if (response.valid) {
											$('#message').show().find('.message')
												.html(response
													.message);

											setTimeout(function() {
												$('#message').hide();
											}, 5000);
										}

									},
									error: (response) => {

										var errors = response.responseJSON.errors;

										for (var i in errors) {

											var input = self.find('[name="' + i +
												'"]');

											input.parents('.input-field').addClass(
													'invalid')
												.append(
													`<div class="invalid">${errors[i][0]}</div>`
												);

										}

									}

								})


							}, 100);

						}
					});

				})

				// Selecionar estado e cidade
				$('[name="uf"]').bind('change', function() {

					$.ajax({
						method: 'get',
						url: $(this).data('url') + '/' + $(this).val() + '/cidades',
						success: (response) => {

							var cidade = $('[name="cidade"]');
							cidade.find('option:not(:disabled)').remove();

							for (var i of response) {
								var option = `<option value="${i.id}">${i.cidade}</option>`
								cidade.attr('disabled', false).append(option);
							}

							cidade.val('Informe sua cidade');
							cidade.formSelect();

						}

					});

				});


			});
		</script>

	</head>

	<body class="font-sans text-gray-900 antialiased">

		<style>
			#page {
				display: flex;
				flex-direction: column;
				flex: 1 1;
			}

			header {
				position: relative;
				height: 61px;
			}

			.navbar-fixed {
				position: fixed;
			}

			header,
			#main {
				/* width: 100%; */
			}

			#main {
				background-color: var(--grey-lighten-4);
				min-height: calc(100vh - 61px);
				/*display: flex;*/
				align-items: center;
				padding-top: 30px;
				/* place-content: center; */
			}
		</style>
		<div id="page">

			<!-- Page Heading -->
			<header>
				@isset($header)
					{{ $header }}
				@endisset
			</header>

			<div id="main">
				{{ $slot }}
			</div>

		</div>
	</body>

</html>
