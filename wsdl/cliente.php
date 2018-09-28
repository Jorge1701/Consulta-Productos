<?php

$cliente = new SoapClient( "http://localhost/consultaprecio/wsdl/consultaprecios.wsdl" );

try {

	echo "<h2>Agregar</h2>";
	echo $cliente->modificarProducto( "clave", "1", 1, "Producto 1", "Marca 1", "Detalle 1" ) . "<br>";
	echo $cliente->modificarProducto( "clave", "2", 2, "Producto 4", "Marca 1", "Detalle 2" ) . "<br>";
	echo $cliente->modificarProducto( "clave", "2", 2, "Producto 2", "Marca 1", "Detalle 2" ) . "<br>";
	echo $cliente->modificarProducto( "clave", "3", 3, "Producto 3", "Marca 1", "Detalle 3" ) . "<br>";
	echo $cliente->modificarProducto( "clave", "10", 3, "Producto 3", "Marca 1", "Detalle 3" ) . "<br>";
	echo $cliente->modificarProducto( "clave", "3", 10.5, "Producto 3", "Marca 1", "Detalle 3" ) . "<br>";

	echo "<h2>Llenar</h2>";
	echo $cliente->llenarProductos( "clave", file_get_contents( "productos.csv" ) );

	if ( true ) {
		echo "<h2>Borrar</h2>";
		echo $cliente->borrarProducto( "clave", "1" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "2" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "3" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "4" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "5" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "54" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "354" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "6" ) . "<br>";
		echo $cliente->borrarProducto( "clave", "10" ) . "<br>";
	}

} catch ( Exception $sf ) {
	echo "<br><br>" . $sf->getMessage();
}

?>