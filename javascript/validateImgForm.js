$( document ).ready( () => {

	$( enviarForm ).click( () => {
		let img = $( "input[name=imagen]" ).val();

		if ( img != "" && !img.includes( ".jpg" ) )
			alert( "Tipo de imagen inválido." );
		else
			form.submit();
	} );
	
} );