<?php

require( "../clases/producto.php" );

ini_set( "soap.wsdl_cache_enabled", 0 );
ini_set( "soap.wsdl_cache_ttl", 0 );

function modificarProducto( $codigo, $precio, $descripcion, $marca, $detalle ) {
	return Producto::modificarProducto( $codigo, $precio, $descripcion, $marca, $detalle );
}

function borrarProducto( $codigo ) {
	return Producto::borrarProducto( $codigo );
}

function llenarProductos( $csv ) {
	return Producto::llenarProductos( $csv );
}

$servidor = new SoapServer( "consultaprecios.wsdl" );
$servidor->addFunction( "modificarProducto" );
$servidor->addFunction( "borrarProducto" );
$servidor->addFunction( "llenarProductos" );
$servidor->handle();

?>