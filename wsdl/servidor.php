<?php

ini_set( "soap.wsdl_cache_enabled", 0 );
ini_set( "soap.wsdl_cache_ttl", 0 );

function agregarProducto( $parametro ) {
	return "Producto agregado: " . $parametro;
}

$servidor = new SoapServer( "consultaprecios.wsdl" );
$servidor->addFunction( "agregarProducto" );
$servidor->handle();

?>