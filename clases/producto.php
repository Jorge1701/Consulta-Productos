<?php

require( "bd.php" );

class Producto {

	private $codigo = "";
	private $precio = 0;
	private $descripcion = "";
	private $marca = "";
	private $detalle = "";
	private $moneda = "";

	public function __construct( $codigo, $precio, $descripcion, $marca, $detalle, $moneda ) {
		$this->codigo = $codigo;
		$this->precio = $precio;
		$this->descripcion = $descripcion;
		$this->marca = $marca;
		$this->detalle = $detalle;
		$this->moneda = $moneda;
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function getPrecio() {
		return $this->precio;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getMarca() {
		return $this->marca;
	}

	public function getDetalle() {
		return $this->detalle;
	}

	public function getMoneda() {
		return $this->moneda;
	}

	public function getImagen() {
		if ( file_exists( "imagenes/productos/" . $this->getCodigo() . ".jpg" ) )
			return "imagenes/productos/" . $this->getCodigo() . ".jpg";

		return "imagenes/logo.jpg";
	}

	public static function consultarProducto( $codigo ) {
		$select = BD::conexion()->prepare( "SELECT precio, descripcion, marca, detalle, moneda FROM productos WHERE codigo = ?" );
		$select->bind_param( "s", $codigo );
		$select->execute();
		$select->store_result();

		$producto = NULL;

		if ( $select->num_rows !== 0 ) {
			$select->bind_result( $precio, $descripcion, $marca, $detalle, $moneda );
			$select->fetch();
			$producto = new Producto( $codigo, $precio, $descripcion, $marca, $detalle, $moneda );
		}

		return $producto;
	}

	public static function listarProductos() {
		$select = BD::conexion()->prepare( "SELECT codigo, precio, descripcion, marca, detalle, moneda FROM productos" );
		
		if ( !$select->execute() )
			return NULL;

		$select->store_result();

		if ( $select->num_rows === 0 )
			return NULL;

		$select->bind_result( $codigo, $precio, $descripcion, $marca, $detalle, $moneda );

		$productos = array();

		while ( $select->fetch() )
			array_push( $productos, new Producto( $codigo, $precio, $descripcion, $marca, $detalle, $moneda ) );

		return $productos;
	}

	public static function modificarProducto( $codigo, $precio, $descripcion, $marca, $detalle, $moneda ) {
		if ( !isset( $codigo ) || trim( $codigo ) === "" )
			return "Error: Falta el código";

		$codigo = trim( $codigo );

		if ( !isset( $precio ) || trim( $precio ) === "" )
			return "Error: Falta el precio";

		$precio = trim( $precio );

		if ( !is_numeric( $precio ) )
			return "Error: Precio no numérico";
		else if ( $precio <= 0 )
			return "Error: Precio no válido (" . $precio . ")";

		$descripcion = trim( $descripcion );
		$marca = trim( $marca );
		$detalle = trim( $detalle );

		if ( Producto::consultarProducto( $codigo ) ) {
			$update = BD::conexion()->prepare( "UPDATE productos SET precio = ?, descripcion = ?, marca = ?, detalle = ?, moneda = ? WHERE codigo = ?" );
			$update->bind_param( "dssss", $precio, $descripcion, $marca, $detalle, $moneda, $codigo );

			if ( $update->execute() )
				return "OK";
			else
				return "Error: " . $update->error;
		} else {
			$insert = BD::conexion()->prepare( "INSERT INTO productos ( codigo, precio, descripcion, marca, detalle, moneda ) VALUES ( ?, ?, ?, ?, ?, ? )" );
			$insert->bind_param( "sdssss", $codigo, $precio, $descripcion, $marca, $detalle, $moneda );

			if ( $insert->execute() )
				return "OK";
			else
				return "Error: " . $insert->error;
		}
	}

	public static function modificarProductoExistente( $codigoViejo, $codigo, $precio, $descripcion, $marca, $detalle, $moneda, $imagen ) {
		$update = BD::conexion()->prepare( "UPDATE productos SET codigo = ?, precio = ?, descripcion = ?, marca = ?, detalle = ?, moneda = ? WHERE codigo = ?" );
		$update->bind_param( "sdsssss", $codigo, $precio, $descripcion, $marca, $detalle, $moneda, $codigoViejo );

		if ( $update->execute() )
			return "OK";
		else
			return "Error: " . $update->error;
	}

	public static function borrarProducto( $codigo ) {
		if ( !isset( $codigo ) || trim( $codigo ) === "" )
			return "Error: Falta el código";

		$codigo = trim( $codigo );

		if ( !Producto::consultarProducto( $codigo ) )
			return "Error: Producto no existe";

		$delete = BD::conexion()->prepare( "DELETE FROM productos WHERE codigo = ?" );
		$delete->bind_param( "s", $codigo );

		if ( $delete->execute() )
			return "OK";
		else
			return "Error: " . $delete->error;
	}

	public static function llenarProductos( $csv ) {
		if ( $csv === "" )
			return "Error: CSV vacío";

		$productos = explode( "\n", $csv );

		$linea = 1;
		$errores = "";
		$contErr = 0;

		foreach ( $productos as $p ) {
			$valores = explode( ",", $p );

			if ( count( $valores ) !== 6 ) {
				$errores .= "Error: Faltan parámetros, CSV línea " . $linea++ . "\n";
				$contErr++;
				continue;
			}

			for ( $i = 0; $i < count( $valores ); $i++ )
				$valores[$i] = trim( $valores[$i] );

			$resp = Producto::modificarProducto( $valores[0], $valores[1], $valores[2], $valores[3], $valores[4], $valores[5] );

			if ( $resp !== "OK" ) {
				$errores .= $resp . ", CSV línea " . $linea . "\n";
				$contErr++;
			}

			$linea++;
		}

		return $contErr ? "Errores: " . $contErr . "\n\n" . $errores : "OK";
	}
}

?>