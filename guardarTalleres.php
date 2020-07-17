<?php 

require_once 'includes/talleresFunciones.php';
require_once 'includes/helpers.php';

session_start();

$talleresFunciones = new talleresFunciones();


if(isset($_POST)){

	$nombreTaller = isset($_POST['nombreTaller']) ? test_input($_POST['nombreTaller']) : "";
	$direccionTaller = isset($_POST['direccionTaller']) ? test_input($_POST['direccionTaller']) : "";

	$errores = array();

	if(empty($nombreTaller)){
		$errores['tallerNombre'] = "La casilla Taller se encuentra vacia";
	}else{
		$validacion_taller  = true;
	}

	if(empty($direccionTaller)){
		$errores['direccionTaller'] = "La casilla de Direccion se encuentra vacia";
	}else{
		$validacion_direccion = true;
	}



	if(count($errores) == 0){

		$taller_duplicado = $talleresFunciones->seleccionarPorTaller($nombreTaller);

		if (!empty($taller_duplicado)) {
			$_SESSION['registroRepetido'] = "Taller Repetido !!! ";
			header('location:talleres.php');
			exit();
		}else{

		$talleresFunciones->save($nombreTaller,$direccionTaller);
		$_SESSION['completo'] = "Registros Ingresados Correctamente !!!";
		header("Location:talleres.php");
		}
		
	}else{

		$_SESSION['errores'] = $errores;
		header("Location:talleres.php");
	}


}

