<?php 
require 'includes/redireccion.php';
require 'includes/layout/header.php';
 ?>



<?php 
$listaSucursales = $funcionesDetalle->mostrarTodo('sucursales'); 
$listaRutas = $funcionesDetalle->mostrarTodo('rutas'); 
$listaRutasSucursales = $funcionesDetalle->mostrarTodos();

?>


<div class="card-header">
	<h3>Ruta compartidas</h3>
</div>

<div class="card-body">
	<form action="guardarDetalleRutasSucusales.php" method="post" autocomplete="off">
		<div class="row">
			<div class="col-md-3">
			<label for="Sucursal">Sucursal</label>	
				<select class="form-control" name="sucursales">
					<option>Seleccione una Sucursal</option>
				<?php foreach($listaSucursales as $rows): ?>
					<option value="<?php echo $rows['id'] ?>"><?php echo $rows['nombre'] ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-3">
				<label>Rutas</label>
				<select class="form-control" name="rutas">
					<option>Seleccione una Ruta</option>
				<?php foreach($listaRutas as $rows): ?>
					<option value="<?php echo $rows['id'] ?>"><?php echo $rows['nombre'] ?></option>
				<?php endforeach; ?>
				</select>
			</div>
				
		<div class="errores">
			<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['nombre'] : "";?>
		</div>
	</div>
	<div class="row">
		<div class="btn btn-group-sm">
		<button class="btn btn-default" type="submit" name="btnGuardar" value="Guardar">Insertar</button>
		</div>
	</div>

	</form>		






<div class="completo">
<?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?>
</div>

<div class="completo">
<?php echo isset($_SESSION['completado']) ? $_SESSION['completado'] : ""; ?>
</div>


	<table class="table table">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Accion Eliminar</th>	
			<th>Accion Seleccion</th>
	
		</tr>
		<?php foreach($listaRutasSucursales as $rows): ?>
		<tr>
			<td><?php echo $rows['Ruta']; ?></td>
			<td><?php echo $rows['Sucursal']; ?></td>
				
			<td><a class="btn btn-danger" onclick="confirm('Deseas eliminar el registro');" class="botonEliminar" href="eliminarRutas.php?id=<?php echo $rows['id']; ?>">Eliminar</a></td>
			<td><a class="btn btn-warning" onclick="confirm('Deseas eliminar el registro');" class="botonSeleccionar" href="actualizarSucursal.php?id=<?php echo $rows['id']; ?>">Seleccionar</a></td>
		</tr>
	<?php endforeach; ?>
		
	</table>	

<?php require 'includes/layout/footer.php'; ?>