<?php 
include 'Menu.php';
?>
<br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;">
<title>Libros</title>
<link href="../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body><br>
<h1 >Mantenimiento de Libros</h1>
<?php

	//Inicializar la sesi�n
	session_start();
	require_once ("IncluirClases.php");
	
	//Crear la instancia del Componente de L�gicas de Negocio
	$LibroBLL = new LibrosBLL();
	
	//Invocar el m�todo de Listas
	$resultado = $LibroBLL->Listar();
	//Si hay tuplas, cargar el mantenimiento
	if ($resultado!=FALSE){
		echo "<a href='NuevoLibro.php?accion=I&id=0'>Nuevo Libro</a><br/><br/>";
		echo "<table width='900px' align='Center' border=1>";
		echo "<tr>";
	//	echo "  <td width='100px'>Numero Referencia</td>";
		echo "  <td width='100px'>ISBN</td>";
		echo "  <td width='300px'>Titulo</td>";
	//	echo "  <td width='200px'>Tema</td>";
		echo "  <td width='100px'>Autor</td>";
		echo "  <td width='100px' colspan=2 align=center>Accion</td>";
		echo "</tr>";
		foreach ($resultado as $fila){
				echo "<tr>";
				echo "  <td>" . $fila[1] . "</td>";
				echo "  <td>" . $fila[2] . "</td>";
				echo "  <td>" . $fila[4] . "</td>";
				echo "  <td><a href='ModificarLibro.php?accion=U&id=" . $fila[0] . "'>Modificar Libro</a></td>";
				echo "</tr>";
		}
		echo "</table>";
	}


?>
</body>
</html>