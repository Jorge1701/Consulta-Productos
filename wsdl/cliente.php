<?php

$cliente = new SoapClient( "http://localhost/consultaproductos/wsdl/consultaprecios.wsdl" );

try {

	$respuesta = $cliente->agregarProducto( "Nuevo" );
	echo $respuesta;

} catch ( SoapFault $sf ) {
	echo $sf->getMessage();
}

?>