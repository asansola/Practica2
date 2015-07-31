<?php

class LibrosAccesoDatos extends MantenimientoBase{

	/**
	 * Constructor de la clase
	 */
	public function __construct(){
		//Invocar el constructor del padre
		parent::__construct();
		FactoriaDAO::setTipoBaseDatos("MySQL");
	}

	public function Agregar($oBibliotecario){
		//Inicializar el control de Errores
		parent::setHayError(False);
			
		//Invocar el Procedimiento Almacenado
		$descripcionError='';
		$vSql = "CALL sp_I_Usuario (" . $oUsuario ->getId() . ", '" . $oUsuario->getClave() . "', '" . $oUsuario->getNombre() . "', '" . $oUsuario->getApellidos() . "', " . $oUsuario->getIdhorario() . ", " . $oUsuario->getIdrol() . ", @DescripcionError);";
		FactoriaDAO::getConexionBaseDatos()->AbrirConexion();
		FactoriaDAO::getConexionBaseDatos()->EjecutarSQLError($vSql);
			
		//Leer la variable de salida del error
		if(FactoriaDAO::getConexionBaseDatos()->getHayError()){
			parent::setHayError(True);
			parent::setDescripcionError(FactoriaDAO::getConexionBaseDatos()->getDescripcionError());
		}
		
		//Retornar True si no hay errores
		return !parent::getHayError();
		
	}

	public function Modificar($oBibliotecario){
		//Inicializar el control de Errores
		parent::setHayError(False);
		
			
		//Invocar el Procedimiento Almacenado
		$vSql = "CALL sp_U_Usuario (" . $oUsuario ->getId() . ", '" . $oUsuario->getClave() . "', '" . $oUsuario->getNombre() . "', '" . $oUsuario->getApellidos() . "', " . $oUsuario->getIdhorario() . ", " . $oUsuario->getIdrol() . ", @DescripcionError);";
		FactoriaDAO::getConexionBaseDatos()->AbrirConexion();
		FactoriaDAO::getConexionBaseDatos()->EjecutarSQLError($vSql);
		
		//Leer la variable de salida del error
		if(FactoriaDAO::getConexionBaseDatos()->getHayError()){
			parent::setHayError(True);
			parent::setDescripcionError(FactoriaDAO::getConexionBaseDatos()->getDescripcionError());
		}
			
		//Retornar True si no hay errores
		return !parent::getHayError();
	}

	public function Eliminar($oUsuario){
	}
	
	public function Consultar($oUsuario){}
	
	public function ConsultarRegistro($idLibro){
		//Variables Locales
		$queryResult=NULL;
		$vResultadoCursor = null;
			
		//Inicializar el control de Errores
		parent::setHayError(False);
		//Invocar el Procedimiento Almacenado
		$vSql = "CALL sp_Q_Libro_Registro('$idLibro',@DescripcionError);";
		FactoriaDAO::getConexionBaseDatos()->AbrirConexion();
		$vResultadoCursor = FactoriaDAO::getConexionBaseDatos()->EjecutarSQLIndices($vSql);
		//Retornar el objeto
		return $vResultadoCursor;
	
	}
		

	public function Listar(){
		//Variables Locales
		$vResultadoCursor = null;
		$queryResult=NULL;
			
		//Inicializar el control de Errores
		parent::setHayError(False);
			
		//Invocar el Procedimiento Almacenado
		//Se manda 0 en par�metro ya que se desea leer todas las tuplas
		$vSql = "CALL sp_Q_Libro_Listar(@descripcionError);";
		FactoriaDAO::getConexionBaseDatos()->AbrirConexion();
		$vResultadoCursor = FactoriaDAO::getConexionBaseDatos()->EjecutarSQLIndices($vSql);
		
		return $vResultadoCursor;
	}
	

}
?>