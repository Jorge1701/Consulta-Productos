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

	if ( isset( $_FILES["imagen"] ) && !$_FILES["imagen"]["error"] )
		Imagen::subirImagen( "imagenes/productos/", $nuevoCodigo );

	$error = Producto::modificarProductoExistente( $codigo, $nuevoCodigo, $precio, $descripcion, $marca, $detalle, $moneda );

	if ( $error == "OK" )
		header( "Location: /consultaprecio/productos.php?m=Producto modificado" );
}

$producto = Producto::consultarProducto( $_GET["codigo"] );

?>
<!DOCTYPE html>
<html lang="es-UY">
<head>
	<title>Modificar</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="javascript/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/modificarProducto.css">
	<script type="text/javascript" src="javascript/imgMuestra.js"></script>
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">
		<?php if ( $error != "" ) { ?>
			<div class="alert alert-danger">
				<strong>Error!</strong> <?php echo $error; ?>
			</div>
		<?php } ?>

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
						<form method="POST" enctype="multipart/form-data">
							<input type="text" name="codigo" value="<?php echo $producto->getCodigo(); ?>" hidden>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Imagen</span>
									<input id="inputImg" class="form-control" type="file" accept="image/jpg" name="imagen">
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
							<input type="submit" class="btn btn-primary" style="float: right;" value="Modificar">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>