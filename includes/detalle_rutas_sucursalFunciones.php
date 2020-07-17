<?php 

require_once 'db.php';

class detalle_rutas_sucursalFunciones {

	//Metodo para guardar 
	public function Guardar($sucursal,$ruta){
		//instancia de la clase conexion
		$conexion = new db();
		//sentencia SQL 
		$sql = "INSERT INTO detalle_rutas_sucursales (sucursal_id,ruta_id)VALUES(:id_sucursal,:id_rutas)";

		//creamos el declaracion

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id_sucursal',$sucursal);
		$stmt->bindValue(':id_rutas',$ruta);
		

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


	public function mostrarTodo($tabla){
		$conexion = new db();
		$sql = "SELECT * FROM $tabla WHERE ";
		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public function mostrarTodos(){
		$conexion = new db();
		$sql = "SELECT sc.nombre AS 'Sucursal',rt.nombre AS 'Ruta' FROM detalle_rutas_sucursales dts
		INNER join sucursales sc ON dts.sucursal_id = sc.id
		INNER join rutas rt ON dts.ruta_id = rt.id";

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



