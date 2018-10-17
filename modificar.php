<?php

require( "clases/producto.php" );
require( "clases/imagen.php" );

$error = "";

if ( isset( $_POST["nuevoCodigo"] ) ) {
	$codigo = $_POST["codigo"];

	$nuevoCodigo = $_POST["nuevoCodigo"];
	$precio = $_POST["precio"];
	$moneda = $_POST["moneda"];
	$descripcion = $_POST["descripcion"];
	$marca = $_POST["marca"];
	$detalle = $_POST["detalle"];

	if ( isset( $_FILES["imagen"] ) && !$_FILES["imagen"]["error"] ) {
		$error = Imagen::subirImagen( "imagenes/productos/", $nuevoCodigo );

		if ( $error != "OK" )
			header( "Location: /consultaprecio/productos.php?e=" . $error );
	}

	$error = Producto::modificarProductoExistente( $codigo, $nuevoCodigo, $precio, $descripcion, $marca, $detalle, $moneda );

	if ( $error == "OK" )
		header( "Location: /consultaprecio/productos.php?m=Producto modificado" );
} else if ( isset( $_POST["borrar"] ) ) {
	unlink( $_POST["borrar"] );
	header( "Location: /consultaprecio/productos.php?m=Imagen eliminada" );
}

$producto = Producto::consultarProducto( $_GET["codigo"] );

?>
<!DOCTYPE html>
<html lang="es-UY">
<head>
	<title>Modificar</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css?<?php echo VERSION; ?>">
	<script src="javascript/jquery.js?<?php echo VERSION; ?>"></script>
	<script src="bootstrap/js/bootstrap.min.js?<?php echo VERSION; ?>"></script>

	<link rel="stylesheet" type="text/css" href="css/modificarProducto.css?<?php echo VERSION; ?>">
	<script type="text/javascript" src="javascript/imgMuestra.js?<?php echo VERSION; ?>"></script>
	<script type="text/javascript" src="javascript/validateImgForm.js?<?php echo VERSION; ?>"></script>
	<script type="text/javascript" src="javascript/modificar.js?<?php echo VERSION; ?>"></script>
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Imagen</div>
					<div class="panel-body">
						<img id="imgMuestra" src="<?php echo $producto->getImagen(); ?>" alt="Imagen del producto">
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Modificar producto</div>
					<div class="panel-body">
						<form id="form" method="POST" enctype="multipart/form-data">
							<input type="text" name="codigo" value="<?php echo $producto->getCodigo(); ?>" hidden>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Imagen</span>
									<input id="inputImg" class="form-control" type="file" name="imagen" accept="image/jpg">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Código</span>
									<input class="form-control" type="text" name="nuevoCodigo" value="<?php echo $producto->getCodigo(); ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Moneda</span>
									<select class="form-control" name="moneda">
										<option value="1" <?php echo $producto->getMoneda() === "1" ? "selected" : "" ?>>Pesos</option>
										<option value="2" <?php echo $producto->getMoneda() === "2" ? "selected" : "" ?>>Dolares</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Precio</span>
									<input class="form-control" type="text" name="precio" value="<?php echo $producto->getPrecio(); ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Descripción</span>
									<input class="form-control" type="text" name="descripcion" value="<?php echo $producto->getDescripcion(); ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Marca</span>
									<input class="form-control" type="text" name="marca" value="<?php echo $producto->getMarca(); ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Detalle</span>
									<input class="form-control" type="text" name="detalle" value="<?php echo $producto->getDetalle(); ?>">
								</div>
							</div>
							<button id="enviarForm" type="button" class="btn btn-primary" style="float: right;">Modificar</button>
						</form>
						<form id="formBorrar" method="POST">
							<input type="text" name="borrar" value="<?php echo $producto->getImagen(); ?>" hidden>

							<?php if ( $producto->getImagen() !== "imagenes/logo.jpg" ) { ?>
								<button id="borrarImagen" type="button" class="btn btn-danger" style="float: left;">Borrar imagen</button>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>