<?php

$variables = explode( "\n", file_get_contents( $_SERVER["DOCUMENT_ROOT"] . "/consultaprecio/config.conf" ) );

foreach ( $variables as $v ) {
	$variable = trim( $v );

	if ( $variable !== "" && $variable[0] !== "#" ) {
		$info = explode( "=", $variable );

		if ( count( $info ) == 2 )
			define( $info[0], $info[1] );
	}
}

?>