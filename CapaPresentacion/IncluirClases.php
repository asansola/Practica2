<?php
//Cargar todos los archivos PHP necesiarios para la
//ejecuci�n de la aplicaci�n
require_once("../DAO/BaseDAO.php");
require_once("../DAO/MySqlDAO.php");
require_once("../DAO/FactoriaDAO.php");

require_once("../Entidades/EntidadBase.php");
require_once("../Entidades/Bibliotecarios.php");
require_once("../Entidades/Lectores.php");
require_once("../Entidades/Libros.php");
require_once("../Entidades/Prestamos.php");

require_once("../AccesoDatos/MantenimientoBase.php");
require_once("../AccesoDatos/BibliotecariosAccesoDatos.php");
require_once("../AccesoDatos/LibrosAccesoDatos.php");
require_once("../AccesoDatos/PrestamosAccesoDatos.php");

require_once("../LogicaNegocio/LogicaNegocioMantenimientoBase.php");
require_once("../LogicaNegocio/LibrosBLL.php");
require_once("../LogicaNegocio/PrestamosBLL.php");

?>