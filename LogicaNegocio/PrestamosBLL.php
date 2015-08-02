<?php

class PrestamosBLL extends LogicaNegocioMantenimientoBase
{

	private $oPrestamo= null;

	private $hayError;
	private $descripcionError;
	
	public function __construct(){
		//Asignar Valores por defecto a los atributos de la instancia
		$this->hayError = false;			
		//Crear la instancia del objeto
		$this->oPrestamo = new PrestamosAccesoDatos();
	}

	public function getHayError(){
		return $this->oPrestamo->getHayError();
	}

	public function setHayError($pHayError) {
		$this->oPrestamo->setHayError($pHayError);
	}

	public function getDescripcionError(){
		return $this->oPrestamo->getDescripcionError();
	}

	public function setDescripcionError($pDescripcionError) {
		$this->oPrestamo->setDescripcionError($pDescripcionError);
	}

	public function Agregar($oLibro){
		return $this->oPrestamo->Agregar($oLibro);
	}

	public function Modificar($oLibro){
		return $this->oPrestamo->Modificar($oLibro);
	}

	public function Eliminar($oLibro){
		return $this->oLibro->Eliminar($oLibro);
	}
	
	public function Consultar($oLibro){
		return $this->oPrestamo->Consultar($oLibro);
	}
	
	public function ConsultarRegistro($id){  //consulta por id de usuario con descripciones
		return $this->oPrestamo->ConsultarRegistro($id);
	}
	

	public function Verificar($id,$clave){ //consulta por id y clave
		return $this->oPrestamo->Verificar($id,$clave);
	}

	public function Listar($lim1,$lim2){
		return $this->oPrestamo->Listar($lim1,$lim2);
	}
	
	public function Contar(){
		return $this->oPrestamo->Contar();
	}

}