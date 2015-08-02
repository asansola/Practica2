<?php
define('FPDF_FONTPATH','fpdf/font/');
require_once('fpdf/fpdf.php');
include ("IncluirClases.php");


class PDF extends FPDF {
	function tabla($cabecera, $datos) {
		$this->cabecera( $cabecera );
		$this->datos( $datos );
	}
	function cabecera($cabecera)
	{
		//Cabecera
		$this->SetFillColor(255,0,0) ;
		$this->SetTextColor(255) ;
		$this->SetDrawColor(128,0,0);
		$this->SetFont('Arial','B',9);
		foreach($cabecera as $columna) {
		$this->Cell(40,5,utf8_decode($columna),1,0,'C',1);
		}
		$this->Ln();
	}
	function datos($datos)
	{
		//Datos
		$this->SetTextColor(1) ;
		$this->SetDrawColor(128,0,0) ;
		$this->SetFont('Arial' ,'',9) ;
		foreach($datos as $dato) {
			foreach($dato as $columna) {
				
				$this->Cell(40,5,utf8_decode($columna),1,0,'C');
			}
			$this->Ln() ;
		}
	}
}
$pdf = new PDF();
$pdf->AddPage();
$cabecera = array(
		"ISBN",
		"Titulo Libro",
		"Id Bibliotecario",
		"Bibliotecario",
		"Carnet Lector",
		"Lector",
		"fecha"
);

// crea clase consulta
$prestamoBll= new PrestamosBLL();
$datos = array();
$lim1="";
$lim2="";
$datos=$prestamoBll->Listar(0,6);
$datosMostrar=array();
foreach ($datos as $fila) {
	$lineaPrestamo=array($fila[0],$fila[1],$fila[2],$fila[3],$fila[4],$fila[5],$fila[6]);
	$datosMostrar[]=$lineaPrestamo;
}


$pdf->tabla( $cabecera, $datosMostrar );
$pdf->Output();
?>
