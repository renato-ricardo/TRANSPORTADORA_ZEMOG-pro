<?php 


require_once 'includes/funcionesDisponibilidad.php';
session_start();

$funciones = new funcionesDisponibilidad();


if(isset($_GET)){

	$id = $_GET['id'];

	$validacionEliminacion = $funciones->delete($id);

	if($validacionEliminacion){
		
		$_SESSION['completado'] = "Registro Eliminado";
		header("location:disponibilidad.php");
		return true;
	}else{
		$_SESSION['completado'] = "No se puedo Eliminar el registro";
		header("location:disponibilidad.php");
		return false;
	}

}



