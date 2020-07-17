<?php 
require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';
$listaCategorias = mostrarDatos("categorias");
 ?>


 <div class="card-header">
 	<h5>Registro de Categorias</h5>
 </div>
 <div class="card-body">
 	<form action="guardarCategorias.php" method="post" autocomplete="off">
 		<div class="row">
 			<div class="col-md-3">
 				<label>Nombre Categoria:</label>
 				<input class="form-control" type="text" name="categoria" placeholder="Ingresa la cateria que deseas">
 			</div>	
 		</div>
 		<div class="row">
 			<div class="btn btn-group-sm">
 				<button class="btn btn-primary" type="submit" value="Guardar">Guardar</button>
 			</div>
 		</div>
 	</div>
 
 <div class="card-footer">
 	<p>Registro de Categorias</p>
	<table id="table_id" class="table table-bordered table-hover" >
		<thead>
		<tr>
			<th>Id</th>
			<th>Nombre Categoria</th>
			<th>Fecha</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($listaCategorias as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['nombreCategoria']; ?></td>
			<td><?php echo $rows['fechaIngreso']; ?></td>

		</tr>
	<?php endforeach; ?>
		</tbody>	
	</table>	

 </div>	


 	</form>
<?php require 'includes/layout/footer.php'; ?>
