<?php
include 'Menu.php';
include ("IncluirClases.php");

//si hace click sobre un registro llene el form modal con datos
if (isset ( $_GET ['id'] )) {
	
	$id = $_GET ['id'];

	$libro = new LibrosBLL();
	$vlibro = $libro->ConsultarRegistro($id);
}


//si hizo click en el envio
if (isset ( $_POST ['submit'] )) {
	//captura de datos	
	$id = $_POST ['idHidden'];
	$isbn= $_POST ['isbn'];
	$titulo = $_POST ['nombre'];
	$tema = $_POST ['apellidos'];
	$autor = $_POST ['clave'];
	
	$elibrolibro = new Libros();
	
	$elibro->setNum_referencia($id);
	
	$libroBLL = new LibrosBLL();
	
	$libroBLL->Modificar($elibro);

	if($libroBLL->getHayError() ){ 
			echo "Error";
		}
	else{
			
		echo "Bien";
	}
	
	//sea cual sea el caso lo retorna a mantenimientos
	header ( "location: mantenimientoLibro.php" );

}
	
?>


<form method="post" action="ModificarLibro.php" role="form" data-toggle="validator">
	<div class="modal-body">
		<table width='300px' align='Center' border=1>
	
			<div class='form-group'>
					<label for='id'>Numero Referencia</label>
					<input class='form-control' name='id' type='text' id='id' value="<?php echo $vlibro[0][0];?>" disabled>
					<input type='hidden' name='idHidden' id='idHidden' value="<?php echo $vlibro[0][0];?>">
			</div>
			
			<div class='form-group'>
				
					<label for='nombre'>ISBN:</label>
					<input class='form-control' name='isbn' type='text' value="<?php echo $vlibro[0][1];?>" id='isbn' required pattern="[A-Za-z0-9 ñáéíóú]*" >
			</div>
			<div class='form-group'>
					<label for='precio'>Titulo:</label>
					<input class='form-control' name='titulo' type='text' value="<?php echo $vlibro[0][2];?>" id='titulo' pattern="[A-Za-z ñáéíóú ]*">
			</div>
			
			<div class='form-group'>
					<label for='precio'>Tema:</label>
					<input class='form-control' name='tema' type='text' value="<?php echo $vlibro[0][3];?>" id='tema' pattern="[A-Za-z ñáéíóú ]*">
			</div>
			
			<div class='form-group'>
					<label for='precio'>Autor:</label>
					<input class='form-control' name='tema' type='text' value="<?php echo $vlibro[0][4];?>" id='tema' pattern="[A-Za-z ñáéíóú ]*">
			</div>
		
			
	
			</table>
	</div>
	
	<div class="footer">
		<input type="submit" class="btn btn-primary" name="submit"
			value="Actualizar Datos" />&nbsp;
		<button type="button" class="btn btn-default" href="MantenimientoLibro.php">Cancelar</button>
	</div>
</form>	