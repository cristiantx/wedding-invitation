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
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">Casamiento</a>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li><a href="/invitados">Invitados</a></li>
									<li><a href="/invitaciones">Invitaciones</a></li>
								</ul>
							</div><!--/.nav-collapse -->
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
