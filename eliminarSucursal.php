<?php 

require_once 'includes/sucursalFunciones.php';

session_start();

//instancia de clase 

$funciones = new sucursalFunciones();



if(isset($_GET)){

	//recuperamos
	$id = $_GET['id'];

	if($funciones->eliminar($id)){
		$_SESSION['completado'] = "Registro Eliminado";
		header("Location:sucursal.php");
	}
	

}



?>