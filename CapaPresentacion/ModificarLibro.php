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
	$titulo = $_POST ['titulo'];
	$tema = $_POST ['tema'];
	$autor = $_POST ['autor'];
	
	$elibrolibro = new Libros();
	
	$elibrolibro->setNum_referencia($id);
	$elibrolibro->setIsbn($isbn);
	$elibrolibro->setTitulo($titulo);
	$elibrolibro->setTema($tema);
	$elibrolibro->setAutor($autor);
	
	$libroBLL = new LibrosBLL();
	
	$libroBLL->Modificar($elibrolibro);

	if($libroBLL->getHayError() ){ 
		$mensaje="Registro no modificado: Error en el registro";
		echo "<script>";
		echo "if(alert('$mensaje'));";
		echo "window.location='mantenimientoLibro.php'";
		echo "</script>";
	}
	else{
		$mensaje="Actualizado correctamente";
		echo "<script>";
		echo "if(alert('$mensaje'));";
		echo "window.location='mantenimientoLibro.php'";
		echo "</script>";
	}
	
	//sea cual sea el caso lo retorna a mantenimientos
	//header ( "location: mantenimientoLibro.php" );

}
	
?>

<br><br><br><br>
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
					<input class='form-control' name='isbn' type='text' value="<?php echo $vlibro[0][1];?>" id='isbn' required >
			</div>
			<div class='form-group'>
					<label for='precio'>Titulo:</label>
					<input class='form-control' name='titulo' type='text' value="<?php echo $vlibro[0][2];?>" id='titulo' >
			</div>
			
			<div class='form-group'>
					<label for='precio'>Tema:</label>
					 <textarea name="tema" placeholder="Tema" readonly="true"><?php echo$vlibro[0][3];?></textarea>
					 
			</div>
			
			<div class='form-group'>
					<label for='precio'>Autor:</label>
					<input class='form-control' name='autor' type='text' value="<?php echo $vlibro[0][4];?>" id='autor' pattern="[A-Za-z ñáéíóú ]*">
			</div>
		
			
	
			</table>
	</div>
	
	<div class="footer">
		<input type="submit" class="btn btn-primary" name="submit"
			value="Actualizar Datos" />&nbsp;
			<a href='MantenimientoLibro.php'>Cancelar</a>
	</div>
</form>	