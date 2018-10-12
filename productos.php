<?php

require( "clases/producto.php" );

$productosPorPagina = 25;
$p = 0;
$pagina = 0;

if ( isset( $_GET["p"] ) ) {
	$pagina = ( intval( $_GET["p"] ) - 1 );
	$p = $pagina * $productosPorPagina;
}
$pagina++;

$productos = NULL;

$b = NULL;

if ( isset( $_GET["b"] ) && $_GET["b"] != "" )
	$b = $_GET["b"];

$productos = Producto::listarProductos( $p, $productosPorPagina, $b );

$cantPaginas = Producto::cantPaginas( $productosPorPagina, $b );

?>
<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>
	<?php require( "estilos.php" );?>
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
	<link rel="stylesheet" type="text/css" href="css/productos.css">
</head>
<body>

	<div id="menu">
		<span>Productos</span>
		<a class="link" href="/consultaprecio/promociones.php">Promociones</a>
		<a class="link" href="/consultaprecio/configuracion.php">Configuración</a>
	</div>

	<div id="contenidoAdmin">
		<?php if ( $productos ) { ?>

			<div id="buscador">
				<form method="GET">
					<input type="te" name="p" value="1" hidden>
					<input type="text" name="b" value="<?php echo isset( $b ) ? $b : "";?>">
					<input type="submit" value="Buscar">
				</form>
			</div>

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

			<div id="paginas">

				<?php if ( $pagina != 1 ) { ?>
					<a href="/consultaprecio/productos.php?p=1<?php echo ( isset( $b ) ? "&b=" . $b : "" ); ?>" class="pagPrimera">Primera</a>
				<?php } ?>

				<?php for ( $i = ( $pagina - 3 ); $i <= ( $pagina + 3 ); $i++ ) { ?>
					<?php if ( $i <= 0 || $i > $cantPaginas ) continue; ?>
					<a href="/consultaprecio/productos.php?p=<?php echo $i . ( isset( $b ) ? "&b=" . $b : "" ); ?>" <?php if ( $i == $pagina ) echo "class=\"pagActual\""; ?>><?php echo $i; ?></a>
				<?php } ?>

				<?php if ( $pagina != $cantPaginas ) { ?>
					<a href="/consultaprecio/productos.php?p=<?php echo $cantPaginas . ( isset( $b ) ? "&b=" . $b : "" ); ?>" class="pagUltima">Última</a>
				<?php } ?>

			</div>

		<?php } else { ?>

			<div>No hay productos. <button onclick="window.history.back()">Volver</button></div>

		<?php } ?>
	</div>
</body>
</html>