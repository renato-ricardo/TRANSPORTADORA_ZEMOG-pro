<?php 

require_once 'includes/loginFuciones.php';

session_start();


$funciones = new loginFunciones();



if (isset($_POST)) {

	$usuario = isset($_POST['txtUsuarios']) ? $_POST['txtUsuarios'] : "";
	$password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : "";

	$validacion = $funciones->seleccionarPorUsuario($usuario,$password);
	$datos = $funciones->mostrarDatosUsuarios($usuario);


	if($validacion){
		header("Location:inicio.php");
	}else{
		header("Location:index.php");
	}



}


