<?php 

require_once 'db.php';


class usuarioFunciones {

	//Metodo para guardar 
	public function Guardar($usuario,$password,$correoElectronico,$tipo,$sucursal){
		
	

		//instancia de la clase conexion
		$conexion = new db();
		//sentencia SQL 
		$sql = "INSERT INTO usuarios(id,nombreUsuario,contraseña,correoElectronico,categorias_id,sucursales_id)VALUES(null,:user,:pass,:email,:catego,:sucursal)";
		//creamos el declaracion
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':user',$usuario);

		$pass = password_hash($password, PASSWORD_DEFAULT);
		
		$stmt->bindValue(':pass',$pass);
		$stmt->bindValue(':email',$correoElectronico);
		$stmt->bindValue(':catego',$tipo);
		$stmt->bindValue(':sucursal',$sucursal);
		

		if($stmt->execute()){
			echo "Registro insertado";
		}else{
			echo "Error en el codigo";
		}

	}


	//Metodo para guardar 
	public function update($id,$usuario,$password,$tipo,$sucursal){
		//instancia de la clase conexion
		$conexion = new db();

		//sentencia SQL 
		$sql = "UPDATE usuarios SET nombreUsuario=:name,contraseña=:pass,categorias_id=:idCategoria,sucursales_id=:idSucursal WHERE id=:id";

		//creamos el declaracion

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$id);
		$stmt->bindValue(':name',$usuario);
		$pass = password_hash($password, PASSWORD_DEFAULT);
		$stmt->bindValue(':pass',$pass);
		$stmt->bindValue(':idCategoria',$tipo);
		$stmt->bindValue(':idSucursal',$sucursal);

		if($stmt->execute()){
			echo "Registro registrado";
		}else{
			echo "Error en el codigo";
		}
	}


	public function mostrarTodo(){
		$conexion = new db();
		$sql = "SELECT * FROM usuarios";
		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



	public function eliminar($id){
		$conexion = new db();
		$sql = "DELETE FROM usuarios WHERE id=:id";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$id);
		
		if($stmt->execute()){
			return "ok";
		}else{
			return "Error en la consulta";
		}
	}

	public function seleccionarPorId($id){

		$conexion = new db();
		$sql = "SELECT us.id,us.nombreUsuario,us.correoElectronico,us.contraseña,ct.nombreCategoria,sc.nombreSucursal,ct.id as idCategoria,sc.id as idSucursal FROM usuarios us
		inner join categorias ct on us.categorias_id = ct.id
		inner join sucursales sc on us.sucursales_id = sc.id WHERE us.id=:ids;";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':ids',$id);
		
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_LAZY);
	}




	public function seleccionarPorUsuario($usuario){


		$conexion = new db();
		$sql = "SELECT * FROM usuarios WHERE nombreUsuario=:usr";


		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':usr',$usuario);
		$stmt->execute();

		$numeroFilas  = $stmt->rowCount();

		if($numeroFilas ==  1){
			return $usuario_repetido = $stmt->fetch(PDO::FETCH_LAZY);
		}else{
			return false;
		}

	}

}






?>