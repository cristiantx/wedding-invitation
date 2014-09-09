<!DOCTYPE html>
<html lang="es">
		<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<title>Administrador: Casamiento Alejandra y Cristian</title>
				<link href="{{ asset('assets/styles/admin.css') }}" rel="stylesheet">
		</head>

		<body>
				<div class="container-fluid">

					<div class="navbar navbar-default" role="navigation">
						<div class="container-fluid">
							<div class="navbar-header">
								<a class="navbar-brand" href="#">Casamiento</a>
							</div>
								<ul class="nav navbar-nav">
									<li><a href="/invitados">Invitados</a></li>
									<li><a href="/invitaciones">Estado Invitaciones</a></li>
									<li><a href="/invitados/lista">Lista de Invitados</a></li>
								</ul>
						</div><!--/.container-fluid -->
					</div>

					<!-- Main component for a primary marketing message or call to action -->
					<div class="content">
						@yield('content')
					</div>

				</div> <!-- /container -->
				<script src="{{ asset('assets/scripts/invitados.min.js'); }}"></script>
		</body>
</html>
