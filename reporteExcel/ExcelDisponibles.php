<?php 

include('../includes/db.php');

	session_start();

	$conexion = new db();



$id = $_SESSION['usuario']['sucursal'];
$reporteTrue = false;
	


switch ($id) {

	case 1:
	//defirni consulta
			$sql = "SELECT dp.id, uni.economico,uni.Mad,dp.descripcionFalla,uni.mad,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,
			dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,
			es.nombreEstatus,tl.nombre as nombreTaller FROM disponibilidad dp
			inner join unidades uni on dp.unidades_id = uni.id
			inner join sucursales sc on uni.sucursales_id = sc.id
			inner join estatus es on dp.estatus_id = es.id
			inner join talleres tl on dp.talleres_id = tl.id
			inner join operaciones op on sc.operaciones_id = op.id;";	
		
		break;
	
	case 8: // Mexico Especializado, Mexico Dedicado, Apan ,Pepsi
			$sql = "SELECT dp.id, uni.economico,uni.Mad,dp.descripcionFalla,uni.mad,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus 
				FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id WHERE sc.id = 8 OR sc.id = 9 OR sc.id= 5 ;";	

	break;
	case 6://Guadalajara Especializado,Guadalajara Dedicado
			$sql = "SELECT dp.id, uni.economico,dp.descripcionFalla,uni.mad,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus 
				FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id WHERE sc.id = 6 OR sc.id = 7;";
		break;


	default:

	//defirni consulta
			$sql = "SELECT dp.id, uni.economico,uni.Mad,dp.descripcionFalla,uni.mad,sc.nombreModelo,op.nombreOperacion,dp.fechaIngreso,dp.fechaPromesa,dp.fechaEntrega,dp.motivo,dp.costoReparacion,if(estatus_id = 9 or estatus_id = 10,datediff(fechaEntrega,fechaIngreso),datediff(now(),fechaIngreso)) as DiasFuera,es.nombreEstatus FROM disponibilidad dp
				inner join unidades uni on dp.unidades_id = uni.id
				inner join sucursales sc on uni.sucursales_id = sc.id
				inner join estatus es on dp.estatus_id = es.id
				inner join operaciones op on sc.operaciones_id = op.id WHERE sc.id=:ids";	
			break;
}





	//definir el nombre de nuestro archivo charset
	header('Content-Encoding: UTF-8');
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Report.csv');
	echo "\xEF\xBB\xBF";

	//Salida del archivo 
	$salida = fopen('php://output', 'w');
	//Defenir las columnas de los archivos 
	fputcsv($salida, 
		array(
		'Economico',
		'Nombre Sucursal',
		'Fecha Ingreso',
		'Fecha Promesa',
		'Fecha Entrega',
		'Motivo',
		'Costo por Reparacion',
		'Dias en Detencion',
		'nombreEstatus',
		'Comentarios',
		'Mad',
		'Operacion',
		'nombreTaller'
		));


    	
		$reporteCVS = $conexion->prepare($sql);

		if($id == 1 || $id!= 6 || $id!=8){
		$reporteCVS->bindValue(':ids',$id);
		$reporteTrue = true;
        }




        $reporteCVS->execute();

        

		if($reporteCVS === false){
		die("Failed");
		}
        
		$datos = $reporteCVS->fetchAll();


		foreach ($datos as $filaR){
		fputcsv(
			$salida,array(
				$filaR['economico'],
				$filaR['nombreModelo'],
				$filaR['fechaIngreso'],
				$filaR['fechaPromesa'],
				$filaR['fechaEntrega'],
				$filaR['motivo'],		
				$filaR['costoReparacion'],		
				$filaR['DiasFuera'],	
				$filaR['nombreEstatus'],
				$filaR['descripcionFalla'],
				$filaR['mad'],
				$filaR['nombreOperacion'],
				$filaR['nombreTaller']
			));

        }
        
        
