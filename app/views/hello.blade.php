<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Invitación: Casamiento Alejandra y Cristian</title>
		<link href="{{ asset('assets/styles/styles.css') }}" rel="stylesheet">
	</head>

	<body>

		<div id="skrollr-body">
			@include('welcome')
			@include('location')
			@include('party')
		</div>


		@if ( App::environment('local') )
		<script src="//localhost:3100/livereload.js"></script>
		@endif
		<script src="{{ asset('assets/scripts/script.min.js'); }}"></script>
	</body>
</html>
