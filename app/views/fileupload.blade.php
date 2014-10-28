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
				<button class="btn btn-primary btn-lg pull-right" onclick="$('.dz-clickable').click()">Agregar Fotos</button>
				<button class="btn btn-default btn-lg pull-right" style="margin-right: 20px;">Ver fotos ya subidas</button>
				{{ HTML::image('assets/images/aleycris_small.png') }}
			</header>
			<class class="dropzone-container">
				<form action="{{ url('fotos/' . $invite_id ) }}" class="dropzone">
				  <div class="fallback">
				    <input name="file" type="file" multiple />
				  </div>
				</form>
			</class>
		</section>
		@if ( App::environment('local') )
		<script src="//localhost:3100/livereload.js"></script>
		@endif
		<script src="{{ asset('assets/scripts/script.min.js'); }}"></script>
	</body>
</html>
