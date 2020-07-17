<?php 

require_once 'db.php';
$conexion = new db();


function seleccionSursal($economico){
	$stmt = $conexion->prepare("SELECT uni.id,uni.economico,uni.serie,uni.placas,uni.mad,uni.modelo,uni.iave,sc.nombreSucursal,op.nombreOperacion FROM unidades uni
		inner join sucursales sc on uni.sucursales_id = sc.id
		inner join operaciones op on sc.operaciones_id = op.id WHERE uni.economico=:eco;");
	$stmt->bindValue(':eco',$economico);
	$validacion = $stmt->execute();

	if ($validacion) {
		return $datos = $stmt->fetch(PDO::FETCH_LAZY);
	}else{
		return false;
	}

	$stmt = null;
	$conexion=null;

}

function borrarErrores(){

	$borrar = false;

	if (isset($_SESSION['errores'])) {
		$_SESSION['errores'] = null;
		$borrar = true;
	}
	if(isset($_SESSION['completo'])){
		$_SESSION['completo'] = NULL;
		$borrar = true;
	}
	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = NULL;
		$borrar = true;
	}
	if(isset($_SESSION['registroRepetido'])){
		$_SESSION['registroRepetido'] = NULL;
		$borrar = true;
	}	

	if(isset($_SESSION['error_guardar'])){
		$_SESSION['error_guardar'] = NULL;
		$borrar = true;
	}	
	

	return $borrar;

}

function mostrarDatos($table=null){

	$conexion = new db();

	$sql = "SELECT * FROM " . $table;
	$declaracion = $conexion->prepare($sql);
	$declaracion->execute();

	return $declaracion->fetchAll(PDO::FETCH_ASSOC);
}

function contarRegistros($table=null){

	$conexion = new db();
	$sql = "SELECT * FROM " . $table;
	$declaracion =$conexion->prepare($sql);
	$declaracion->execute();

	$numeroRegistros = $declaracion->rowCount();
	return $numeroRegistros;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function mostrarBaseCombo($table,$sucursales_id){
	if($sucursales_id!=1){
		$conexion = new db();
		$sql = "SELECT * FROM " . $table . " WHERE id =:ids";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':ids',$sucursales_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$conexion = new db();
		$sql = "SELECT * FROM " . $table;
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$sucursales_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}
}

function mostrarComboUnidad($table,$sucursales_id =null){	

	if($sucursales_id!=1){
		$conexion = new db();
		$sql = "SELECT * FROM " . $table . " WHERE sucursales_id =:id";
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$sucursales_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}else{

		$conexion = new db();
		$sql = "SELECT * FROM " . $table;
		$stmt = $conexion->prepare($sql);
		$stmt->bindValue(':id',$sucursales_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);		
	}

}

function mostrarComboUnidadDisponibilidad($table,$sucursales_id =null){
$menu = $sucursales_id;


	switch ($menu) {
		case 1:
			$conexion = new db();

				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id;";

				
				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$validacion =$declaracion->execute();
				return $declaracion->fetchAll(PDO::FETCH_ASSOC);		
			break;
		case 6: //Sucursal Dedicado y Guadalajara Especializado
				$sucursalDedicado = 7;

				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id OR sucursales_id=:ids";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->bindValue(':ids',$sucursalDedicado);
				$validacion = $declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);

		break;

		case 8: //Mexico especialiado tiene acceso a apan = 5  y mexico Pepsi = 22
				$sucursalDedicado = 22;
				$sucursalApan = 5;

				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id OR sucursales_id=:ids OR sucursales_id=:apan";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->bindValue(':ids',$sucursalDedicado);
				$declaracion->bindValue(':apan',$sucursalApan);
				$declaracion->execute();
				

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);		
		case 10 : //Mazatlan Espacializado = 10 Mazatlan Dedicado = 11 

				$sucursalDedicado = 11;

				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id OR sucursales_id=:ids";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->bindValue(':ids',$sucursalDedicado);
				$declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);				
		
		default:
				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id;";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);
		break;
	}

}


//Funcion para mostrar solo las unidades dependiendo del usuario


function mostrarUnidades($table,$sucursales_id =null){

	$menu = $sucursales_id;


	switch ($menu) {
		case 1:
			$conexion = new db();

				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id;";

				
				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$validacion =$declaracion->execute();
				return $declaracion->fetchAll(PDO::FETCH_ASSOC);		
			break;
		case 6: //Sucursal Dedicado y Guadalajara Especializado
				$sucursalDedicado = 7;

				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id OR sucursales_id=:ids";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->bindValue(':ids',$sucursalDedicado);
				$validacion = $declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);

		break;

		case 8: //Mexico especialiado tiene acceso a apan = 5  y mexico pepsi = 22
				$sucursalDedicado = 22;
				$sucursalApan = 5;

				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id OR sucursales_id=:ids OR sucursales_id=:apan";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->bindValue(':ids',$sucursalDedicado);
				$declaracion->bindValue(':apan',$sucursalApan);
				$declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);		
		case 10 : //Mazatlan Espacializado = 10 Mazatlan Dedicado = 11 

				$sucursalDedicado = 11;

				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id OR sucursales_id=:ids";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->bindValue(':ids',$sucursalDedicado);
				$declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);				
		
		default:
				$conexion = new db();
				$sql = "SELECT uni.id, uni.economico,uni.serie,uni.placas,uni.mad,sc.nombreModelo,sc.nombreSucursal,op.nombreOperacion,nombreEstatus,uni.url,uni.imagen from unidades uni
						inner join marcas_unidades mc on uni.marca_id = mc.id
						inner join sucursales sc on uni.sucursales_id = sc.id
						inner join operaciones op on uni.operaciones_id = op.id
						inner join estatus_disponible ds on uni.estatus_disponible_id = ds.id WHERE sucursales_id =:id;";

				$declaracion = $conexion->prepare($sql);
				$declaracion->bindValue(':id',$sucursales_id);
				$declaracion->execute();

				return $declaracion->fetchAll(PDO::FETCH_ASSOC);
		break;
	}

}


	function mostrarUsuarios(){

		$conexion = new db();

		$sql = "SELECT usr.id,usr.nombreUsuario,usr.contraseña,usr.correoElectronico,ct.nombreCategoria,sc.nombreSucursal from usuarios usr
			inner join categorias ct on usr.categorias_id = ct.id
			inner join sucursales sc on usr.sucursales_id = sc.id;";

		$declaracion = $conexion->prepare($sql);
		$declaracion->execute();

		return $declaracion->fetchAll(PDO::FETCH_ASSOC);
	}


	function mostrarSucursal(){
		$conexion = new db();

		$sql = "SELECT sc.id, sc.nombreSucursal,sc.direccion,sc.telefono,op.nombreOperacion,sc.numeroLocalidad from sucursales sc
				inner join operaciones op on sc.operaciones_id = op.id;";
		$declaracion = $conexion->prepare($sql);
		$declaracion->execute();

		return $declaracion->fetchAll(PDO::FETCH_ASSOC);
	}



?>