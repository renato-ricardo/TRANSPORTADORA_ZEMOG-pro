<?php 

require_once 'db.php';

class sucursalFunciones {

	//Metodo para guardar 
	public function Guardar($nombre,$direccion,$telefono,$operaciones_id){
		//instancia de la clase conexion
		$conexion = new db();
		//sentencia SQL 
		$sql = "INSERT INTO sucursales(id,nombreSucursal,direccion,telefono,operaciones_id)VALUES(null,:nombre,:direc,:tel,:oper_id)";

		//creamos el declaracion

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':nombre',$nombre);
		$stmt->bindValue(':direc',$direccion);
		$stmt->bindValue(':tel',$telefono);
		$stmt->bindValue(':oper_id',$operaciones_id);
		
		$validacion = $stmt->execute();

	
		if($validacion){
			return true;
		}else{
			return false;
		}
	}

	//Metodo para guardar 

	public function Actualizar($id,$nombre,$direccion,$telefono,$numeroLocalidad,$operacion){
		//instancia de la clase conexion
		$conexion = new db();
		//sentencia SQL 
		$sql = "UPDATE sucursales SET nombreSucursal=:name,direccion=:direc,telefono=:tel,numeroLocalidad=:localidad,operaciones_id=:ope WHERE id=:id";

		//creamos el declaracion

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$id);
		$stmt->bindValue(':name',$nombre);
		$stmt->bindValue(':direc',$direccion);
		$stmt->bindValue(':tel',$telefono);
		$stmt->bindValue(':localidad',$numeroLocalidad);
		$stmt->bindValue(':ope',$operacion);
		
		if($stmt->execute()){
			echo "Registro Actualizado";
		}else{
			echo "Error en el codigo";
		}
	}


	public function mostrarTodo(){
		$conexion = new db();
		$sql = "SELECT * FROM sucursales";
		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



	public function eliminar($id){
		$conexion = new db();
		$sql = "DELETE FROM sucursales WHERE id=:id";
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
		$sql = "SELECT * FROM sucursales WHERE id=:id";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$id);
		
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_LAZY);
	}

}






?>