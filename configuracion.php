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

	<script src="javascript/configuracion.js"></script>

	<link rel="stylesheet" type="text/css" href="css/configuracion.css">
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<span>Configuración</span>
				<form id="cargar" method="POST" class="form-inline fr" style="display: inline-block;">
					<input type="text" name="default" hidden>
					<button id="btnCargar" type="button" class="btn btn-default fr">Cargar configuración por defecto</button>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<form id="guardar" method="POST">
					<?php foreach ( $params as $p ) { ?>
						<div class="panel panel-default">
							<div class="panel-heading"><?php echo $p->getDescripcion(); ?></div>
							<div class="panel-body">
								<?php if ( $p->getTipo() === "decimal" ) { ?>
									<input class="form-control fr2" type="number" step="0.1" min="0" name="<?php echo $p->getNombre(); ?>" value="<?php echo $p->getValor(); ?>">
								<?php } else if ( $p->getTipo() === "number" ) { ?>
									<input class="form-control fr2" type="number" min="0" name="<?php echo $p->getNombre(); ?>" value="<?php echo $p->getValor(); ?>">
								<?php } else { ?>
									<input class="form-control fr2" type="<?php echo trim( $p->getTipo() ); ?>" name="<?php echo $p->getNombre(); ?>" value="<?php echo $p->getValor(); ?>">
								<?php } ?>
							</div>
						</div>
					<?php } ?>

					<button id="btnGuardar" type="button" class="btn btn-primary fr">Guardar cambios</button>
				</form>
			</div>
		</div>
	</div>

</body>
</html>