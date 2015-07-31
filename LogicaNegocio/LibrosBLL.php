<?php

class LibrosBLL extends LogicaNegocioMantenimientoBase{

	private $oLibro= null;

	private $hayError;
	private $descripcionError;
	
	public function __construct(){
		//Asignar Valores por defecto a los atributos de la instancia
		$this->hayError = false;			
		//Crear la instancia del objeto
		$this->oLibro = new LibrosAccesoDatos();
	}

	public function getHayError(){
		return $this->oLibro->getHayError();
	}

	public function setHayError($pHayError) {
		$this->oLibro->setHayError($pHayError);
	}

	public function getDescripcionError(){
		return $this->oLibro->getDescripcionError();
	}

	public function setDescripcionError($pDescripcionError) {
		$this->oLibro->setDescripcionError($pDescripcionError);
	}

	public function Agregar($oLibro){
		return $this->oLibro->Agregar($oUsuario);
	}

	public function Modificar($oLibro){
		return $this->oLibro->Modificar($oUsuario);
	}

	public function Eliminar($oLibro){
		return $this->oLibro->Eliminar($oUsuario);
	}
	
	public function Consultar($oLibro){
		return $this->oLibro->Consultar($oLibro);
	}
	
	public function ConsultarRegistro($id){  //consulta por id de usuario con descripciones
		return $this->oLibro->ConsultarRegistro($id);
	}
	

	public function Verificar($id,$clave){ //consulta por id y clave
		return $this->oLibro->Verificar($id,$clave);
	}

	public function Listar(){
		return $this->oLibro->Listar();
	}

}