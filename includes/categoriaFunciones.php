<?php 


require_once 'db.php';

class categoriaFunciones{
	public function save($nombreCategoria){

		$conexion = new db();
		
		$sql = "INSERT INTO categorias(id,nombreCategoria)VALUES(null,:nomCategoria)";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':nomCategoria',$nombreCategoria);

		$validacion = $stmt->execute();

		if($validacion){
			echo "Registro Insertado";
		}else{
			echo "Error en el codigo";
		}
	}


}