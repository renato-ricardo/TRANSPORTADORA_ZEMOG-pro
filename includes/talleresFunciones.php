<?php 

require_once 'db.php';


class talleresFunciones{

	public function save($nombreTaller,$direccion){

		$conexion = new db();
		
		$sql = "INSERT INTO talleres(id,nombre,direccion)VALUES(null,:nom,:direcc)";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':nom',$nombreTaller);
		$stmt->bindValue(':direcc',$direccion);	


		$validacion_taller = $stmt->execute();



		if ($validacion_taller) {
			echo "Registro Insertado";

		}else{
			echo "Error en la sentencia";
		}

	}

	public function update($id,$nombreTaller,$direccionTaller){
		$conexion = new db();
		$sql = "UPDATE talleres SET nombre=:nom,direccion=:dic WHERE id=:ids";
		$stament = $conexion->prepare($sql);
		$stament->bindValue(':ids',$id);
		$stament->bindValue(':nom',$nombreTaller);
		$stament->bindValue(':dic',$direccionTaller);

		$validacion = $stament->execute();

		if($validacion){
			return true;
		}else{
			return false;
		}
	}
	

	public function delete($id){
		$conexion = new db();
		$sql = "DELETE FROM talleres WHERE id=:id";
		$stament = $conexion->prepare($sql);
		$stament->bindValue(':id',$id);

		if($stament->execute()){
			return true;
		}else{
			return false;
		}

	}


	public function seleccionarPorTaller($nombre){
		$conexion = new db();
		$sql = "SELECT * FROM talleres WHERE nombre=:name";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':name',$nombre);

		$validacion_taller = $stmt->execute();


		if ($validacion_taller) {
			return $taller = $stmt->fetch(PDO::FETCH_LAZY);
		}else{
			return false;
		}


	}
	public function seleccionarPorId($id){
		$conexion = new db();
		$sql = "SELECT * FROM talleres WHERE id=:ids";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':ids',$id);

		$validacion_taller = $stmt->execute();


		if ($validacion_taller) {
			return $taller = $stmt->fetch(PDO::FETCH_LAZY);
		}else{
			return false;
		}


	}
}