<?php 
require_once 'includes/funcionesDisponibilidad.php';
require_once 'includes/helpers.php';

session_start();

$funciones = new funcionesDisponibilidad();



if (isset($_POST)) {

	$economico = isset($_POST['economico']) ? test_input($_POST['economico']) : false;

	//$sucursal = isset($_POST['sucursal']) ? test_input($_POST['sucursal']) : false;

	$fechaIngreso = isset($_POST['fechaIngreso']) ? test_input($_POST['fechaIngreso']) : false;

	$fechaPromesa = isset($_POST['fechaPromesa']) ? test_input($_POST['fechaPromesa']) : false;	

	//$fechaEntrega = isset($_POST['fechaEntrega']) ? test_input($_POST['fechaEntrega']) : false;

	$motivo = isset($_POST['motivo']) ? test_input($_POST['motivo']) : false;	

	$taller = isset($_POST['talleres']) ? test_input($_POST['talleres']) : false;	

	$folio = isset($_POST['folio']) ? test_input($_POST['folio']) : false;	

	$costo = isset($_POST['costo']) ? test_input($_POST['costo']) : false;	

	$descripcion = isset($_POST['comentario']) ? test_input($_POST['comentario']) : false;	

	$estatus = isset($_POST['estatus']) ? test_input($_POST['estatus']):"";

	$estatus_Taller = ""; 

	if($motivo == "Consignados"){
		$costo =0;
		$folio = "Sin folio";
		//$folio = "FConsigna";
		$costo = $costo + 1;

		//$taller = 'Sin taller por consigna';
	}


	$errores = array();

	if(empty($economico) || $economico == "vacio"){
		$errores['economico'] = "Casilla de economico vacia";
	}else{
		$validacion_economico = true;
	}

	if (empty($fechaIngreso)) {
		$errores['fechaIngreso'] = "Casilla de fecha de ingreso vacia";
	}else{
		$validacion_fecha_Ingreso = true;
	}


	if(empty($fechaPromesa)){
		$errores['fechaPromesa'] = "Casilla de fecha vacia";
	}else{
		$validacion_fecha_promesa = true;
	}

	/*if (empty($fechaEntrega)) {
		$errores['fechaEntrega'] = "Casilla fecha de entrega vacia";
	}else{
		$validacion_fecha_entrega = true;
	}*/

	if (empty($motivo) || $motivo == "vacio") {
		$errores['motivo'] = "Casilla de motivo vacia";
	}else{
		$validacion_motivo = true;
	}

	if (empty($taller) || $taller == "vacio") {
		$errores['taller'] = "Casilla de taller vacia";
	}else{
		$validacion_taller = true;
	}

	if (empty($folio)) {
		$errores['folio'] = "Ingresa un folio en la casilla";
	}else{
		$validacion_folio = true;
	}

	if (empty($costo) || !is_numeric($costo) ) {
		$errores['costo'] = "Casilla de costo esta vacia";
	}else{
		$validacion_costo = true;
	}

	if (empty($descripcion)) {
		$errores['descripcion'] = "Debes Ingresa una descripcion";
	}else{
		$validacion_descripcion = true;
	}

	if (empty($estatus) || $estatus == "vacio") {
		$errores['estatus'] = "Error en la casilla estatus";
	}else{
		$validacion_estatus = true;
	}


	if (count($errores) == 0) {
		
			$validacion = $funciones->save($fechaIngreso,$fechaPromesa,$fechaEntrega,$motivo,$descripcion,$folio,$costo,$estatus,$taller,$economico,$estatus_Taller);
			
			

		if ($validacion) {

			$_SESSION['completo'] = "Registro Ingresado correctamente";
			header("location:disponibilidad.php");
		
		}else{

			$_SESSION['errores'] = "Error en el metodo POST";
			header("location:disponibilidad.php");

		}

	}else{

			$_SESSION['errores'] = $errores;
			header("location:disponibilidad.php");
 	}


}