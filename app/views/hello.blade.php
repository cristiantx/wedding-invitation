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
			<header class="navigation-container">
				<ul>
					<li><a href="#place">El lugar</a></li>
					<li><a href="#party">La fiesta</a></li>
					<li class="logo">{{ HTML::image('assets/images/anillos.png'); }}</li>
					<li><a href="#gift">El regalo</a></li>
					<li><a href="#rsvp">Asistencia</a></li>
				</ul>
			</header>
			@include('welcome')
			@include('location')
			@include('party')
			@include('gift')
			@if( count($invites) > 0 )
				@include('rsvp', array('invites' => $invites ))
			@endif
		</div>


		@if ( App::environment('local') )
		<script src="//localhost:3100/livereload.js"></script>
		@endif
		<script src='https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js'></script>
		<script src="{{ asset('assets/scripts/script.min.js'); }}"></script>
	</body>
</html>
