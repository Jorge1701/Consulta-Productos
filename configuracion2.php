<?php

require( "clases/configuracion.php" );

$valores = array_keys( $_POST );

if ( count( $valores ) > 0 )
	foreach ( $valores as $v )
		Configuracion::actualizar( $v, $_POST[$v] );

if ( isset( $_POST["default"] ) )
	Configuracion::cargarDefault();

$params = Configuracion::cargar();

?>
<!DOCTYPE html>
<html lang="es-UY">
<head>
	<title>Configuración</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="javascript/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		span.input-group-addon {
			width: 100%;
			text-align: left;
		}

		input.form-control {
			display: block;
			width: 150px !important;
		}
	</style>
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">
		<form id="guardar" method="POST">
			<?php foreach ( $params as $p ) { ?>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><?php echo $p->getDescripcion(); ?></span>
						<input class="form-control" type="" name="">
					</div>
				</div>
			<?php } ?>

			<button id="btnGuardar" type="button" class="btn btn-primary">Guardar cambios</button>
		</form>
	</div>

</body>
</html>