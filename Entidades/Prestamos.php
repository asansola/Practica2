<?php
class Prestamos extends EntidadBase{
	
	private $num_prestamo;
	private $num_referencia_libro;
	private $id_bibliotecario;
	private $carnet_lector;
	private $fecha;

	public function __construct(){}

	/**
	 * metodos get
	 */
	public function getNum_prestamo(){
		return $this->num_prestamo;
	}

	public function getNum_referencia_libro(){
		return $this->num_referencia_libro;
	}
	public function getId_bibliotecario(){
		return $this->id_bibliotecario;
	}
	public function getCarnet_lector(){
		return $this->carnet_lector;
	}
	public function getFecha(){
		return $this->fecha;
	}
	
	/**
	 * Metodos set
	 */
	public function setNum_prestamo($pNum_prestamo){
		$this->num_referencia= $pNum;
	}
	public function setNum_referencia_libro($pNum_referencia_libro){
		$this->isbn= $pIsbn;
	}
	public function setId_bibliotecario($pIdBibliotecario){
		$this->titulo= $pTitulo;
	}
	public function setCarnet_lector($pCarnetLector){
		$this->tema= $pTema;
	}
	public function setFecha($pFecha){
		$this->edad= $pAutor;
	}

}