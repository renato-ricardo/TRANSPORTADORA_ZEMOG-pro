<?php 

require_once 'includes/helpers.php';
require_once 'includes/operacionesFunciones.php';

session_start();

$funciones = new operacionesFunciones();

if(isset($_POST)){

	$operacion = isset($_POST['operacion']) ? test_input($_POST['operacion']) : "";


	$errores = array();

	if(empty($operacion)){
		$errores['operacion'] = "El cuadro de texto operacion esta vacio ";
 	}else{
 		$operacion_validacion = true;
 	}



 	if(count($errores) == 0){

 		$_SESSION['completo'] = "Registro Operaciones Ingresado Correctamente !!!";
 		$funciones->save($operacion);
 		header("location:operaciones.php");

 	}else{

 		$_SESSION['errores'] = $errores;
 		header('location:operaciones.php');
 	}


}


