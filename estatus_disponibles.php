<?php 
require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';
$listaEstatus = mostrarDatos("estatus_disponible"); 
 ?>


<div class="card-header">
	<h3>Estatus de unidad</h3>
</div>
<div class="card-body">
	<form action="guardar_estatus_disponibles.php" method="post">
	<div class="row">
		<div class="col-md-6">
			<label>Nombre del Estatus :</label>
			<input class="form-control" type="text" name="estatus" placeholder="Ingresa un estatus">
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
					<th>id :</th>
					<th>Nombre Estatus :</th>
					<th>Fecha Alta :</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($listaEstatus as $row): ?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['nombreEstatus'] ?></td>
					<td><?php echo $row['fechaAlta'] ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>	




 <?php require_once 'includes/layout/footer.php'; ?>
