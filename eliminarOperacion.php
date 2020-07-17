<?php 


require_once 'includes/operacionesFunciones.php';

session_start();

$funciones = new operacionesFunciones();

if(isset($_GET)){

	$id= $_GET['id'];

	$funciones->delete($id);

	header("location:operaciones.php");



}