<?php

require( "clases/producto.php" );

// Cantidad de páginas que se muestran al lado de la página actual en la paginación
$mostrarPaginas = 2;
// Productos Por Página
$ppp = 20;
// Página
$p = 1;

if ( isset( $_GET["p"] ) )
	$p = intval( $_GET["p"] );

// Busqueda
$b = NULL;

if ( isset( $_GET["b"] ) )
	$b = $_GET["b"];

$productos = Producto::listarProductos( ( $p - 1 ) * $ppp, $ppp, $b );
$cantPaginas = Producto::cantPaginas( $ppp, $b );

// Mensaje
$m = isset( $_GET["m"] ) ? $_GET["m"] : "";
// Error
$e = isset( $_GET["e"] ) ? $_GET["e"] : "";

?>
<!DOCTYPE html>
<html lang="es-UY">
<head>
	<title>Productos</title>

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

	<link rel="stylesheet" type="text/css" href="css/productos.css?<?php echo VERSION; ?>">
</head>
<body>

	<?php require( "cabecera.php" ); ?>

	<div class="container">

		<?php if ( $m != "" ) { ?>
			<div class="alert alert-success">
				<strong>Ok!</strong> <?php echo $m; ?>
			</div>
		<?php } ?>

		<?php if ( $e != "" ) { ?>
			<div class="alert alert-danger">
				<strong>Error!</strong> <?php echo $e; ?>
			</div>
		<?php } ?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<form class="form-inline">
					<div class="input-group">
						<input type="text" class="form-control" name="b" placeholder="Búsqueda" value="<?php echo isset( $b ) ? $b : ""; ?>">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-body">
				<?php if ( $productos ) { ?>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Imagen</th>
									<th>Código</th>
									<th>Precio</th>
									<th>Descripción</th>
									<th>Marca</th>
									<th>Detalle</th>
									<th>Modificar</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $productos as $prod ) { ?>
									<tr>
										<td>
											<div class="imagen">
												<?php $fecha = date( "Ymdhis", filemtime( $prod->getImagen() ) ); ?>
												<img src="<?php echo $prod->getImagen() . "?" . $fecha; ?>">
												<img class="img-thumbnail" src="<?php echo $prod->getImagen() . "?" . $fecha; ?>">
											</div>
										</td>
										<td><?php echo $prod->getCodigo(); ?></td>
										<td><?php echo ( $prod->getMoneda() == "1" ? "$ " : "USD " ) .$prod->getPrecio(); ?></td>
										<td><?php echo $prod->getDescripcion(); ?></td>
										<td><?php echo $prod->getMarca(); ?></td>
										<td><?php echo $prod->getDetalle(); ?></td>
										<td><a class="btn btn-primary" href="/consultaprecio/modificar.php?codigo=<?php echo $prod->getCodigo(); ?>">Modificar</a></th>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
					<div class="alert alert-info">
						<strong>No se encontraron productos</strong>
					</div>
				<?php } ?>
			</div>
			<?php if ( $productos ) { ?>
				<div class="panel-footer" style="text-align: center">
					<ul class="pagination">
						<?php if ( $p != 1 ) { ?>
							<li><a href="/consultaprecio/productos.php?p=1<?php echo isset( $b ) ? "&b=" . $b : ""; ?>"><<</a></li>
						<?php } ?>

						<?php for ( $i = $p - $mostrarPaginas; $i <= $p + $mostrarPaginas; $i++ ) { ?>
							<?php if ( $i <= 0 || $i > $cantPaginas ) continue; ?>
							<li class="<?php echo $p == $i ? "active" : ""; ?>"><a href="/consultaprecio/productos.php?p=<?php echo $i; ?><?php echo isset( $b ) ? "&b=" . $b : ""; ?>"><?php echo $i; ?></a></li>
						<?php } ?>

						<?php if ( $p != $cantPaginas ) { ?>
							<li><a href="/consultaprecio/productos.php?p=<?php echo $cantPaginas; ?><?php echo isset( $b ) ? "&b=" . $b : ""; ?>">>></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</div>
	</div>

</body>
</html>