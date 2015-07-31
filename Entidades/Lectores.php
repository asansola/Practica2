<?php
class Lectores /*extends EntidadBase*/{
	
	private $carnet;
	private $nombre;
	private $apellidos;
	private $direccion;
	private  $edad;
	
	public function __construct(){}

	/**
	 * metodos get
	 */
	public function getCarnet(){
		return $this->carnet;
	}

	public function getNombre(){
		return $this->nombre;
	}
	public function getApellidos(){
		return $this->apellidos;
	}
	public function getDireccion(){
		return $this->direccion;
	}
	public function getEdad(){
		return $this->edad;
	}
	
	/**
	 * Metodos set
	 */
	public function setCarnet($pCarnet){
		$this->carnet= $pCarnet;
	}
	public function setNombre($pNombre){
		$this->nombre= $pNombre;
	}
	public function setApellidos($pApellidos){
		$this->apellidos= $pApellidos;
	}
	public function setDireccion($pDireccion){
		$this->direccion= $pDireccion;
	}
	public function setEdad($pEdad){
		$this->edad= $pEdad;
	}

}