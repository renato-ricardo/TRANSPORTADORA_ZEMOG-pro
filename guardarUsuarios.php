<?php 

require_once 'includes/usuarioFunciones.php';
require_once 'includes/helpers.php';

session_start();

//instancia de clase 

$funciones = new usuarioFunciones();


if(isset($_POST)){

//captura de datos 
	$usuario = isset($_POST['usuario']) ?  test_input($_POST['usuario']) : "";
	$password = isset($_POST['contraseña']) ? test_input($_POST['contraseña']) : "";
	$sucursal = isset($_POST['Sucursales']) ? test_input($_POST['Sucursales']) : "";
	$tipo = isset($_POST['tipo']) ? test_input($_POST['tipo']) : "";
	$correo = isset($_POST['correo']) ? test_input($_POST['correo']) : "";	

//Validamos que nuestro formulario no venga vacio 
	$errores = array();


	if(empty($usuario)){
		$errores['usuario'] = "Casilla de usuario esta vacio";
	}else{
		$validacion_usuario = true;
	}

	if(empty($password)){
		$errores['contraseña'] = "Casilla de Contraseña vacia";
	}else{
		$validacion_password = true;
	}
	
	if($sucursal === "Selecciona una categoria"){
		$errores['sucursal'] = "Selecciona una sucursal Valida";
	}else{
		$validacion_sucursal = true;
	}

	if($tipo == "Selecciona una categoria"){
		$errores['tipo'] = "Seleccione un Permiso";
	}else{
		$validacion_tipo = true;
	}

	if(empty($correo)){
		$errores['correo'] = "Casilla de correo incorrecta";
	}else{
		$validacion_correo = true;
	}

	

	if(count($errores) == 0){

		$validacion_usuarios_repetido = $funciones->seleccionarPorUsuario($usuario);

		if(!empty($validacion_usuarios_repetido)){
			$_SESSION['registroRepetido'] = "No puedes Agregar ese usuario por ya se encuentra dado de alta";
			header("location:usuarios.php");
			exit();
		}else{

		$funciones->Guardar($usuario,$password,$correo,$tipo,$sucursal);
		$_SESSION['completo'] = "Registro Ingresado Correctamente !!!";
		header("Location:usuarios.php");
 		
 		}

	}else{

		$_SESSION['errores'] = $errores;
		header("Location:usuarios.php");
	}

}



?>