<?php

require_once( "clases/configuracion.php" );

$valores = array_keys( $_POST );

if ( count( $valores ) > 0 ) {
	foreach ( $valores as $v )
		Configuracion::actualizar( $v, $_POST[$v] );
}

if ( isset( $_POST["default"] ) )
	configuracion::cargarDefault();

$params = Configuracion::cargar();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Configuracion</title>
	<link rel="stylesheet" type="text/css" href="css/stylehseet.css">
	<link rel="stylesheet" type="text/css" href="css/configuracion.css">
</head>
<body>

	<div id="menu">
		<a class="link" href="/consultaprecio/productos.php">Modificar productos</a>
		<a class="link" href="/consultaprecio/promociones.php">Modificar promociones</a>
		<span>Modificar configuración</span>
	</div>

	<div id="parametros">
		<form id="cargar" method="POST">
			<input type="text" name="default" hidden>
			<button id="btnCargar" type="button">Cargar configuración por defecto</button>
		</form>
		<hr>
		<form id="guardar" method="POST">
			<table>
				<tbody>
					<tr>
						<th>Descripción</th>
						<th>Valor</th>
					</tr>
					<?php foreach ( $params as $p ) { ?>
						<tr>
							<td><?php echo $p->getDescripcion(); ?></td>
							<td><input type="text" name="<?php echo $p->getNombre(); ?>" value="<?php echo $p->getValor(); ?>"></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<button id="btnGuardar" type="button">Guardar cambios</button>
		</form>
	</div>

	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/configuracion.js"></script>
</body>
</html>