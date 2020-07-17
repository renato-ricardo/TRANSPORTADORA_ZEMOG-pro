
<?php

require_once 'db.php';

class funcionesDisponibilidad{


	public function save($fechaIngreso,$fechaPromesa,$fechaEntrega,$motivo,$descripcionFalla,$folioReporte,$costoReparacion,$estatus_id,$talleres_id,$unidades_id){
	
		$conexion = new db();

	
		$sql = "INSERT INTO `disponibilidad` (`id`, `fechaIngreso`, `fechaPromesa`, `fechaEntrega`, `motivo`, `descripcionFalla`, `folioReporte`, `costoReparacion`, `estatus_id`, `talleres_id`, `unidades_id`) VALUES (NULL,:fechaInicio,:fechaPro,:fechaEn,:mot,:comentario,:folio,:costo,:status,:taller,:unidad);";


		$stmt = $conexion->prepare($sql);

		$stmt->bindValue(':fechaInicio',$fechaIngreso);
		$stmt->bindValue(':fechaPro',$fechaPromesa);
		$stmt->bindValue(':fechaEn',$fechaEntrega);
		$stmt->bindValue(':mot',$motivo);
		$stmt->bindValue(':comentario',$descripcionFalla);
		$stmt->bindValue(':folio',$folioReporte);
		$stmt->bindValue(':costo',$costoReparacion);
		$stmt->bindValue(':status',$estatus_id);
		$stmt->bindValue(':taller',$talleres_id);
		$stmt->bindValue(':unidad',$unidades_id);
	

		$validacion =$stmt->execute();




		if ($validacion) {
			return true;
		}else{
			return false;
		}


	}

	public function update($id,$economico,$sucursal,$fechaIngreso,$fechaPromesa,$fechaEntrega,$motivo,$taller,$folio,$costo,$motivo2,$comentarios){
	
		$conexion = new db();

		$sql = "UPDATE disponibilidad SET 
		fechaIngreso=:fechaInicio,fechaPromesa=:fechaPro,fechaEntrega=:fechaEn,
		motivo=:mtv,descripcionFalla=:decrip,folioReporte=:folio,costoReparacion=:costo,
		estatus_id=:idEstatus,talleres_id=:idTalleres,unidades_id=:idUnidades 
		WHERE id=:ids";


		$stmt = $conexion->prepare($sql);

		$stmt->bindValue(':ids',$id);
		$stmt->bindValue(':fechaInicio',$fechaIngreso);
		$stmt->bindValue(':fechaPro',$fechaPromesa);
		$stmt->bindValue(':fechaEn',$fechaEntrega);
		$stmt->bindValue(':mtv',$motivo);
		$stmt->bindValue(':decrip',$comentarios);
		$stmt->bindValue(':folio',$folio);
		$stmt->bindValue(':costo',$costo);
		$stmt->bindValue(':idEstatus',$motivo2);
		$stmt->bindValue(':idTalleres',$taller);
		$stmt->bindValue(':idUnidades',$economico);
	
		$validacion =$stmt->execute();

		if ($validacion) {
			return true;
		}else{
			return false;
		}


	}


	public function seleccionarPorId($id){
		$conexion = new db();

		$sql = "SELECT dp.id,dp.descripcionFalla, uni.economico,uni.id as idUnidad,sc.nombreSucursal,sc.id AS idSucursal ,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,datediff(now(),dp.fechaIngreso) as Dias,tl.nombre,tl.id as idTalleres,dp.folioReporte,dp.costoReparacion,es.nombreEstatus,es.id as idEstatus,dp.descripcionFalla FROM disponibilidad dp
			inner join unidades uni on dp.unidades_id = uni.id
			inner join talleres tl on dp.talleres_id = tl.id
			inner join estatus  es on dp.estatus_id = es.id
			inner join sucursales sc on uni.sucursales_id = sc.id WHERE dp.id=:ids;";

			$stmt = $conexion->prepare($sql);

			$stmt->bindValue(':ids',$id);

			$validacion = $stmt->execute();

			if ($validacion) {
				return $stmt->fetch(PDO::FETCH_LAZY);
			}else{
				return false;
			}
	}

	public function delete($id){
		$conexion = new db();

		$sql = "DELETE FROM disponibilidad WHERE id=:ids";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':ids',$id);
		$validacion = $stmt->execute();

		if ($validacion) {
			return true;
		}else{
			return false;
		}

	}


	public function mostrarDisponibles($base,$idEstatus = null){
			
		$conexion = new db();


		switch ($base) {

			case 1:
				//Consultas todo

				if($idEstatus == "vacio"){
				$sql ="SELECT dp.id, uni.economico,dp.descripcionFalla,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id order by DiasFuera desc;" ;


				/*$sql = "SELECT dp.id, uni.economico,dp.descripcionFalla,sc.nombreSucursal,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id 
				WHERE es.nombreEstatus  !='Terminada' and es.nombreEstatus !='Terminada bajo reserva' ORDER BY DiasFuera DESC;";*/
				}else{

					$sql = "SELECT dp.id, uni.economico,dp.descripcionFalla,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus FROM disponibilidad dp
					inner join unidades uni on dp.unidades_id = uni.id
					inner join sucursales sc on uni.sucursales_id = sc.id
					inner join estatus es on dp.estatus_id = es.id
					inner join operaciones op on sc.operaciones_id = op.id WHERE dp.estatus_id =:idsEstatus ;";
				}


				$stmt = $conexion->prepare($sql);

				if($base !=1){
					$stmt->bindValue(':bs',$base);
				}
	
				if($idEstatus !="vacio"){
					$stmt->bindValue(':idsEstatus',$idEstatus);
				}
	
	
				$validacion = $stmt->execute();
	
				if ($validacion) {
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return false;
				}
				/*$stmt = $conexion->prepare($sql);
			

				$validacion = $stmt->execute();


				if ($validacion) {
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return false;
				}	*/

				break;
			case 8://Mexico Especializado , Mexico Pepsi, Apan
				//Consultas todo
				$sql = "SELECT dp.id, uni.economico,dp.descripcionFalla,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus 
					FROM disponibilidad dp
					inner join unidades uni on dp.unidades_id = uni.id
					inner join sucursales sc on uni.sucursales_id = sc.id
					inner join estatus es on dp.estatus_id = es.id
					inner join operaciones op on sc.operaciones_id = op.id WHERE sc.id = 8 OR sc.id = 22 OR sc.id=5 ;";

				$stmt = $conexion->prepare($sql);
			

				$validacion = $stmt->execute();

				if ($validacion) {
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return false;
				}		

				break;
			case 6://Guadalajara Especializado,Guadalajara Dedicado
			$sql = "SELECT dp.id, uni.economico,dp.descripcionFalla,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus 
				FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id WHERE sc.id = 6 OR sc.id = 7;";

				$stmt = $conexion->prepare($sql);
			

				$validacion = $stmt->execute();

				

				if ($validacion) {
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return false;
				}		
			
			default:

			$sql = "SELECT dp.id, uni.economico,dp.descripcionFalla,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id WHERE sc.id=:bs;";

				$stmt = $conexion->prepare($sql);
				$stmt->bindValue(':bs',$base);

				$validacion = $stmt->execute();

				if ($validacion) {
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
				}else{
					return false;
				}
				
				break;
		}



	}	


	


	
}