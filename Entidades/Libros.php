<?php
class Libros /*extends EntidadBase*/{
	
	private $num_referencia;
	private $isbn;
	private $titulo;
	private $tema;
	private  $autor;
	
	public function __construct(){}

	/**
	 * metodos get
	 */
	public function getNum_referencia(){
		return $this->num_referencia;
	}

	public function getIsbn(){
		return $this->isbn;
	}
	public function getTitulo(){
		return $this->titulo;
	}
	public function getTema(){
		return $this->tema;
	}
	public function getAutor(){
		return $this->autor;
	}
	
	/**
	 * Metodos set
	 */
	public function setNum_referencia($pNum){
		$this->num_referencia= $pNum;
	}
	public function setIsbn($pIsbn){
		$this->isbn= $pIsbn;
	}
	public function setTitulo($pTitulo){
		$this->titulo= $pTitulo;
	}
	public function setTema($pTema){
		$this->tema= $pTema;
	}
	public function setAutor($pAutor){
		$this->autor= $pAutor;
	}

}