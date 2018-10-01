<?php

require( "clases/config.php" );
require( "clases/producto.php" );

$hayCodigo = isset( $_GET["codigo"] );
$codigo = $hayCodigo ? $_GET["codigo"] : 0;
$producto = $hayCodigo ? Producto::consultarProducto( $codigo ) : NULL;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Consulta de precio</title>
	<link rel="stylesheet" type="text/css" href="slick/slick.css">
	<style type="text/css">
		:root {
			--col-fondo: <?php echo color_fondo; ?>;

			/* Promociones */
			--promo-alto-titulo: 8vh;
			--promo-separacion: 2vw;
			--promo-titulo-tam-letra: 6vh;

			--promo-col-fondo: white;
			--promo-col-letra: black;





			--col-precio: <?php echo color_precio; ?>;
			--col-letra-precio: <?php echo color_letra_precio; ?>;

			--col-b: white;
			--col-info-prod: <?php echo color_informacion_producto; ?>;

			--tam-precio: 30vw;
			--tam-info: 35vw;
			--info-margin: 10vw;

			--promo-margin: 5vw;
			--promo-ancho: calc(100vw - calc(var(--promo-margin) * 2));
			--promo-alto: calc(100vh - calc(var(--promo-margin) * 2));

			--promo-padding: 2vw;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
</head>
<body>

	<?php if ( $hayCodigo ) { ?>

		<div id="precio"><?php echo $producto ? "$ " . $producto->getPrecio() : "Ups!"; ?></div>
		<div id="informacion">
			<h3>PRODUCTO</h3>
			<div>
				<p id="descripcion"><?php echo $producto ?  $producto->getDescripcion() : "No encontrado"; ?></p>
				<p id="marca"><?php echo $producto ? $producto->getMarca() : ""; ?></p>
			</div>
		</div>

	<?php } else { ?>

		<h2 id="titulo_promo">Consultar precio</h2>
		<div id="promociones">
			<?php $archivos = scandir( "imagenes/promociones" ) ?>
			<?php for ( $i = 2; $i < count( $archivos ); $i++ ) { ?>
				<img src="imagenes/promociones/<?php echo $archivos[$i]; ?>">
			<?php } ?>
		</div>

	<?php } ?>

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="slick/slick.js"></script>
	<script type="text/javascript">
		let tiempoProducto = <?php echo tiempo_producto; ?>;
		let tiempoPromocion = <?php echo tiempo_promocion; ?>;
	</script>
	<script type="text/javascript" src="javascript/main.js"></script>
</body>
</html>