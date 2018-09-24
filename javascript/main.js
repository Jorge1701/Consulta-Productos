var codigo = "";

// Cada vez que se precione una tecla en el documento se ejecuta esta función
$( document ).keydown( ( evento ) => {
	let tecla = evento.keyCode;

	// keyCode de 13 equivale a la tecla enter
	if ( tecla === 13 )
		window.location.href = window.location.href.split( "?" )[0] + "?codigo=" + codigo;
	else
		codigo += evento.key;
} );