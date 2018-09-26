<?php

$cliente = new SoapClient( "http://localhost/consultaprecio/wsdl/consultaprecios.wsdl" );

try {

	/*echo $cliente->agregarProducto( "1234500", "Producto 5", "Marca 1", "asd" );
	echo $cliente->modificarProducto( "1234568", "Producto 2", "Marca 2", 15 );
	echo $cliente->borrarProducto( "1234569" );*/

} catch ( SoapFault $sf ) {
	echo $sf->getMessage();
}

?>