<?php 

require_once 'includes/sucursalFunciones.php';
require_once 'includes/helpers.php';

session_start();

//instancia de clase 

$funciones = new sucursalFunciones();


if(isset($_POST)){


//captura de datos 
	$nombre = isset($_POST['nombre']) ? test_input($_POST['nombre']) : "";
	$direccion = isset($_POST['direccion']) ? test_input($_POST['direccion']) : "";
	$telefono = isset($_POST['telefono']) ? test_input($_POST['telefono']) : "";
	$operaciones = isset($_POST['operaciones']) ? test_input($_POST['operaciones']) : "";

//Validamos que nuestro formulario no venga vacio 
	$errores = array();

	if(empty($nombre)){
		$errores['nombre'] = "El campo nombre esta vacio";
	}else{
		$validacion_nombre = true;
	}

	
	if(count($errores) == 0){

		$funciones->Guardar($nombre,$direccion,$telefono,$operaciones);
		$_SESSION['completo'] = "Registro Completado";
		header("Location:sucursal.php");
 		
	}else{
		$_SESSION['errores'] = $errores;
		header("Location:index.php");
	}

}



?>