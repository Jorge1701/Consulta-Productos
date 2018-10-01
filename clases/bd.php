<?php

require_once( $_SERVER["DOCUMENT_ROOT"] . "/consultaprecio/clases/config.php" );

class BD {

	public static function conexion() {
		static $conexion = null;

		if ( $conexion === null ) {
			$conexion = new mysqli( BD_HOST, BD_USUARIO, BD_PASS, BD_NOMBRE );

			if ( $conexion->connect_errno )
				throw new Exception( "Error: " . $conexion->connect_error );
		}

		$conexion->set_charset( "utf8" );
		return $conexion;
	}
}

?>