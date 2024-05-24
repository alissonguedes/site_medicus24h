<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', config('site.og:locale') ?? app()->getLocale()) }}">

	<head>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimal-ui">
		<meta name="description" content="{{ config('site.description') }}">
		<meta name="keywords" content="{{ config('site.keywords') }}">
		<meta name="author" content="{{ config('site.author') }}">
		<meta name="robots" content="{{ config('site.robots') }}">
		<meta name="theme-color" content="{{ config('site.theme-color', '#ff0000') }}">
		<meta rel="manifest" name="manifest.json">

		<meta property="og:title" content="{{ config('site.title') }}">
		<meta property="og:image" content="{{ config('site.logo') }}">
		<meta property="og:description" content="{{ config('site.description') }}">
		<meta property="og:url" content="{{ config('site.url') }}">
		<meta property="og:type" content="{{ config('site.type') }}">
		<meta property="og:locale" content="{{ config('site.locale') }}">
		<meta property="og:site_name" content="{{ config('site.title') }}">

		<link rel="preload" href="{{ asset('img/logo1.png') }}" as="image">
		<link rel="canonical" href="{{ config('site.url') }}">
		<link rel="manifest" href="{{ url('/webmainfest') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ url('/favicon.ico') }}" />
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
		<link rel="icon" type="image/png" href="{{ url('/favicon-16x16.png') }}" sizes="16x16">
		<link rel="icon" type="image/png" href="{{ url('/favicon-32x32.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ url('/android-launcherincon-512-512.png') }}" sizes="512x512">
		<link rel="apple-touch-icon" type="image/png" href="{{ url('/apple-touch-icon.png') }}" sizes="180x180">
		<link rel="stylesheet" href="{{ asset('assets/node_modules/pace-js/pace-theme-default.min.css') }}">

		@if (isset($styles))
			{{ $styles }}
		@endif

		<title>{{ config('site.title') . (isset($title) ? ' - ' . $title : null) }}</title>

		@vite(['resources/css/app.css', 'resources/js/app.js'])

	</head>

	<body>

		<div class="progress">
			<div class="indeterminate-center"></div>
		</div>

		{{-- BEGIN #Page --}}
		<div id="page">

			{{ $slot }}

			<script>
				var BASE_URL = "{{ base_url() }}";
				var BASE_PATH = "{{ asset('/') }}";
				var SITE_URL = "{{ site_url() }}";
				var SITE_KEY = "{{ env('INVISIBLE_RECAPTCHA_SITEKEY') }}";
			</script>

			@if (isset($scripts))
				{{ $scripts }}
			@endif

		</div>
		{{-- END #Page --}}

		<script src="{{ asset('assets/node_modules/pace-js/pace.min.js') }}"></script>

	</body>

</html>
