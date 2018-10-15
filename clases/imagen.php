<?php

class Imagen {

	public static function subirImagen( $directorio, $codigo ) {
		$archivo = $directorio . $codigo . ".jpg";
		$permitido = array( "jpg" => "image/jpg" );
		$tipoArchivo = strtolower( pathinfo( $archivo, PATHINFO_EXTENSION ) );

		if ( !array_key_exists( $tipoArchivo, $permitido ) )
			return "Error: Tipo de imagen no soportado";
		else {
			if ( move_uploaded_file( $_FILES["imagen"]["tmp_name"], $archivo ) )
				return "OK";
			else
				return "Error: No se pudo subir la imagen";
		}
	}
}

?>