<?php 
require_once 'db.php';


class unidadesFunciones{


	//funcion para guardar Registros 
	public function guardarUnidad($economico,$serie,$placas,$mad,$modelo,$iave,$marca_id,$usuarios_id,$sucursales_id,$estatus_disponible_id,$operaciones_id,$imagen,$url){


		//instancai de conexion 
		$conexion  = new db();
		//creamos nuestra sentencia SQL 
		$sql = "INSERT INTO unidades(economico,serie,placas,mad,modelo,iave,marca_id,usuarios_id,sucursales_id,estatus_disponible_id,operaciones_id,imagen,url)VALUES(:eco,:ser,:placa,:md,:medlo,:ive,:idMarca,:idUsuario,:idSucursal,:idEstatus,:idOperaciones,:img,:urls)";
		//creamos nuestra tabla virtual o staments

		$staments = $conexion->prepare($sql);

		$staments->bindValue(':eco',$economico);
		$staments->bindValue(':ser',$serie);
		$staments->bindValue(':placa',$placas);
		$staments->bindValue(':md',$mad);
		$staments->bindValue(':medlo',$modelo);
		$staments->bindValue(':ive',$iave);
		$staments->bindValue(':idMarca',$marca_id);
		$staments->bindValue(':idUsuario',$usuarios_id);
		$staments->bindValue(':idSucursal',$sucursales_id);
		$staments->bindValue(':idEstatus',$estatus_disponible_id);
		$staments->bindValue(':idOperaciones',$operaciones_id);
		$staments->bindValue(':img',$imagen);
		$staments->bindValue(':urls',$url);

		$validacion = $staments->execute();

		if($validacion){
			$conexion = null;
			$staments=null;
			echo "Registro Insertado";
		}else{
			echo "Error en la parte de la base de datos";
		}
	}

	public function mostrarDatos(){
		$conexion = new db();
		$sql = "SELECT * FROM unidades";
		$staments = $conexion->query($sql);
		$staments->execute();
		return $staments->fetchAll(PDO::FETCH_ASSOC);
	}

	public function eliminar($id){
		$conexion = new db();

		$imagenPredeterminada = "default.jpg";

		$sqlBuscar = "SELECT imagen FROM unidades WHERE id=:ids";

		$stmt = $conexion->prepare($sqlBuscar);
		$stmt->bindValue(':ids',$id);
		$stmt->execute();

		$datosUnidades = $stmt->fetch(PDO::FETCH_LAZY);

		if (isset($datosUnidades['imagen'])) {
			if (file_exists("assent/img/".$datosUnidades['imagen'])) {			
				unlink("assent/img/".$datosUnidades['imagen']);
			}else{
				echo "<script>alert('El archivo no existe ');</script>";

			}
		}

		$sql = "DELETE FROM unidades WHERE id=:id";
		$staments = $conexion->prepare($sql);
		$staments->bindValue(':id',$id);

		if($staments->execute()){
			return "ok";
		}else{
			return "Error en la consulta";
		}
	}
	//funcion para guardar Registros 

	public function actualizar($id,$placas,$estatus,$operacion,$sucursal,$iave,$imagen=null){
		//instancai de conexion 
		$conexion  = new db();
		//creamos nuestra sentencia SQL 
		$sql = "UPDATE unidades SET placas=:placa,estatus_disponible_id=:idDisponible,operaciones_id=:idOperaciones,sucursales_id=:idSucursal,iave=:ia WHERE id=:ids";
		//creamos nuestra tabla virtual o staments

		$staments = $conexion->prepare($sql);
		$staments->bindValue(':ids',$id);
		$staments->bindValue(':placa',$placas);
		$staments->bindValue(':idDisponible',$estatus);
		$staments->bindValue(':idOperaciones',$operacion);
		$staments->bindValue(':idSucursal',$sucursal);
		$staments->bindValue(':ia',$iave);
		
		$validacionPrimaria = $staments->execute();
		


		$sql = "SELECT imagen FROM unidades WHERE id=:ids";
		$staments = $conexion->prepare($sql);
		$staments->bindValue(':ids',$id);
		$validacionSecundario = $staments->execute();
		if ($validacionSecundario) {

			$unidad = $staments->fetch(PDO::FETCH_LAZY);
		}



		if (isset($unidad['imagen'])) {

		if (file_exists("assent/img/".$unidad['imagen'])) {			
				unlink("assent/img/".$unidad['imagen']);
			}else{
				echo "<script>alert('El archivo no existe ');</script>";
				
			}
		}
	
		$url = "assent/img/".$imagen;

		$SqlImgen = "UPDATE unidades SET imagen=:img,url=:urls WHERE id=:ids";

		$staments = $conexion->prepare($SqlImgen);
		$staments->bindValue('ids',$id);
		$staments->bindValue('img',$imagen);
		$staments->bindValue('urls',$url);

		$validacionImangen = $staments->execute();


		if($validacionImangen){
			return true;
		}else{
			return false;
		}
	}	


	public function seleccionarPorId($id){
		$conexion = new db();

		$sql = "SELECT uni.id as IdUnidad,uni.economico,uni.serie,uni.placas,uni.mad,uni.modelo,uni.iave,mac.nombreMarca,mac.id as idMarca,sc.nombreSucursal,sc.id as idSucursal,op.nombreOperacion,op.id as idOperacion,dp.nombreEstatus,dp.id as idEstatus,uni.imagen,uni.url from unidades uni
		inner join marcas_unidades mac on uni.marca_id = mac.id
		inner join estatus_disponible dp on uni.estatus_disponible_id = dp.id
		inner join sucursales sc on uni.sucursales_id = sc.id 
		inner join operaciones op on uni.operaciones_id = op.id WHERE uni.id=:ids;";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':ids',$id);
		$validacion = $stmt->execute();

		if ($validacion) {
		
			return $datos = $stmt->fetch(PDO::FETCH_LAZY);

		}else{

			return false;
		}

	}

	public function numeroElementos($mad){
		$conexion  = new db();
		$sql = "select * from unidades WHERE mad =:md;";

		$staments = $conexion->prepare($sql);

		$staments->bindValue(':md',$mad);

		$staments->execute();

		$numeroElementos = $staments->rowCount();
		
		$conexion = null;
		$staments = null;

		return $numeroElementos;
	}


	public function UnidadesDetenidas(){
		$conexion  = new db();
		$sql = "SELECT sc.nombreModelo as 'Sucursal' , count(es.nombreEstatus) as unidadesDetenidas
		from disponibilidad dp
		inner join estatus es on dp.estatus_id = es.id
		inner join unidades uni on dp.unidades_id = uni.id
		inner join sucursales sc on uni.sucursales_id = sc.id 
		Where es.id != 9 and es.id != 10 group by sc.nombreSucursal order by unidadesDetenidas;";

		$staments = $conexion->prepare($sql);

		$staments->execute();

		return $staments->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function UnidadesSucursal(){
		$conexion  = new db();
		$sql = "SELECT sc.nombreModelo as Nombre_Modelo, sc.nombreSucursal as Nombre_Sucursal ,  count(uni.economico) as Numero_Unidades from unidades uni 
		inner join sucursales sc on uni.sucursales_id = sc.id group by sc.nombreSucursal order by Numero_Unidades ;";

		$staments = $conexion->prepare($sql);

		$staments->execute();

		return $staments->fetchAll(PDO::FETCH_ASSOC);
	}
}




?>