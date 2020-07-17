<?php 

require_once 'db.php';

class marcasFunciones {


	public function save($marca){
		$conexion = new db();

		$sql = "INSERT INTO marcas_Unidades(id,nombreMarca)VALUES(null,:marca)";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':marca',$marca);
		$validacion = $stmt->execute();

		if($validacion){
			return true;
		}else{
			return false;
		}
	}

	public function marcasRepetidas($marca){
		$conexion = new db();

		$stmt = $conexion->prepare("SELECT * FROM marcas_Unidades WHERE nombreMarca=:marca");
		$stmt->bindValue(':marca',$marca);
		$validacion = $stmt->execute();

		if ($validacion) {
			return $datos = $stmt->fetch(PDO::FETCH_LAZY);
		}else{
			return false;
		}
	}
}

