<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="assets/styles/mail.css">
	</head>
	<body>
		<div>
			<table class="container radius">
				<tr>
					<td class="content center">
						<table>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td>
									<h3 class="center">Fotos del Casamiento de</h3>
									<img src="{{ $images[0] }}" class="ayc center" alt="Alejandra y Cristian" />
									<p>Ya pasó la fecha, y la pasamos genial! Muchas Gracias a todos por compartir este momento tan especial con nosotros.</p>
									<p>Ahora les vamos a pedir el último favor, y es que suban las fotos que hayan sacado haciendo click en el botón a continuación.</p>
									<p>¡¡Millones Gracias!!</p>
									<hr>
									<p>
										<table class="medium-button">
											<tr>
												<td><a href="http://alejandraycristian.com/fotos/{{ $invite_id }}" class="callout">Subir mis fotos</a></td>
											</tr>
										</table>
									</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
