<?php 


require_once 'db.php';


class estatusFunciones{

	public function save($nombreEstatus){
		$conexion = new db();

		$sql = "INSERT INTO estatus(id,nombreEstatus)VALUES(null,:nomEstatus)";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':nomEstatus',$nombreEstatus);
		$validacion_estatus = $stmt->execute();

		if($validacion_estatus){
			return true;
		}else{
			return false;
		}

	}

	public function delete($id){

		$conexion = new db();
		$sql = "DELETE FROM estatus WHERE id=:ids";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':ids',$id);
		$validacion =$stmt->execute();

		if($validacion){
			return true;
		}else{
			return false;
		}


	}
}