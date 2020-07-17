<?php 

require_once 'includes/unidadesFunciones.php';
session_start();
$funciones = new unidadesFunciones();

if(isset($_GET)){

	$id = $_GET['id'];

	if(!empty($id)){
		$funciones->eliminar($id);

		header("Location:unidades.php");
	}else{
		
	}
}