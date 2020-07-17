<?php 

require 'includes/redireccion.php';
require 'includes/layout/header.php';



 ?>


<?php $listaRutas = $funcionesRuta->mostrarTodo(); ?>

<?php require_once 'dashboard/Unidadesdashboard.php'; ?>

<div class="card-header">
	<h3>Registro de Rutas</h3>
</div>
 
<div class="card-body">
			<form action="guardarRutas.php" method="post" autocomplete="off">
				<div class=row>
					<div class="col-md-3">
						<label>Nombre de la sucursal :</label>
						<input class="form-control" type="text" name="nombre" placeholder="Ingresa el nombre de la sucursal" value="<?php echo isset($nombre) ? $nombre : "";?>">
						<div class="errores">
							<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['nombre'] : "";?>
						</div>
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

	<table class="table table">
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Accion Eliminar</th>	
			<th>Accion Seleccion</th>
	
		</tr>
		<?php foreach($listaRutas as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['nombre']; ?></td>
			<td><a class="btn btn-danger" onclick="preguntar(<?php echo $rows['id']; ?>);" class="botonEliminar" href="">Eliminar</a></td>
			<td><a class="btn btn-warning" onclick="confirm('Deseas eliminar el registro');" class="botonSeleccionar" href="actualizarSucursal.php?id=<?php echo $rows['id']; ?>">Seleccionar</a></td>
		</tr>
	<?php endforeach; ?>
		
	</table>	

  </div>
	<script type="text/javascript">
			
			function preguntar(id){

			var mensaje = Swal.fire({
				  title: 'Deseas Eliminar el registro?',
				  text: "Estas segurdo de eliminar el datos Seleccionadp",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Eliminar Registro'
				}).then((result) => {
				  if (result.value) {
				  	window.location.href = "eliminarRutas.php?id="+id;
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