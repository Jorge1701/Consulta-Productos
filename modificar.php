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
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
</head>
<body>

	<div id="contenidoModif">

		<?php if ( $producto ) { ?>

			<div>
				<img id="imgMuestra" src="<?php echo $producto->getImagen(); ?>">
			</div>

			<h2>Modificar producto</h2>

			<form method="POST" enctype="multipart/form-data">
				<input type="text" name="codigo" value="<?php echo $producto->getCodigo(); ?>" hidden>
				<input type="text" name="viejaImagen" value="<?php echo $producto->getImagen(); ?>" hidden>
				<label for="imagen">Imagen</label>
				<input id="inputImg" type="file" accept="image/*" name="imagen">
				<br>
				<label for="nuevoCodigo">Código</label>
				<input type="text" name="nuevoCodigo" value="<?php echo $producto->getCodigo(); ?>">
				<br>
				<label for="precio">Precio</label>
				<input type="text" name="precio" value="<?php echo $producto->getPrecio(); ?>">
				<br>
				<label for="precio">Moneda</label>
				<select name="moneda">
					<option value="1" <?php echo $producto->getMoneda() === "1" ? "selected" : "" ?>>Pesos</option>
					<option value="2" <?php echo $producto->getMoneda() === "2" ? "selected" : "" ?>>Dolares</option>
				</select>
				<br>
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" value="<?php echo $producto->getDescripcion(); ?>">
				<br>
				<label for="marca">Marca</label>
				<input type="text" name="marca" value="<?php echo $producto->getMarca(); ?>">
				<br>
				<label for="detalle">Detalle</label>
				<input type="text" name="detalle" value="<?php echo $producto->getDetalle(); ?>">
				<br>
				<input type="submit" value="Modificar">
			</form>

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