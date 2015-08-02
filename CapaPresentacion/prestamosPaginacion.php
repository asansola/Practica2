<?php 
include 'Menu.php';

session_start();
require_once ("IncluirClases.php");

//Crear la instancia del Componente de Lógicas de Negocio
$oPrestamoBLL = new PrestamosBLL();

// Establece la conexión a la BD y realizar la consulta
// para conocer la cantidad total de registros que
// se quieren mostrar
// en este caso "SELECT COUNT(*) FROM estudiantes"
$resultado = $oPrestamoBLL->contar();
// Número de Filas total
$totalFilas = $resultado[0][0];
// Número de resultados que desea mostrar por página
$filas_pagina = 4;
// Indica el número de página de la última pagina
$ultima = ceil($totalFilas/$filas_pagina);
// Verificar que la última no sea inferior a 1
if($ultima < 1){ $ultima = 1; }
// Estable el $numeroPagina = 1;
$numeroPagina=1;
// Obtiene el número de página de GET (URL)
if(isset($_GET['pn'])){ $numeroPagina = preg_replace('#[^0-9]#', '', $_GET['pn']); }
// Verificar el número de página no sea menor a 1 o más que la $ultima pagina
if ($numeroPagina < 1) { $numeroPagina = 1; } else if ($numeroPagina > $ultima) { $numeroPagina = $ultima; }
// This sets the range of rows to query for the chosen $numeroPagina
// Establece el rango de filas pa la consulta determinado por el $numeroPagina
//LIMIT: parámetros->  el primero indica el número del primer registro a retornar, el segundo, el número máximo de registros a retornar.
$registroNum=($numeroPagina );
if ($numeroPagina != 1) $registroNum=($numeroPagina -1) * $filas_pagina;
$limiteInicio=$registroNum;
$limiteCantidad=$filas_pagina;

//$limit = ' limit ' .$registroNum .',' .$filas_pagina;
// Esta es la consulta que se va a mostrar en cada página dando el limite a mostrar

//"SELECT * FROM estudiantes  ORDER BY carnet DESC $limit";

$prestamos = $oPrestamoBLL->Listar($limiteInicio, $limiteCantidad);
// Esto muestra al usuario
//el número total de páginas
$textline1 = "Prestamos (<b>$totalFilas</b>)";
//En que página se encuentra
$textline2 = "Pagina <b>$numeroPagina</b> de <b>$ultima</b>";
//Control de Paginacion: Anterior y Siguiente
$ctrlsPaginacion = '';
// Si hay más de una página
if($ultima != 1){
/* First we check if we are on page one.
	* If we are then we don't need a link to the previous page or the first page so we do nothing.
	* If we aren't then we generate links to the first page, and to the previous page. */
	/* 1ero comprobar si esta en la primera pagina
	* Si es menor que 1 no es necesario un link a la página anterior o la primera página.
	* Si es mayor a 1 se generan los enlaces de la primera página y, a la página anterior. */
	if ($numeroPagina > 1) {
	$previous = $numeroPagina - 1; $ctrlsPaginacion .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Anterior</a> &nbsp; &nbsp; ';
 		// Links de número de enlaces que deben aparecer a la izquierda del número de página actual
	for($i = $numeroPagina-4; $i < $numeroPagina; $i++){
	if($i > 0){
	$ctrlsPaginacion .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
	}
	}
	}

//El número de la página actual, pero sin que sea un enlace
	$ctrlsPaginacion .= ''.$numeroPagina.' &nbsp; ';
	// Links de número de enlaces que deben aparecer a la derecha del número de la página actual
	for($i = $numeroPagina+1; $i <= $ultima; $i++){
	$ctrlsPaginacion .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
	if($i >= $numeroPagina+4){ break; }
	}
	// Esto hace lo mismo que el anterior, verifica si estamos en la última página, y luego genera el link de Siguiente
	if ($numeroPagina != $ultima) {
	$next = $numeroPagina + 1; $ctrlsPaginacion .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Siguiente</a> ';
	}
}
$list = '';
$list.='<table >'.
		'<tr>'.
		'<th>ISBN</th>'.
		'<th>Titulo libro</th>'.
		'<th>Id Bibliotecario</th>'.
		'<th>Bibliotecario</th>'.
		'<th>Carnet Lector</th>'.
		'<th>Lector</th>'.
		'<th>Fecha</th>'.
		'</tr>';
foreach ($prestamos as $fila){
	$list.="<tr>".
			"  <td>" . $fila[0]  . "</td>".
			"  <td>" . $fila[1]  . "</td>".
			"  <td>" . $fila[2]  . "</td>".
			"  <td>" . $fila[3]  . "</td>".
			"  <td>" . $fila[4]  . "</td>".
			"  <td>" . $fila[5]  . "</td>".
			"  <td>" . $fila[6]  . "</td>";
	'</tr>';
}
$list.='</table>';
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
<h1 >Listado de Prestamos</h1>

<link rel="stylesheet" type="text/css" href="../css/pagination-style.css">
</head>
<body>
	<div id="contenedor">
		<h3 style="text-align: left;"><?php echo $textline1; ?></h3>		
		<p><?php echo $list; ?></p>
		<div class="pagination"><?php echo $ctrlsPaginacion; ?></div>
		<p style="text-align: left;"><?php echo $textline2; ?></p>
	</div>
</body>
</html>