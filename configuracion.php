<?php

require( "clases/imagen.php" );
require( "clases/configuracion.php" );

if ( isset( $_FILES["imagen"] ) && !$_FILES["imagen"]["error"] )
	Imagen::subirImagen( "imagenes/", "logo" );

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

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css?<?php echo VERSION; ?>">
	<script src="javascript/jquery.js?<?php echo VERSION; ?>"></script>
	<script src="bootstrap/js/bootstrap.min.js?<?php echo VERSION; ?>"></script>

	<script src="javascript/configuracion.js?<?php echo VERSION; ?>"></script>
	<script src="javascript/imgMuestra.js?<?php echo VERSION; ?>"></script>

	<link rel="stylesheet" type="text/css" href="css/configuracion.css?<?php echo VERSION; ?>">
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Logo actual</div>
					<div class="panel-body">
						<img id="imgMuestra" class="img-thumbnail" src="imagenes/logo.jpg?<?php echo date( "Ymdhis", filemtime( "imagenes/logo.jpg" ) ); ?>">
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Cambiar logo</div>
					<div class="panel-body">
						<form id="form" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Imagen</span>
									<input id="inputImg" class="form-control" type="file" name="imagen" accept="image/jpg">
								</div>
							</div>
							<button id="enviarForm" class="btn btn-primary" type="button" style="float: right;">Cargar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
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