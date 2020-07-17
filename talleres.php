<?php 
require 'includes/redireccion.php';
require 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';
 ?>


<?php 
$listadoTalleres = mostrarDatos('talleres');


?>


<div class="card-header">
	<h3>Registro de Talleres</h3>

</div>


<!--alerta para registros repetido-->
<?php 

?>
<?php if(isset($_SESSION['registroRepetido'])): ?>
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
      <?php echo isset($_SESSION['registroRepetido']) ? $_SESSION['registroRepetido'] : ""; ?>
</div>
​<?php endif; ?>    

<!--alerta para registros Ingresado-->

<?php if(isset($_SESSION['completo'])): ?>
	<div class="alert alert-success alert-dismissible">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	      <h5><i class="icon fas fa-check"></i> Alert!</h5>
	        <?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?> 
	</div>
<?php endif; ?>


<div class="card-body">
	<form action="guardarTalleres.php" method="post" autocomplete="off">
		<div class="row">
			<div class="col-md-3">
				<label>Nombre del Taller :</label>
					<input class="form-control" type="text" name="nombreTaller" placeholder="Ingresa el numero Economico" value="<?php echo isset($nombre) ? $nombre : "";?>">
					<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['tallerNombre'] : "" ?>
					</div>
				<?php endif; ?>					
			</div>
		
			<div class="col-md-3">
				<label>Direccion :</label>
					<input class="form-control" type="text" name="direccionTaller" placeholder="Ingresa el numero Economico" value="<?php echo isset($nombre) ? $nombre : "";?>">
					<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['direccionTaller'] : "" ?>
					</div>
				<?php endif; ?>			
			</div>
		</div>

	<div class="row">
		<div class="btn btn-group-sm">
			<button class="btn btn-primary" type="submit" name="btnGuardar" value="Guardar">Guardar
			</button>

		</div>
	</div>


</form>		

<h3>Tabla de Rutas</h3>

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
			<th>Nombre del Taller :</th>
			<th>Direccion :</th>
			<th>Accion Eliminar</th>	
			<th>Accion Seleccion</th>
	
		</tr>
		</thead>
		<tbody>
		<?php foreach($listadoTalleres as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['nombre']; ?></td>
			<td><?php echo $rows['direccion']; ?></td>

			<td><a class="btn btn-danger" onclick="preguntar(<?php echo $rows['id'] ?>);" class="botonEliminar" href="#">Eliminar</a></td>
			<td><a class="btn btn-warning"  class="botonSeleccionar" href="seleccionTalleres.php?id=<?php echo $rows['id']; ?>">Seleccionar</a></td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table >	

	<script type="text/javascript">
			
			function preguntar(id){

			var mensaje =Swal.fire({
				  title: 'Deseas Eliminar el registro?',
				  text: "Estas segurdo de eliminar el datos Seleccionadp",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Eliminar Registro'
				}).then((result) => {
				  if (result.value) {
				  	window.location.href = "eliminarTalleres.php?id="+id;
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})				

			}

	</script>


<?php require 'includes/layout/footer.php'; ?>