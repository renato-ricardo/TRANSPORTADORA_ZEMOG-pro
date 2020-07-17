<?php 

require_once 'includes/db.php';
require_once 'includes/estatus_disponiblesFunciones.php';
require_once 'includes/helpers.php';

session_start();

$funciones = new estatus_disponiblesFunciones();

if(isset($_POST)){

	$estatus = isset($_POST['estatus']) ? test_input($_POST['estatus']) : false;

	$errores = array();
	if(empty($estatus)){
		$errores['estatus'] = "La casilla estatus esta vacia";
	}else{
		$validacion_estatus = true;
	}

	if (count($errores) == 0) {
		
		$funciones->save($estatus);
		header("location:estatus_disponibles.php");
	}else{

		$_SESSION['errores'] = $errores;
		header("location:estatus_disponibles.php");
	}

}