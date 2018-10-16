<?php

require( "bd.php" );
require( "parametro.php" );

class Configuracion {

	public static function cargarDefault() {
		BD::conexion()->prepare( "DROP TABLE IF EXISTS config" )->execute();

		$create = BD::conexion()->prepare( "CREATE TABLE config (atributo VARCHAR(40), valor VARCHAR(20), descripcion VARCHAR(256) )" );

		if ( !$create->execute() )
			return "Error: No se pudo crear la tabla de configuración.";
		else {
			$config = explode( "\n", file_get_contents( "config/default.csv" ) );

			foreach ( $config as $c ) {
				$info = explode( ",", $c );

				$insert = BD::conexion()->prepare( "INSERT INTO config ( atributo, descripcion, valor ) VALUES ( ?, ?, ? )" );
				$insert->bind_param( "sss", $info[0], $info[1], $info[2] );

				if ( !$insert->execute() )
					return "Error: No se pudo cargar el parámetro " . $info[0] . ".";
			}
		}
	}

	public static function cargar() {
		if ( !BD::conexion()->query( "SELECT 1 FROM config LIMIT 1" ) )
			Configuracion::cargarDefault();

		$select = BD::conexion()->prepare( "SELECT atributo, valor, descripcion FROM config" );
		
		if ( !$select->execute() )
			return NULL;

		$select->store_result();

		if ( $select->num_rows === 0 )
			return NULL;

		$select->bind_result( $atributo, $valor, $descripcion );

		$params = array();

		while ( $select->fetch() )
			array_push( $params, new Parametro( $atributo, $valor, $descripcion ) );

		return $params;
	}

	public static function actualizar( $atributo, $valor ) {
		$update = BD::conexion()->prepare( "UPDATE config SET valor = ? WHERE atributo = ?" );
		$update->bind_param( "ss", $valor, $atributo );
		$update->execute();
	}

	public static function definir() {
		$params = Configuracion::cargar();

		foreach ( $params as $p )
			define( $p->getNombre(), $p->getValor() );
	}
}

?>