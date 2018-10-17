<?php

require( "clases/imagen.php" );

if ( isset( $_POST["borrar"] ) )
	if ( file_exists( "imagenes/promociones/" . $_POST["borrar"] ) )
		unlink( "imagenes/promociones/" . $_POST["borrar"] );

if ( isset( $_FILES["imagen"] ) && !$_FILES["imagen"]["error"] )
	Imagen::subirImagen( "imagenes/promociones/", time() );

?>
<!DOCTYPE html>
<html lang="es-UY">
<head>
	<title>Promociones</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="javascript/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/promociones.css">
	<script type="text/javascript" src="javascript/imgMuestra.js"></script>
	<script type="text/javascript" src="javascript/validateImgForm.js"></script>
	<script type="text/javascript" src="javascript/promociones.js"></script>
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Nueva promoción</div>
					<div class="panel-body">
						<img id="imgMuestra" src="" class="img-thumbnail" style="display: none">
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
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Promociones existentes</div>
					<div class="panel-body">
						<?php $promos = scandir( "imagenes/promociones" ); ?>

						<?php if ( count( $promos ) > 2 ) { ?>
							<div class="row">
								<?php for( $i = 2; $i < count( $promos); $i++ ) { ?>
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="panel panel-default">
											<div class="panel-body">
												<img src="imagenes/promociones/<?php echo $promos[$i]; ?>">
											</div>
											<div class="panel-footer">
												<form id="borrar<?php echo $i; ?>" method="POST">
													<input type="text" name="borrar" value="<?php echo $promos[$i]; ?>" hidden>
												</form>
												<button class="btn btn-danger" style="float: right;" onclick="borrarPromo( <?php echo $i; ?> )">Borrar</button>
												<span style="display: block; clear: both;"></span>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } else { ?>
							<div class="alert alert-warning">
								<strong>No hay promociones</strong>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>