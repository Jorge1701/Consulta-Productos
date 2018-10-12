$( document ).ready( () => {

	$( btnCargar ).click( () => {
		if ( confirm( "¿Cargar configuración por defecto?" ) )
			$( cargar ).submit();
	} );

	$( btnGuardar ).click( () => {
		if ( confirm( "¿Guardar cambios?" ) )
			$( guardar ).submit();
	} );

	let ins = document.querySelectorAll( "input" );

	console.log( ins );

	for ( let i = 0; i < ins.length; i++ )
		ins[i].type = ins[i].classList[0] === "decimal" ? "number" : ins[i].classList[0];

} );