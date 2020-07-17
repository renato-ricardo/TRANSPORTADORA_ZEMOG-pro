<?php 

require_once 'includes/rutasFunciones.php';

session_start();

//instancia de clase 

$funcionesRutas = new rutasFunciones();


if(isset($_POST)){

//captura de datos 
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";

//Validamos que nuestro formulario no venga vacio 
	$errores = array();

	if(empty($nombre)){
		$errores['nombre'] = "El campo nombre esta vacio";
	}else{
		$validacion_nombre = true;
	}


	if(count($errores) == 0){

		$funcionesRutas->Guardar($nombre);
		$_SESSION['completo'] = "Registro Completado";
		header("Location:rutas.php");
 
	}else{
		$_SESSION['errores'] = $errores;
		header("Location:rutas.php");
	}

}



?>