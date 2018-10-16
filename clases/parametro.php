<?php

class Parametro {

	private $nombre = "";
	private $valor = "";
	private $descripcion = "";

	public function __construct( $nombre, $valor, $descripcion ) {
		$this->nombre = $nombre;
		$this->valor = $valor;
		$this->descripcion = $descripcion;
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
}

?>