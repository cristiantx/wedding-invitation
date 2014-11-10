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
		<section class="file-upload">
			<header>
				<a class="btn btn-primary btn-lg pull-right" href="{{ url("/fotos/{$invite_id}") }}">Volver</a>
				{{ HTML::image('assets/images/aleycris_small.png') }}
			</header>
			<class class="thumbs-container">
				@if( count($files) > 0 )
				<ul>
					@foreach($files as $file)
					<li><img src="{{ $file['thumb'] }}"></li>
					@endforeach
				</ul>
				@else
				<h2>Aún no subiste ninguna foto.</h2>
				@endif
			</class>
		</section>
		@if ( App::environment('local') )
		<script src="//localhost:3100/livereload.js"></script>
		@endif
		<script src="{{ asset('assets/scripts/script.min.js'); }}"></script>
	</body>
</html>
