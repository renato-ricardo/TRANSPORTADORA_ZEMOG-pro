<?php 
require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';

$listaEstatus = mostrarDatos("estatus");
 ?>

<div class="card-header">
	<h3>Registro de Estatus</h3>
</div>
<div class="card-body">
 <form action="guardarEstatus.php" method="post" autocomplete="off">
 	<div class="row">
 		<div class="col-md-3">
 			<label>Nombre de Estatus :</label>
 			<input type="text" name="estatus" placeholder="Ingresa el nombre del estatus" class="form-control">
 		</div>
 	</div>
 	<div class="row">
 		<div class="btn btn-group-md">
 			<button class="btn btn-primary">Guardar</button>
 		</div>
 	</div>

 </form>
 <div class="card-footer">
	<table id="table_id" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Estatus</th>
				<th>Fecha Alta</th>
				<th>Accion</th>
				<th>Accion</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($listaEstatus as $row): ?>
			<tr>
				<td><?= $row['id'] ?></td>
				<td><?= $row['nombreEstatus'] ?></td>
				<td><?= $row['fechaAlta'] ?></td>
				<td><a class="btn btn-danger" onclick="preguntar(<?= $row['id'] ?>)" href="#">Eliminar</a></td>
				<td><a class="btn btn-warning" href="">Actualizar</a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
</table>	
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
				  	window.location.href = "eliminarEstatus.php?id="+id;
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
