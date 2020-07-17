<?php 
require_once 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require_once 'includes/layout/header.php';

$listasMarcas = mostrarDatos("marcas_Unidades");

?>


<div class="card-header">
	<h3>Registro de Marcas</h3>
</div>

<div class="card-body">
	<form action="guardarMarca.php" method="post" autocomplete="off">
		<div class="row">
			<div class="col-md-3">
				<label>Nombre de Marca :</label>
				<input type="text" name="marca" placeholder="Ingresa la marca de unidades" class="form-control">
			</div>
		</div>
		<div class="row">
				<div class="btn btn-group-md">
					<button class="btn btn-primary">Guardar</button>
				</div>
		</div>		
	</form>
</div>

<div class="card-footer">
	<table  id="table_id" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Id :</th>
				<th>Marca :</th>
				<th>Fecha Alta :</th>
				<th>Accion :</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($listasMarcas as $row): ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=$row['nombreMarca']?></td>
				<td><?=$row['fechaAlta']?></td>
				<td><a href="" class="btn btn-warning">Eliminar</a></td>
			</tr>
		<?php  endforeach; ?>
		</tbody>
	</table>
</div>


<?php require_once 'includes/layout/footer.php'; ?>