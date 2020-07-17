<?php 

require_once 'includes/detalle_rutas_sucursalFunciones.php';

session_start();

//instancia de clase 

$funcionesDetalleRutas = new detalle_rutas_sucursalFunciones();


if(isset($_POST)){



//captura de datos 
	$sucursal = isset($_POST['sucursales']) ? $_POST['sucursales'] : "";
	$ruta = isset($_POST['rutas']) ? $_POST['rutas'] : "";

//Validamos que nuestro formulario no venga vacio 
	$errores = array();

	if(empty($sucursal)){
		$errores['sucursal'] = "El campo sucursal esta vacio";
	}else{
		$validacion_nombre = true;
	}
	if(empty($ruta)){
		$errores['ruta'] = "El campo ruta esta vacio";
	}else{
		$validacion_nombre = true;
	}



	if(count($errores) == 0){

		$funcionesDetalleRutas->Guardar($sucursal,$ruta);
		$_SESSION['completo'] = "Registro Completado";
		header("Location:compartiRutas.php");
 
	}else{
		$_SESSION['errores'] = $errores;
		header("Location:compartiRutas.php");
	}

}

