<?php

class Parametro {

	private $nombre = "";
	private $valor = "";
	private $descripcion = "";
	private $tipo = "";

	public function __construct( $nombre, $valor, $descripcion, $tipo ) {
		$this->nombre = $nombre;
		$this->valor = $valor;
		$this->descripcion = $descripcion;
		$this->tipo = $tipo;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getValor() {
		return $this->valor;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getTipo() {
		return $this->tipo;
	}
}

?>