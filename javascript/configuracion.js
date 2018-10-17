$( document ).ready( () => {

	$( btnCargar ).click( () => {
		if ( confirm( "¿Cargar configuración por defecto?" ) )
			$( cargar ).submit();
	} );

	$( btnGuardar ).click( () => {
		if ( confirm( "¿Guardar cambios?" ) )
			$( guardar ).submit();
	} );

} );