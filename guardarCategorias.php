<?php

require_once 'includes/categoriaFunciones.php';
require_once 'includes/helpers.php';

if(isset($_POST)){

$categoria = new categoriaFunciones();


$nombreCategoria = isset($_POST['categoria']) ? test_input($_POST['categoria']) : "";


$errores = array();

if(empty($nombreCategoria)){
	$errores ['nombreCategoria'] = "La Casilla Categoria esta vacia";
}else{
	$validacion_categoria = true;
}

if(count($errores) == 0){

	$categoria->save($nombreCategoria);

	$_SESSION['completado'] = "Registro Completado";
	header("Location:categorias.php");

}else{

	$_SESSION['errores'] = $errores;
	header("Location:categorias.php");
}


}




