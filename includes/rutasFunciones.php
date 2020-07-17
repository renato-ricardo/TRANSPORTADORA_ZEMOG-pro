<?php 

require_once 'db.php';



class rutasFunciones {

	//Metodo para guardar 
	public function Guardar($nombre){
		//instancia de la clase conexion
		$conexion = new db();
		//sentencia SQL 
		$sql = "INSERT INTO rutas(id,nombre)VALUES(null,:nombre)";

		//creamos el declaracion

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':nombre',$nombre);
		

		if($stmt->execute()){
			echo "Registro insertado";
		}else{
			echo "Error en el codigo";
		}
	}

	//Metodo para guardar 
	public function Actualizar($id,$nombre){
		//instancia de la clase conexion
		$conexion = new db();
		//sentencia SQL 
		$sql = "UPDATE sucursales SET nombre=:name WHERE id=:id";

		//creamos el declaracion

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$id);
		$stmt->bindValue(':name',$nombre);
		

		if($stmt->execute()){
			echo "Registro registrado";
		}else{
			echo "Error en el codigo";
		}
	}


	public function mostrarTodo(){
		$conexion = new db();
		$sql = "SELECT * FROM rutas";
		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



	public function eliminar($id){
		$conexion = new db();
		$sql = "DELETE FROM rutas WHERE id=:id";
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
		$sql = "SELECT * FROM rutas WHERE id=:id";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$id);
		
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_LAZY);
	}

	

}






?>