$( document ).ready( () => {

	$( btnCargar ).click( () => {
		if ( confirm( "¿Cargar configuración por defecto?" ) )
			$( cargar ).submit();
	} );

	$( btnGuardar ).click( () => {
		if ( confirm( "¿Guardar cambios?" ) )
			$( guardar ).submit();
	} );

	$( enviarForm ).click( () => {
		if ( confirm( "¿Cambiar logo?" ) )
			$( form ).submit();
	} );

} );