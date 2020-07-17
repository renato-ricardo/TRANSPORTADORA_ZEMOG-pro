<?php 
require_once 'includes/redireccion.php';
require_once 'includes/talleresFunciones.php';
//Instancia de clase
$funTaller = new talleresFunciones();

$id = isset($_GET['id']) ? $_GET['id'] : false;


$datos = $funTaller->seleccionarPorId($id);


$id = $datos['id'];
$nombre = $datos['nombre'];
$dic = $datos['direccion'];


?>

<div class="card-header">
	<h3>Actualizacion de Talleres</h3>
</div>

<div class="card-body">
	<form action="seleccionarTaller.php" method="post" autocomplete="off">
		<input class="form-control" type="text" name="id" value="<?php echo $id ?>">
		<div class="row">
			<div class="col-md-3">
				<label>Nombre del Taller :</label>
					<input class="form-control" type="text" name="nombreTaller" placeholder="Ingresa el numero Economico" value="<?php echo isset($nombre) ? $nombre : "";?>">	
			</div>
	<div class="col-md-3">
		<label>Direccion :</label>
			<input class="form-control" type="text" name="direccionTaller" placeholder="Ingresa el numero Economico" value="<?php echo isset($dic) ? $dic : "";?>">
	</div>
</div>

	<div class="row">
		<div class="btn btn-group-sm">
			<button class="btn btn-primary" type="submit" name="btnGuardar" value="Guardar">Actualizar</button>
		</div>
	</div>


</form>		

<?php require 'includes/layout/footer.php'; ?>