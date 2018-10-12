<?php

require( "clases/producto.php" );
require( "clases/imagen.php" );

$modificado = "";

if ( isset( $_POST["nuevoCodigo"] ) ) {
	$codigo = $_POST["codigo"];

	$nuevoCodigo = $_POST["nuevoCodigo"];
	$precio = $_POST["precio"];
	$descripcion = $_POST["descripcion"];
	$marca = $_POST["marca"];
	$detalle = $_POST["detalle"];
	$moneda = $_POST["moneda"];
	$imagen = $_POST["viejaImagen"];

	if ( isset( $_FILES["imagen"] ) && !$_FILES["imagen"]["error"] ) {
		$estado = Imagen::subirImagen( "imagenes/productos/", $nuevoCodigo, ".jpg" );

		if ( $estado === "OK" )
			$imagen = "imagenes/productos/" . basename( $_FILES["imagen"]["name"] );
		else
			$modificado = $estado;
	}

	$modificado = Producto::modificarProductoExistente( $codigo, $nuevoCodigo, $precio, $descripcion, $marca, $detalle, $moneda, $imagen );

	if ( $modificado == "OK" )
		header( "Location: /consultaprecio/productos.php" );
}

$hayCodigo = isset( $_GET["codigo"] );
$codigo = $hayCodigo ? $_GET["codigo"] : 0;
$producto = $hayCodigo ? Producto::consultarProducto( $codigo ) : NULL;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar</title>
	<?php require( "estilos.php" );?>
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
	<link rel="stylesheet" type="text/css" href="css/modificarProducto.css">
</head>
<body>

	<div id="menu">
		<a class="link" href="/consultaprecio/productos.php">Modificar productos</a>
		<a class="link" href="/consultaprecio/promociones.php">Modificar promociones</a>
		<a class="link" href="/consultaprecio/configuracion.php">Modificar configuración</a>
	</div>

	<div id="contenidoModif">

		<?php if ( $producto ) { ?>

			<div id="imgMuestra">
				<img id="imgMuestra" src="<?php echo $producto->getImagen(); ?>">
			</div>

			<div id="formModif">

				<h2>Modificar producto</h2>

				<form method="POST" enctype="multipart/form-data">
					<input type="text" name="codigo" value="<?php echo $producto->getCodigo(); ?>" hidden>
					<input type="text" name="viejaImagen" value="<?php echo $producto->getImagen(); ?>" hidden>
					<div>
						<label for="imagen">Imagen</label>
						<input id="inputImg" type="file" accept="image/*" name="imagen">
					</div>
					<div>
						<label for="nuevoCodigo">Código</label>
						<input type="text" name="nuevoCodigo" value="<?php echo $producto->getCodigo(); ?>">
					</div>
					<div>
						<label for="precio">Precio</label>
						<input type="text" name="precio" value="<?php echo $producto->getPrecio(); ?>">
					</div>
					<div>
						<label for="precio">Moneda</label>
						<select name="moneda">
							<option value="1" <?php echo $producto->getMoneda() === "1" ? "selected" : "" ?>>Pesos</option>
							<option value="2" <?php echo $producto->getMoneda() === "2" ? "selected" : "" ?>>Dolares</option>
						</select>
					</div>
					<div>
						<label for="descripcion">Descripción</label>
						<input type="text" name="descripcion" value="<?php echo $producto->getDescripcion(); ?>">
					</div>
					<div>
						<label for="marca">Marca</label>
						<input type="text" name="marca" value="<?php echo $producto->getMarca(); ?>">
					</div>
					<div>
						<label for="detalle">Detalle</label>
						<input type="text" name="detalle" value="<?php echo $producto->getDetalle(); ?>">
					</div>
					<div>
						<input type="submit" value="Modificar">
					</div>
				</form>

			</div>

		<?php } else { ?>

			<div>El producto no existe</div>

		<?php } ?>

	</div>

	<?php if ( $modificado !== "" ) { ?>
		<script type="text/javascript"> alert( "Modificación: <?php echo $modificado; ?>" ); </script>
	<?php } ?>

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/modificarProducto.js"></script>
</body>
</html>