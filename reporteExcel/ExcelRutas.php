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
		'tipoEquipo',
		'descripcionOrigen',
		'zonaOrigen',
		'claseExpedicion',
		'numRuta',
		'descripcionDestino',
		'zonaDestino',
		'llave',
		'formato Viaje',
		'tarifaZemog',
		'kmsRedondos',
		'peajeRedondo',
		'ultimaActualizacion'
		));

	//defirni consulta
	$sql = "SELECT * FROM Rutas;";

    	
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
				$filaR['tipoEquipo'],
				$filaR['descripcionOrigen'],
				$filaR['zonaOrigen'],
				$filaR['claseExpedicion'],
				$filaR['numRuta'],		
				$filaR['descripcionDestino'],		
				$filaR['zonaDestino'],
				$filaR['llave'],
				$filaR['formatoViaje'],
				$filaR['tarifaZemog'],
				$filaR['kmsRedondos'],
				$filaR['peajeRedondo'],
				$filaR['ultimaActualizacion']
			));

        }
        
        