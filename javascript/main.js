var codigo = "";
var precioMostrado = false;
var hayCodigo = true;
// Se obtiene el valor de la propiedad css "--tiempo"
var tiempoAnimacion = window.getComputedStyle( document.querySelector( ":root" ) ).getPropertyValue( "--tiempo" ).replace( "s", "" ).replace( " ", "" );

// Al terminar de cargarse el documento se ejecutará esta función
$( document ).ready( () => {
	$( document ).focus();

	// Si esta en una página con el parámetro "codigo" hay que esperar la cantidad de tiempo: tiempoProducto
	if ( window.location.href.includes( "codigo=" ) ) {
		// Aquí se espera hasta un poco antes de que se salga de la pantalla
		// Se oculta el producto, y para cuando se termine de ocultar el siguiente setTimeout va a tomar efecto
		setTimeout( () => {
			ocultarPrecio();
		}, tiempoProducto - tiempoAnimacion * 1000 );

		setTimeout( () => {
			window.location.href = window.location.href.split( "?" )[0];
		}, tiempoProducto ); // Aquí se espera por tiempoProducto y se va al inicio
	} else {
		// Si no hay parámetro "codigo", entonces se esta en la página principal y hay que inicializar el carousel de promociones
		$( "#promociones" ).slick( {
			slidesToShow: 3,
			slidesToScroll: 1,
			centerMode: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: tiempoPromocion,
			variableWidth: true,
			adaptiveHeight: true,
		} );
	}
} );

// Cada vez que se precione una tecla en el documento se ejecuta esta función
$( document ).keydown( ( evento ) => {
	// keyCode de 13 equivale a la tecla enter
	if ( evento.keyCode === 13 ) {
		if ( precioMostrado ) {
			// Si hay un precio mostrado se oculta
			ocultarPrecio();

			// Se espera a que la animación termine y se muestra el siguiente
			setTimeout( () => {
				mostrarProducto();
			}, tiempoAnimacion * 1000 );
		} else {
			// Si no hay un precio mostrado, entonces esta en el inicio
			// Se oculta el inicio
			ocultarInicio();

			// Se espera a que termine la animación y se muestra el siguiente
			setTimeout( () => {
				mostrarProducto();
			}, tiempoAnimacion * 1000 );
		}
	} else
		// Mientras no se precione enter se acumulan los caracteres del código
		codigo += evento.key;
} );

// elemento.style.animation = "nombre-animacion " + tiempoAnimacion + "s forwards"; esta línea ejecuta una animación en el elemento

function mostrarPrecio() {
	precioMostrado = true;
	precio.style.animation = "anim-precio " + tiempoAnimacion + "s forwards";
	infoImg.style.animation = "anim-img " + tiempoAnimacion + "s forwards";
}

function decirPrecio( cantidad, moneda ) {
	if ( 'speechSynthesis' in window ) {
		let ssu = new SpeechSynthesisUtterance();
		ssu.lang = "es-ES";
		ssu.text = "El precio es " + Math.round( cantidad ) + " " + moneda + ".";
		window.speechSynthesis.speak( ssu );
	}
}

function ocultarPrecio() {
	// Si el precio no se mostro, no es necesario ocultarlo
	if ( precioMostrado ) {
		precio.style.animation = "anim-precio-ocultar " + tiempoAnimacion + "s forwards";
		infoImg.style.animation = "anim-img-ocultar " + tiempoAnimacion + "s forwards";
	}

	// La información si, ya que por mas que el precio no se muestre, la información va a estar en pantalla con el contenido "No encontrado"
	informacion.style.animation = "anim-info-ocultar " + tiempoAnimacion + "s forwards";
}

function mostrarProducto() {
	// window.location.href es el link del navegador
	// Al separarlo por ? en la posicion 0 solo queda el link base de la página, sin parámetros
	// Luego se le agrega el parámegro del código
	// el split es necesario, ya que si ya se esta mostrando un producto ya va a haber un código y la concatenación quedaría ?codigo=1?codigo=2
	window.location.href = window.location.href.split( "?" )[0] + "?codigo=" + codigo;
}

function ocultarInicio() {
	// Si hay un código entonces no estamos en la pantalla inicio
	if ( hayCodigo )
		return;

	img_logo.style.animation = "anim-titulo-ocultar " + tiempoAnimacion + "s forwards";
	titulo_promo.style.animation = "anim-titulo-ocultar " + tiempoAnimacion + "s forwards";
	promociones.style.animation = "anim-carousel-ocultar " + tiempoAnimacion + "s forwards";
}