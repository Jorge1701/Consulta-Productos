<?php

require_once( "../clases/config.php" );
require( "../clases/producto.php" );

ini_set( "soap.wsdl_cache_enabled", 0 );
ini_set( "soap.wsdl_cache_ttl", 0 );

function modificarProducto( $clave, $codigo, $precio, $descripcion, $marca, $detalle ) {
	if ( $clave != WSDL_CLAVE )
		return "Error: Clave incorrecta";
	
	try {
		return Producto::modificarProducto( $codigo, $precio, $descripcion, $marca, $detalle );
	} catch ( Exception $e ) {
		return $e->getMessage();
	}
}

function borrarProducto( $clave, $codigo ) {
	if ( $clave != WSDL_CLAVE )
		return "Error: Clave incorrecta";
	
	try {
		return Producto::borrarProducto( $codigo );
	} catch ( Exception $e ) {
		return $e->getMessage();
	}
}

function llenarProductos( $clave, $csv ) {
	if ( $clave != WSDL_CLAVE )
		return "Error: Clave incorrecta";
	
	try {
		return Producto::llenarProductos( $csv );
	} catch ( Exception $e ) {
		return $e->getMessage();
	}
}

$servidor = new SoapServer( "consultaprecios.wsdl" );
$servidor->addFunction( "modificarProducto" );
$servidor->addFunction( "borrarProducto" );
$servidor->addFunction( "llenarProductos" );
$servidor->handle();

?>