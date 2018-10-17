$( document ).ready( () => {
	if ( document.querySelector( "#borrarImagen" ) != undefined )
		$( borrarImagen ).click( () => {
			if ( confirm( "¿Borrar la imagen del producto?" ) )
				$( formBorrar ).submit();
		} );
} );