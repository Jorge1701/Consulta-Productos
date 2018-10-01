var codigo = "";

// Al terminar de cargarse el documento se ejecutará esta función
$( document ).ready( () => {
	// Si esta en una página con el parámetro "codigo", entonces se esperan 5 segundos y se vuelve al inicio
	if ( window.location.href.includes( "codigo=" ) )
		setTimeout( () => {
			window.location.href = window.location.href.split( "?" )[0];
		}, tiempoProducto );
	else
		$( "#promociones" ).slick( {
			arrows: false,
			autoplay: true,
			autoplaySpeed: tiempoPromocion,
			adaptiveHeight: true,
			slidesToShow: 1,
			adaptiveHeight: true
		} );
} );

// Cada vez que se precione una tecla en el documento se ejecuta esta función
$( document ).keydown( ( evento ) => {
	// keyCode de 13 equivale a la tecla enter
	if ( evento.keyCode === 13 )
		window.location.href = window.location.href.split( "?" )[0] + "?codigo=" + codigo;
	else
		codigo += evento.key;
} );