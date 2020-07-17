<?php 

include('../includes/db.php');

session_start();
		


	$conexion = new db();

	//definir el nombre de nuestro archivo charset
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Report.csv');

	//Salida del archivo 
	$salida = fopen('php://output', 'w');
	//Defenir las columnas de los archivos 
	fputcsv($salida, 
		array(
		'id',
		'Economico',
		'Serie',
		'Placas',
		'Mad',
		'Modelo',
		'Iave',
		'Sucursal',
		'Operacion',
		'Estatus'
		));

	//defirni consulta
	$sql = "SELECT uni.id,uni.economico,uni.serie,uni.placas,uni.mad,uni.modelo,uni.iave,sc.nombreSucursal,op.nombreOperacion,dp.nombreEstatus FROM unidades uni
		inner join sucursales sc on uni.sucursales_id = sc.id
		inner join operaciones op on sc.operaciones_id = op.id
		inner join estatus_disponible dp on uni.estatus_disponible_id = dp.id
        order by id asc ;";

    	
		$reporteCVS = $conexion->prepare($sql);
        $reporteCVS->execute();

        

		if($reporteCVS === false){
		die("Failed");
		}
        
		$datos = $reporteCVS->fetchAll();


		foreach ($datos as $filaR){
		fputcsv(
			$salida,array(
				$filaR['id'],
				$filaR['economico'],
				$filaR['serie'],
				$filaR['placas'],
				$filaR['mad'],
				$filaR['modelo'],		
				$filaR['iave'],		
				$filaR['nombreSucursal'],
				$filaR['nombreOperacion'],
				$filaR['nombreEstatus']
			));

        }
        
        