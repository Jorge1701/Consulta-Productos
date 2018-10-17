function borrarPromo( codigo ) {
	if ( confirm( "¿Desea borrar la imagen?" ) ) {
		$( "#borrar" + codigo ).submit();
	}
}