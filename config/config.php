<?php

/* Conexión a la base de datos */
define( "BD_HOST", "127.0.0.1" );
define( "BD_USUARIO", "root" );
define( "BD_PASS", "" );
define( "BD_NOMBRE", "consultaprecio" );

/* Clave de autorización para los servicios WSDL */
define( "WSDL_CLAVE", "clave" );

/* Titulo a mostrar en pantalla de espera */
define( "texto_titulo_inicio", "Consultar precio" );
/* Titulo a mostrar dentro de la información del producto */
define( "texto_titulo_producto", "PRODUCTO" );
/* Texto a mostrar cuando no se encuentre un producto */
define( "texto_no_encontrado", "No encontrado" );

/* Tiempo por el cual un producto va a ser mostrado  */
define( "tiempo_producto", "7000" );
/* Tiempo en que demora en pasar una imagen de promoción */
define( "tiempo_promocion", "3000" );

?>