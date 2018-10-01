<?php

require( "bd.php" );

class Producto {

	private $codigo = "";
	private $precio = 0;
	private $descripcion = "";
	private $marca = "";
	private $detalle = "";

	public function __construct( $codigo, $precio, $descripcion, $marca, $detalle ) {
		$this->codigo = $codigo;
		$this->precio = $precio;
		$this->descripcion = $descripcion;
		$this->marca = $marca;
		$this->detalle = $detalle;
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

	public static function consultarProducto( $codigo ) {
		$select = BD::conexion()->prepare( "SELECT precio, descripcion, marca, detalle FROM productos WHERE codigo = ?" );
		$select->bind_param( "s", $codigo );
		$select->execute();
		$select->store_result();

		$producto = NULL;

		if ( $select->num_rows !== 0 ) {
			$select->bind_result( $precio, $descripcion, $marca, $detalle );
			$select->fetch();
			$producto = new Producto( $codigo, $precio, $descripcion, $marca, $detalle );
		}

		return $producto;
	}

	public static function modificarProducto( $codigo, $precio, $descripcion, $marca, $detalle ) {
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
			$update = BD::conexion()->prepare( "UPDATE productos SET precio = ?, descripcion = ?, marca = ?, detalle = ? WHERE codigo = ?" );
			$update->bind_param( "dssss", $precio, $descripcion, $marca, $detalle, $codigo );

			if ( $update->execute() )
				return "OK";
			else
				return "Error: " . $update->error;
		} else {
			$insert = BD::conexion()->prepare( "INSERT INTO productos ( codigo, precio, descripcion, marca, detalle ) VALUES ( ?, ?, ?, ?, ? )" );
			$insert->bind_param( "sdsss", $codigo, $precio, $descripcion, $marca, $detalle );

			if ( $insert->execute() )
				return "OK";
			else
				return "Error: " . $insert->error;
		}
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

			if ( count( $valores ) !== 5 ) {
				$errores .= "Error: Faltan parámetros, CSV línea " . $linea++ . "\n";
				$contErr++;
				continue;
			}

			for ( $i = 0; $i < count( $valores ); $i++ )
				$valores[$i] = trim( $valores[$i] );

			$resp = Producto::modificarProducto( $valores[0], $valores[1], $valores[2], $valores[3], $valores[4] );

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