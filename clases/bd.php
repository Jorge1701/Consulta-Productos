<?php

require_once( $_SERVER["DOCUMENT_ROOT"] . "/consultaprecio/config/bdconfig.php" );

class BD {

	public static function conexion() {
		static $conexion = null;

		if ( $conexion === null )
			$conexion = new mysqli( BD_HOST, BD_USUARIO, BD_PASS, BD_NOMBRE ) or die ( "No se pudo conectar a la base de datos" );

		$conexion->set_charset( "utf8" );
		return $conexion;
	}
}

?>