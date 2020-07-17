<?php 


require_once 'includes/redireccion.php';
require_once 'includes/sucursalFunciones.php';
require_once 'includes/tipoUsuario.php';
//require_once 'includes/layout/header.php';

$listaOperaciones = mostrarDatos("operaciones"); 


//instancia de clase 

$funciones = new sucursalFunciones();

if(isset($_GET))
{

	$id = $_GET['id'];

	$listaDatos = $funciones->seleccionarPorId($id);

	$id = $listaDatos['id'];
	$nombre = $listaDatos['nombreSucursal'];
	$direccion = $listaDatos['direccion'];
	$telefono = $listaDatos['telefono'];
	$operaciones_id = $listaDatos['operaciones_id'];
	$fechaAlta = $listaDatos['fechaAlta'];
	$nombreModelo = $listaDatos['nombreModelo'];
	$numeroLocalidad = $listaDatos['numeroLocalidad'];

}


?>

<div class="card-header">
	<h3>Formulario Actualizacion</h3>
</div>


<div class="card-body">
	
<form action="actualizarSucursales.php" method="post" autocomplete="off">
<div class="row">
	<input type="hidden" name="id" value="<?=$id?>">
	<div class="col-md-3">
		<label for="sucursal">Nombre Sucursal</label>
		<input enabled class="form-control" type="text" name="nombre" placeholder="Ingresa el nombre de la sucursal" value="<?php echo isset($nombre) ? $nombre : "";?>">
		<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['nombre'] : "";?>
	</div>	
	<div class="col-md-3">
		<label>Direccion</label>
		<input class="form-control" type="text" name="direccion" placeholder="Ingresa la direccion Correcta" value="<?=$direccion ?>">
	</div>
	<div class="col-md-3">
		<label>Telefono :</label>
		<input type="text" name="telefono" placeholder="Ingresa el numero de telefono" class="form-control" value="<?= $telefono?>">
	</div>
	<div class="col-md-3">
		<label>Operacion :</label>
		<select class="form-control" name="operacion" id="sucursales">
		<option>Selecciona la Operacion </option>
		<?php foreach($listaOperaciones as $rows): ?>
			<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreOperacion'] ?></option>
		<?php endforeach;  ?>
		</select>
	</div>
	<div class="col-md-3">
		<label>Numero de Localidad:</label>
		<input type="text" name="localidad" placeholder="Ingresa el numero de localidad" class="form-control" value="<?=$numeroLocalidad?>">
	</div>	
</div>

	<div class="row">
			<div class="btn btn-group-sm">
				<button class="btn btn-warning" type="submit" name="btnGuardar" value="Guardar">Actualizar</button>
				<a href="sucursal.php" class="btn btn-danger">Regresar</a>
			</div>
		</div>
</form>	

<?php require_once 'includes/layout/footer.php'; ?>