<?php
class Bibliotecarios/*extends EntidadBase*/{
	
	private $id;
	private $nombre;

	public function __construct(){
	
	}
	
/*	public function __construct($pid,$pclave,$pnombre,$papellidos,$pidhorario,$pidrol){
		$this->id=$pidhorarioid;
		$this->clave=$pclave;
		$this->nombre=$pnombre;
		$this->apellidos=$papellidos;
		$this->idhorario=$pidhorario;
		$this->idrol=$pidrol;
	}*/

	/**
	 * metodos get
	 */
	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}
	
	/**
	 * Metodos set
	 */
	public function setId($pId){
		$this->id= $pId;
	}

	public function setNombre($pNombre){
		$this->nombre= $pNombre;
	}

}