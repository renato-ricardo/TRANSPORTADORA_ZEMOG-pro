<?php 

require_once 'includes/helpers.php';
require_once 'includes/estatusFunciones.php';

$funciones = new estatusFunciones();
session_start();


if(isset($_POST)){

	$estatus = isset($_POST['estatus']) ? test_input($_POST['estatus']) : "";

	$errores = array();

	if(empty($estatus)){
		$errores['estatus'] = "La casilla estatus esta vacia";
	}else{
		$estatus_validacion = true;
	}


	if(count($errores) == 0){

		$funciones->save($estatus);
		$_SESSION['completo'] = "Registro Ingresado correctamente";
		header("Location:estatus.php");
	}else{

		$_SESSION['errores'] = $errores;
		header('location:estatus.php');
	}


	var_dump($_POST);
	die();
}