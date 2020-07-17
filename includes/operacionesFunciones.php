<?php 


require_once 'db.php';

class operacionesFunciones{


	public function save($operacion){

		$conexion = new db();
		$sql ="INSERT INTO operaciones(id,nombreOperacion)VALUES(null,:nomOperacion)";

		$stament = $conexion->prepare($sql);

		$stament->bindValue(':nomOperacion',$operacion);
		$validacion = $stament->execute();

		if($validacion){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		
		$conexion = new db();
		$sql = "DELETE FROM operaciones WHERE id=:ids";

		$stament = $conexion->prepare($sql);
		$stament->bindValue(':ids',$id);
		$validacionDelete  = $stament->execute();

		if($validacionDelete){
			return true;
		}else{
			return false;
		}

	}

	public function update($id,$nombreOperaciones){
		$conexion = new db();

		$sql = "UPDATE operaciones SET nombreOperacion=:nomOpe WHERE id=:ids";
		
		$stament = $conexion->prepare($sql);

	
		$stament->bindValue(":ids",$id);
		$stament->bindValue(":nomOpe",$nombreOperaciones);

		$validacion = $stament->execute();

		if($validacion){
			return true;
		}else{
			return false;
		}

	}

	public function seleccionarPorId($id){

		$conexion = new db();

		$sql = "SELECT * FROM operaciones WHERE id=:ids";

		$stament = $conexion->prepare($sql);

		$stament->bindValue(':ids',$id);

		$validacion = $stament->execute();

		if($validacion){
			return $stament->fetch(PDO::FETCH_LAZY);
		}else{
			return false;
		}

	}

}