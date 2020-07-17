<?php 

require_once 'includes/unidadesFunciones.php';
require_once 'includes/helpers.php';
session_start();

$unidadesFunciones = new unidadesFunciones();



if(isset($_POST)){


	$economico = isset($_POST['economico']) ? test_input($_POST['economico']) : "";
	$serie = isset($_POST['serie']) ? test_input($_POST['serie']) : "";
	$placas = isset($_POST['placas']) ? test_input($_POST['placas']) : "";
	$marca_id = isset($_POST['marca']) ? test_input($_POST['marca']) : "";
	$modelo = isset($_POST['modelo']) ? test_input($_POST['modelo']) : "";
	$estatus_disponible_id = isset($_POST['estatus']) ? test_input($_POST['estatus']) : "";
	$usuarios_id = isset($_POST['Usuarios_id']) ? test_input($_POST['Usuarios_id']) : "";
	$sucursales_id = isset($_POST['Sucursales_id']) ? test_input($_POST['Sucursales_id']) : "";
	$mad = isset($_POST['mad']) ? test_input($_POST['mad']) : "";	
	$tipo = isset($_POST['tipo']) ? test_input($_POST['tipo']) : "";
	$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : false;
	$iave = isset($_POST['iave']) ? test_input($_POST['iave']) : false;
	$operaciones_id = isset($_POST['operaciones_id']) ? test_input($_POST['operaciones_id']) : false;

	$errores = array();
	//validacion de datos 

	$imagenPredeterminada = "default.jpg";
	$fechaSubida = new DateTime();//objeto fecha
	$nombreArchivo = !empty($imagen) ? $fechaSubida->getTimestamp()."_".$_FILES['imagen']['name'] : $imagenPredeterminada;
	$tmp_name = $_FILES['imagen']['tmp_name'];
	
		if ($tmp_name != "") {
			move_uploaded_file($tmp_name, "assent/img/".$nombreArchivo);
		}

		$urlImagen = "assent/img/".$nombreArchivo;

		if(count($errores) == 0){

			$unidadesFunciones->guardarUnidad($economico,$serie,$placas,$mad,$modelo,$iave,$marca_id,$usuarios_id,$sucursales_id,$estatus_disponible_id,$operaciones_id,$nombreArchivo,$urlImagen);

			header("Location:unidades.php");

		}else{

			$_SESSION['errores'] = $errores;
			header("Location:unidades.php");
		}

}


?>