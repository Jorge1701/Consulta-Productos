<?php

require( "clases/producto.php" );

$hayCodigo = isset( $_GET["codigo"] );
$codigo = $hayCodigo ? $_GET["codigo"] : 0;
$producto = $hayCodigo ? Producto::consultarProducto( $codigo ) : NULL;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Consulta de precio</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>

	<div id="producto">
		<div id="precio">
			<?php echo ( $producto ? "$ " . $producto->getPrecio() : "!" ); ?>
		</div>

		<div id="informacion">
			<?php
			if ( $producto ) {
			?>
				<p><?php echo $producto->getDescripcion(); ?></p>
				<p><?php echo $producto->getMarca(); ?></p>
			<?php
			} else {
			?>
				<p class="no-encontrado">Producto no encontrado</p>
			<?php
			}
			?>
		</div>
	</div>

<!--
	<h1>Nombre del local</h1>

	<?php if ( $hayCodigo ) {
		$producto = Producto::consultarProducto( $codigo ); ?>
		
		<div id="producto">

		<?php if ( $producto ) { ?>

			<div>
				<h3 class="titulo">Producto seleccionado</h3>
			</div><div>
				<p class="descripcion"><?php echo $producto->getDescripcion(); ?></p>
				<p class="marca"><?php echo $producto->getMarca(); ?></p>
				<div class="precio">$ <?php echo $producto->getPrecio(); ?></div>
			</div>

		<?php } else { ?>

			<p class="no-encontrado">No se encontró el producto</p>

		<?php } ?>

		</div>
	<?php } else { ?>
	
		<div id="ofertas">
			<h3 class="titulo">Ofertas</h3>
		</div>

	<?php } ?>
-->

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/main.js"></script>
</body>
</html>