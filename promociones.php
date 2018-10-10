<?php

require( "clases/imagen.php" );

if ( isset( $_FILES["imagen"] ) && !$_FILES["imagen"]["error"] )
	Imagen::subirImagen( "imagenes/promociones/", basename( $_FILES["imagen"]["name"] ), "" );

if ( isset( $_POST["borrar"] ) )
	unlink( "imagenes/promociones/" . $_POST["borrar"] );

?>
<!DOCTYPE html>
<html>
<head>
	<title>Promociones</title>
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
	<link rel="stylesheet" type="text/css" href="css/promociones.css">
</head>
<body>

	<div id="menu">
		<a class="link" href="/consultaprecio/productos.php">Modificar productos</a>
		<span>Modificar promociones</span>
		<a class="link" href="/consultaprecio/configuracion.php">Modificar configuración</a>
	</div>

	<div id="contenidoAdmin">
		<?php $archivos = scandir( "imagenes/promociones" ) ?>

		<div id="nuevaPromo">
			<h2>Nueva promoción</h2>
			<img id="imgMuestra" src="">
			<form method="POST" enctype="multipart/form-data">
				<label for="imagen">Imagen</label>
				<input id="inputImg" type="file" accept="image/*" name="imagen">
				<br>
				<br>

				<input type="submit" value="Cargar">
			</form>
			<br>
			<br>
			<br>
			<p>Click en una promoción existente para borrarla.</p>
		</div>

		<?php if ( count( $archivos ) > 2 ) { ?>

			<div id="promos">

				<?php for ( $i = 2; $i < count( $archivos ); $i++ ) { ?>

					<img src="imagenes/promociones/<?php echo $archivos[$i]; ?>" onclick="borrarImagen( '<?php echo $archivos[$i]; ?>', <?php echo $i; ?> )">
					<form method="POST" id="borrar<?php echo $i; ?>" hidden>
						<input type="text" name="borrar" value="<?php echo $archivos[$i]; ?>">
					</form>

				<?php } ?>

			</div>

		<?php } else { ?>

			<div>No hay promociones</div>

		<?php } ?>
	</div>

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/modificarProducto.js"></script>
	<script type="text/javascript" src="javascript/promociones.js"></script>
</body>
</html>