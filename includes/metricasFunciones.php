<?php 
require_once 'db.php';


class metricasFunciones{

	public function mostrarDatos(){
        $conexion = new db();
        //Sentencias SQL https://www.youtube.com/watch?v=j9jMrvO7fRc&list=PLWYKfSbdsjJjW0poXgI5awIxuAjXZ1oGW
		$sql = "SELECT 
		op.nombreOperacion,
		sc.nombreSucursal,(
		SELECT COUNT(uni.economico) FROM unidades uni
		WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id) as NUMERO_TOTAL_UNIDADES,
		COUNT(IF(dp.estatus_Taller='Taller',1,NULL)) AS TALLER,
		ROUND((COUNT(IF(dp.estatus_Taller='Taller',1,NULL)) / (
		SELECT COUNT(uni.economico) FROM unidades uni
		WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id)  )*100) AS '%HOY_TALLER',
		COUNT(IF(dp.estatus_Taller='Consignados',1,NULL)) AS CONSIGNADOS,
		ROUND((COUNT(IF(dp.estatus_Taller='Consignados',1,NULL)) / (
		SELECT COUNT(uni.economico) FROM unidades uni
		WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id) )*100) AS '%HOY_CONSIGNADOS',
		COUNT(IF(dp.estatus_Taller='Siniestro',1,NULL)) AS SINIESTRO,
		ROUND((COUNT(IF(dp.estatus_Taller='Siniestro',1,NULL)) / (
		SELECT COUNT(uni.economico) FROM unidades uni
		WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id) )*100) AS '%HOY_SINIESTRO',
		COUNT(IF(dp.estatus_id!=9 AND dp.estatus_id!=10,1,NULL)) AS TOTAL_DE_DETENIDAS,
		((SELECT COUNT(uni.economico) FROM unidades uni
		WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id) -  COUNT(IF(dp.estatus_id!=9 AND dp.estatus_id!=10,1,NULL))) AS 'DISPONIBLES',
		ROUND(((SELECT COUNT(uni.economico) FROM unidades uni WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id) - COUNT(IF(dp.estatus_id!=9 AND dp.estatus_id!=10,1,NULL))) / (SELECT COUNT(uni.economico) FROM unidades uni WHERE uni.mad = 'MOTRIZ' AND sc.id = uni.sucursales_id) *100) AS '%HOY'FROM disponibilidad dp
		RIGHT JOIN unidades uni ON uni.id = dp.unidades_id
		RIGHT JOIN sucursales sc ON sc.id =uni.sucursales_id
		RIGHT JOIN operaciones op ON op.id = uni.operaciones_id
		WHERE op.id != 1 AND op.id != 4 AND op.id !=6
		GROUP BY sc.nombreSucursal ORDER BY op.nombreOperacion,sc.nombreSucursal ASC";


		$staments = $conexion->query($sql);
		$staments->execute();
		return $staments->fetchAll(PDO::FETCH_ASSOC);
    }
	public function mostrarRemolques(){
        $conexion = new db();
        //Sentencias SQL 
		$sql = "SELECT operaciones.nombreOperacion AS OPERACION,
		sc.nombreSucursal AS SUCURSALES, COUNT(dp.estatus_id) AS DETENIDAS, 
		COUNT(uni.economico) - COUNT(dp.estatus_id) AS 'DISPONIBLES',
		COUNT(uni.economico) AS TOTAL_UNIDADES, 
		ROUND(((COUNT(uni.economico) - (COUNT(dp.estatus_id))) / COUNT(dp.estatus_id)))AS '% PORCENTAJE DISPONIBLE' 
		FROM unidades uni RIGHT JOIN sucursales sc ON sc.id = uni.sucursales_id 
		LEFT JOIN operaciones ON operaciones.id = sc.operaciones_id 
		LEFT JOIN disponibilidad dp ON dp.unidades_id = uni.id 
		INNER JOIN operaciones op ON op.id = sc.operaciones_id 
		WHERE operaciones.id != 1 AND operaciones.id != 6 AND uni.mad != 'MOTRIZ' 
		GROUP BY sc.nombreModelo ORDER BY `DETENIDAS`,OPERACION DESC;";


		$staments = $conexion->query($sql);
		$staments->execute();
		return $staments->fetchAll(PDO::FETCH_ASSOC);
	}

	public function mostrarEstatus(){
        $conexion = new db();
        //Sentencias SQL 
		$sql = "SELECT uni.economico AS ECONOMICO,sc.nombreModelo AS OPERACION,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.estatus_Taller AS ESTATUS,
		if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,
		es.nombreEstatus
		FROM disponibilidad dp
		inner join unidades uni on dp.unidades_id = uni.id
		inner join sucursales sc on uni.sucursales_id = sc.id
		inner join estatus es on dp.estatus_id = es.id
		inner join operaciones op on sc.operaciones_id = op.id 
		WHERE dp.estatus_id != 10 AND dp.estatus_id != 9
		order by DiasFuera desc LIMIT 10;";


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
}




?>