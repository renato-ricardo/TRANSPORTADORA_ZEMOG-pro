<?php 

require_once 'db.php';

class loginFunciones {

	public function mostrarDatosUsuarios($usuario){
		$conexion = new db();
		$sql = "SELECT us.id,us.nombreUsuario,us.correoElectronico,ct.nombreCategoria,sc.nombreSucursal,sc.id as idSucursal from usuarios us
				inner join categorias ct on us.categorias_id = ct.id
				inner join sucursales sc on us.sucursales_id = sc.id WHERE us.nombreUsuario=:usr;";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':usr',$usuario);
		$validacion = $stmt->execute();

		if($validacion){
			$listaUsuarios = $stmt->fetch(PDO::FETCH_LAZY);

			$arreglo = array(
				"id"=>$listaUsuarios['id'],
				"usuario"=>$listaUsuarios['nombreUsuario'],
				"correoElectronico"=>$listaUsuarios['correoElectronico'],
				"nombreSucursal"=>$listaUsuarios['nombreSucursal'],
				"sucursal"=>$listaUsuarios['idSucursal'],
				"nombreCategoria"=>$listaUsuarios['nombreCategoria']
			);

			$_SESSION['usuario'] = $arreglo;

			return true;

		}else{
			return false;
		}

	}
	//Comentarios de pruebas
	public function seleccionarPorUsuario($usuario,$password){

		$conexion = new db();
		$sql = "SELECT * FROM usuarios WHERE nombreUsuario=:usuario";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':usuario',$usuario);
		
		$stmt->execute();



		$numeroFilas = $stmt->rowCount();

		if($numeroFilas == 1){	
		
			$listaUsuarios = $stmt->fetch(PDO::FETCH_LAZY);

		
			$validacion = password_verify($password, $listaUsuarios['contraseña']);



			$arreglo = array(
				"id"=>$listaUsuarios['id'],
				"usuario"=>$listaUsuarios['nombreUsuario'],
				"contraseña"=>$listaUsuarios['contraseña'],
				"correoElectronico"=>$listaUsuarios['correoElectronico'],
				"categoria" => $listaUsuarios['categorias_id'],
				"sucursal" => $listaUsuarios['sucursales_id']
			);
			

			if($validacion){
				$_SESSION['user'] = $arreglo;
				return true;
			}
			
			
		}else{
			return false;
			
		}

		
	}

}

