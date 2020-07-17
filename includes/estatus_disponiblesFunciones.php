<?php 


require_once 'db.php';


class estatus_disponiblesFunciones{

	public function save($nombreEstatus){
		$conexion = new db();
		$sql = "INSERT INTO estatus_disponible (id,nombreEstatus) VALUES(null,:nombre)";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':nombre',$nombreEstatus);
		$validacion = $stmt->execute();

		if($validacion){
			return true;
		}else{
			return false;
		}

	}

	public function delete($id){
		$conexion = new db();
		$sql = "DELETE FROM estatus_disponible WHERE id=:ids ";
		$stmt = $conexion->prepare($sql);
		$validacion = $stmt->execute();
		
		if($validacion){
			return true;
		}else{
			return false;
		}		
	}

}

