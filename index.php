<?php

$timezone = "America/Montevideo";
date_default_timezone_set($timezone);

require( "config/config.php" );
require( "clases/configuracion.php" );
require( "clases/producto.php" );

$hayCodigo = isset( $_GET["codigo"] );
$codigo = $hayCodigo ? $_GET["codigo"] : 0;
$producto = $hayCodigo ? Producto::consultarProducto( $codigo ) : NULL;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consulta de precio</title>
	<?php require( "estilos.php" );?>
	<link rel="stylesheet" type="text/css" href="slick/slick.css">
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
</head>
<body>

	<img id="institucional" src="imagenes/byg-institucional-slim.png">

	<?php if ( $hayCodigo ) { file_put_contents(date('Ym').'-log.txt', date('dHis').','.$codigo.PHP_EOL,FILE_APPEND);  ?>

		<div id="precio"><?php echo $producto ? ( $producto->getMoneda() === "2" ? "USD " : "$ " ) . round( $producto->getPrecio() ) : "---"; ?></div>
		<img id="infoImg" src="<?php echo $producto && mostrar_imagen == "si" ? $producto->getImagen() : 'imagenes/logo.jpg'; ?>">
		<div id="informacion">
			<div>
				<p id="descripcion"><?php echo $producto ?  $producto->getDescripcion() : texto_no_encontrado; ?></p>
				<p id="marca"><?php echo $producto ? $producto->getMarca() : ""; ?></p>
			</div>
		</div>

	<?php } else { ?>

		<img id="img_logo" src="imagenes/logo.jpg">
		<p id="titulo_promo"><?php echo texto_titulo_inicio; ?></p>

		<div id="promociones">
			<img src="imagenes/logo.jpg">
			<?php $archivos = scandir( "imagenes/promociones" ); ?>
			<?php for ( $i = 2; $i < count( $archivos ); $i++ ) { ?>
				<img src="imagenes/promociones/<?php echo $archivos[$i]; ?>">
			<?php } ?>
		</div>

	<?php } ?>

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="slick/slick.js"></script>
	<script type="text/javascript">
		<?php if ( isset( $archivos ) ) { ?>
			let aMostrar = <?php echo count( $archivos ) >= 5 ? 3 : 1; ?>;
		<?php } ?>
		let tiempoProducto = <?php echo tiempo_producto; ?>;
		let tiempoPromocion = <?php echo tiempo_promocion; ?>;
	</script>
	<script type="text/javascript" src="javascript/main.js"></script>

	<script type="text/javascript"> hayCodigo = <?php echo $hayCodigo ? "true" : "false"; ?>; </script>

	<?php if ( $producto ) { ?>
		<script type="text/javascript">
			mostrarPrecio();
			<?php if ( voz == "si" ) { ?>
				decirPrecio( <?php echo $producto->getPrecio(); ?>, "<?php echo $producto->getMoneda() === "1" ? "pesos" : "dolares"; ?>" );
			<?php } ?>
		</script>
	<?php } ?>
</body>
</html>