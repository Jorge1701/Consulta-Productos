<?php

require( "clases/producto.php" );

$productos = Producto::listarProductos();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
</head>
<body>

	<a class="link" href="/consultaprecio/promociones.php">Modificar promociones</a>
	<a class="link" href="/consultaprecio/configuracion.php">Modificar configuración</a>

	<div id="contenidoAdmin">
		<?php if ( $productos ) { ?>
			
			<table>
				<tr>
					<th>Imagen</th>
					<th>Código</th>
					<th>Precio</th>
					<th>Moneda</th>
					<th>Descripción</th>
					<th>Marca</th>
					<th>Detalle</th>
					<th>Modificar</th>
				</tr>

				<?php foreach ( $productos as $p ) { ?>

					<tr>
						<td>
							<div class="imagen">
								<img src="<?php echo $p->getImagen(); ?>">
								<img src="<?php echo $p->getImagen(); ?>">
							</div>
						</td>
						<td><?php echo $p->getCodigo(); ?></td>
						<td><?php echo $p->getPrecio(); ?></td>
						<td><?php echo $p->getMoneda() === "1" ? "Pesos" : "Dolares"; ?></td>
						<td><?php echo $p->getDescripcion(); ?></td>
						<td><?php echo $p->getMarca(); ?></td>
						<td><?php echo $p->getDetalle(); ?></td>
						<td><a href="/consultaprecio/modificar.php?codigo=<?php echo $p->getCodigo(); ?>">Modificar</a></td>
					</tr>

				<?php } ?>

			</table>

		<?php } else { ?>

			<div>No hay productos</div>

		<?php } ?>
	</div>
</body>
</html>