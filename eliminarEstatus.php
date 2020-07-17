<?php 

require_once 'includes/estatusFunciones.php';

$funciones = new estatusFunciones();

if (isset($_GET)) {
	
	$id = $_GET['id'];


	$funciones->delete($id);

	header("location:estatus.php");


}