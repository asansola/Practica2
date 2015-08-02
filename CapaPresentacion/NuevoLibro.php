<?php
include 'Menu.php';
include ("IncluirClases.php");

//si hace click sobre un registro llene el form modal con datos
if (isset ( $_GET ['id'] )) {
	
	$id = $_GET ['id'];
}


//si hizo click en el envio
if (isset ( $_POST ['submit'] )) {
	//captura de datos	
//	$id = $_POST ['idHidden'];
	$isbn= $_POST ['isbn'];
	$titulo = $_POST ['titulo'];
	$tema = $_POST ['tema'];
	$autor = $_POST ['autor'];
	
	$elibrolibro = new Libros();
	
	$elibrolibro->setIsbn($isbn);
	$elibrolibro->setTitulo($titulo);
	$elibrolibro->setTema($tema);
	$elibrolibro->setAutor($autor);
	
	$libroBLL = new LibrosBLL();
	
	$libroBLL->Agregar($elibrolibro);

	if($libroBLL->getHayError() ){ 
		$mensaje="Registro no agregado: El ISBn YA existe!";
		echo "<script>";
		echo "if(alert('$mensaje'));";
		echo "window.location='mantenimientoLibro.php'";
		echo "</script>";
	}
	else{
		$mensaje="Agregado correctamente";
		echo "<script>";
		echo "if(alert('$mensaje'));";
		echo "window.location='mantenimientoLibro.php'";
		echo "</script>";
	}
	
}
	
?>

<br><br><br><br>
<form method="post" action="NuevoLibro.php" role="form" data-toggle="validator">
	<div class="modal-body">
		<table width='300px' align='Center' border=1>
	
			
			<div class='form-group'>
				
					<label for='nombre'>ISBN:</label>
					<input class='form-control' name='isbn' type='text' value="" id='isbn' required >
			</div>
			<div class='form-group'>
					<label for='precio'>Titulo:</label>
					<input class='form-control' name='titulo' type='text' value="" id='titulo' >
			</div>
			
			<div class='form-group'>
					<label for='precio'>Tema:</label>
					 <textarea name="tema" placeholder="Tema" readonly="true">Escriba tema aqui
					 </textarea>
					 
			</div>
			
			<div class='form-group'>
					<label for='precio'>Autor:</label>
					<input class='form-control' name='autor' type='text' value="" id='autor' pattern="[A-Za-z ñáéíóú ]*">
			</div>
		
			
	
			</table>
	</div>
	
	<div class="footer">
		<input type="submit" class="btn btn-primary" name="submit"
			value="Agregar Libro" />&nbsp;
			<a href='MantenimientoLibro.php'>Cancelar</a>
	</div>
</form>	