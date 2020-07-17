<?php 

require_once 'includes/rutasFunciones.php';

session_start();

//instancia de clase 

$funcionesRutas = new rutasFunciones();


if(isset($_GET)){

	//recuperamos
	$id = $_GET['id'];

	if($funcionesRutas->eliminar($id)){
		$_SESSION['completado'] = "Registro Eliminado";
		header("Location:rutas.php");
	}
	

}



?>