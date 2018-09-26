<?php

require( "bd.php" );

class Producto {

	private $codigo = "";
	private $descripcion = "";
	private $marca = "";
	private $precio = 0;

	public function __construct( $codigo, $descripcion, $marca, $precio ) {
		$this->codigo = $codigo;
		$this->descripcion = $descripcion;
		$this->marca = $marca;
		$this->precio = $precio;
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getMarca() {
		return $this->marca;
	}

	public function getPrecio() {
		return $this->precio;
	}

	public static function consultarProducto( $codigo ) {
		$select = BD::conexion()->prepare( "SELECT descripcion, marca, precio FROM productos WHERE codigo = ?" );
		$select->bind_param( "s", $codigo );
		$select->execute();
		$select->store_result();

		$producto = NULL;

		if ( $select->num_rows !== 0 ) {
			$select->bind_result( $descripcion, $marca, $precio );
			$select->fetch();
			$producto = new Producto( $codigo, $descripcion, $marca, $precio );
		}

		return $producto;
	}

	public static function modificarProducto( $codigo, $precio, $descripcion, $marca, $detalle ) {
		if ( !isset( $codigo ) || $codigo === "" )
			return "Error: Falta el código\n";

		if ( !isset( $precio ) || $precio === "" )
			return "Error: Falta el precio\n";

		if ( consultarProducto( $codigo ) ) {
			$update = BD::conexion()->prepare( "UPDATE productos SET precio = ?, descripcion = ?, marca = ?, detalle = ? WHERE codigo = ?" );
			$update->bind_param( "ssds", $precio, $descripcion, $marca, $detalle, $codigo );

			if ( $update->execute() )
				return "OK Actualizar"; // TODO Quitar Actualizar
			else
				return "Error: " . $update->error;
		} else {
			$insert = BD::conexion()->prepare( "INSERT INTO productos ( codigo, precio, descripcion, marca, detalle ) VALUES ( ?, ?, ?, ?, ? )" );
			$insert->bind_param( "sssd", $codigo, $precio, $descripcion, $marca, $detalle );

			if ( $insert->execute() )
				return "OK Agregar"; // TODO Quitar Agregar
			else
				return "Error: " . $insert->error;
		}
	}

	public static function borrarProducto( $codigo ) {
		$delete = BD::conexion()->prepare( "DELETE FROM productos WHERE codigo = ?" );
		$delete->bind_param( "s", $codigo );
		$delete->execute();
		return "OK"; // TODO Algun error especifico?
	}

	public static function llenarProductos( $csv ) {
		if ( $csv === "" )
			return "Error: CSV vacio";

		$productos = explode( "\n", $csv );

		$errores = "";
		$contErr = 0;
		$warnings = "";
		$contWarn = 0;

		$i = 1;

		foreach ( $productos as $p ) {
			$valores = explode( ",", $p );

			if ( !isset( $valores[0] ) || $valores[0] === "" ) {
				$errores .= "Error: Al producto " . $i++ . " le falta el código\n";
				$contErr++;
				continue;
			} else if ( !isset( $valores[2] ) || $valores[2] === "" ) {
				$errores .= "Error: Al producto " . $i++ . " le falta el precio\n";
				$contErr++;
				continue;
			} else if ( !isset( $valores[3] ) || $valores[3] === "" ) {
				$warnings .= "Warning: Al producto " . $i . " le falta la descripción\n";
				$contWarn++;
			}

			if ( consultarProducto( $valores[0] ) ) {

			}

			agregarProducto( $valores[0], $valores[1], $valores[2], $valores[3] );

			$i++;
		}

		return $errores === "" ? "OK" : $errores;
	}
}

?>