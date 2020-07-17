<?php 
require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';
 ?>


<?php $listaDatos = $functiones->mostrarTodo(); 
$listaOperaciones = mostrarDatos("operaciones"); 
$listaUnidades = mostrarSucursal();
?>


<div class="card-header">
	<h3>Registro de sucursales</h3>
</div>

<div class="card-body">
	
<form action="guardarSucursal.php" method="post" autocomplete="off">
<div class="row">
	<div class="col-md-3">
		<label for="sucursal">Nombre Sucursal</label>
		<input class="form-control" type="text" name="nombre" placeholder="Ingresa el nombre de la sucursal" value="<?php echo isset($nombre) ? $nombre : "";?>">
		<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['nombre'] : "";?>
	</div>	
	<div class="col-md-3">
		<label>Direccion</label>
		<input class="form-control" type="text" name="direccion" placeholder="Ingresa la direccion Correcta">
	</div>
	<div class="col-md-3">
		<label>Telefono :</label>
		<input type="text" name="telefono" placeholder="Ingresa el numero de telefono" class="form-control">
	</div>
	<div class="col-md-3">
		<label>Operaciones</label>
		<select class="form-control" name="operaciones">
			<?php foreach($listaOperaciones as $rows): ?>
			<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreOperacion'] ?></option>
		<?php  endforeach; ?>
		</select>
	</div>
	<div class="col-md-3">
		<label>Numero de Localidad:</label>
		<input type="text" name="localidad" placeholder="Ingresa el numero de localidad" class="form-control">
	</div>	
</div>

	<div class="row">
			<div class="btn btn-group-sm">
				<button class="btn btn-primary" type="submit" name="btnGuardar" value="Guardar">Guardar</button>
			</div>
		</div>
</form>	



<div class="completo">
<?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?>
</div>

<div class="completo">
<?php echo isset($_SESSION['completado']) ? $_SESSION['completado'] : ""; ?>
</div>

<div class="card-footer">
	<table id="table_id" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Direccion</th>	
			<th>Telefono</th>	
			<th>Operacion_id</th>	
			<th>Numero de Localidad</th>	
			<th>Accion Eliminar</th>
			<th>Accion Seleccion</th>	
		</tr>
		</thead>
		<tbody>
		<?php foreach($listaUnidades as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['nombreSucursal']; ?></td>
			<td><?php echo $rows['direccion']; ?></td>
			<td><?php echo $rows['telefono']; ?></td>
			<td><?php echo $rows['nombreOperacion']; ?></td>
			<td><?php echo $rows['numeroLocalidad']; ?></td>
			<td><a  class="btn btn-danger btn-sm" href="eliminarSucursal.php?id=<?php echo $rows['id']; ?>"onclick="confirmacion();">Eliminar</a></td>
			<td><a onclick="confirm('Selecionaste un registro');" class="btn btn-warning btn-sm" href="actualizarSucursal.php?id=<?php echo $rows['id']; ?>">Seleccionar</a></td>
		</tr>

	<?php endforeach; ?>
		</tbody>
	</table>	

<?php require 'includes/layout/footer.php'; ?>