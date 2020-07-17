<?php 

require_once 'includes/usuarioFunciones.php';

session_start();

//instancia de clase 

$funciones = new usuarioFunciones();


if(isset($_GET)){

	//recuperamos
	$id = $_GET['id'];

	if($funciones->eliminar($id)){
		$_SESSION['completado'] = "Registro Eliminado";
		header("Location:usuarios.php");
	}
	

}



?>