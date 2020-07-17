<?php 

require_once 'includes/unidadesFunciones.php';

$funciones = new unidadesFunciones();



	$id = isset($_POST['id']) ? $_POST['id'] : "";

	$placas = isset($_POST['placas']) ? $_POST['placas'] : "";
	$estatus = isset($_POST['estatus']) ? $_POST['estatus'] : "";
	$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : "";
	$sucursal = isset($_POST['Sucursales_id']) ? $_POST['Sucursales_id'] : "";
	$iave = isset($_POST['iave']) ? $_POST['iave'] : "";
	$imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "";



	$imagenPredeterminada = "default.jpg";

	$fechaSubida = new DateTime();//objeto fecha

	$nombreArchivo = !empty($imagen) ? $fechaSubida->getTimestamp()."_".$_FILES['imagen']['name'] : $imagenPredeterminada;


	$tmp_name = $_FILES['imagen']['tmp_name'];
	
		if ($tmp_name != "") {
			move_uploaded_file($tmp_name, "assent/img/".$nombreArchivo);

		}


		$validacion = $funciones->actualizar($id,$placas,$estatus,$operacion,$sucursal,$iave,$nombreArchivo);


		if ($validacion) {
			header("location:unidades.php");
		}else{
			echo "Revisa tu funciones";
			die();
		}