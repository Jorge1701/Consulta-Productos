function borrarPromo( imagen, codigo ) {
	if ( confirm( "Desea borrar la imagen " + imagen + "?" ) ) {
		$( "#borrar" + codigo ).submit();
	}
}