<?php 

require_once 'includes/marcaFunciones.php';
require_once 'includes/helpers.php';
$funciones = new marcasFunciones();
session_start();

if(isset($_POST)){

	$marca = isset($_POST['marca']) ? test_input($_POST['marca']) : "";
	
	$errores = array();

	if(empty($marca)){
		$errores['marca'] = "La casilla marca esta vacia ";
 	}else{
 		$validacion_marca = true;
 	}


 	if (count($errores)== 0) {
 		
 		

 		$dato = $funciones->marcasRepetidas($marca);

 		if(!empty($dato)){
 			$_SESSION['registroRepetido'] ="Marca Repetida !!!";
 			header("location:marcaUnidades.php");
 			exit();
 		}else{
 			$_SESSION['completo'] = "Registro Ingresado Correctamente";
 			$funciones->save($marca);
 			header("location:marcaUnidades.php");
 		}

 	}else{
		$_SESSION['errores'] = $errores;
		header("Location:marcaUnidades.php");
 	}

	var_dump($_POST);
	die();
}