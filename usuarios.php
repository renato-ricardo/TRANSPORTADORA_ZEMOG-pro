<?php 
require 'includes/redireccion.php';
require 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';


 ?>


<?php 
$listaUsuarios = mostrarUsuarios();
$listaCategorias = mostrarDatos("categorias"); 
$listaSucursales = mostrarDatos("sucursales"); 


?>

  <div class="card-header">
        <h5 class="card-title m-0">Registro de Usuarios</h5>

  </div>

<!--Validaciones-->

<!--alerta para registros repetido-->

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

	<form action="guardarUsuarios.php" method="post" autocomplete="off">
		<div class="row">
                <div class="col-md-3">
					<label>Usuario:</label>
					<input class="form-control" type="text" name="usuario" placeholder="Ingresa el nombre de usuario" value="<?php echo isset($nombre) ? $nombre : "";?>">
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['usuario'] : "" ?>
					</div>
				<?php endif; ?>
				</div>
				<div class="col-md-3">
					<label>Contraseña:</label>
					<input class="form-control" type="password" name="contraseña" placeholder="Ingresa una contraseña" value="<?php echo isset($nombre) ? $nombre : "";?>">
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['contraseña'] : "" ?>
					</div>
				<?php endif; ?>
				</div>
				
				<div class="col-md-3">
					<label>Correo Electronico:</label>
					<input class="form-control" type="email" name="correo" placeholder="Ingresa una contraseña" value="<?php echo isset($nombre) ? $nombre : "";?>">

				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['correo'] : "" ?>
					</div>
				<?php endif; ?>					
				</div>				
				<div class="col-md-3">
					<label>Sucursal</label>
					<select class="form-control" name="Sucursales">
						<option>Selecciona un sucursal</option>
						<?php foreach($listaSucursales as $rows): ?>
						<option value="<?php echo $rows['id']; ?>" ><?php echo $rows['nombreSucursal']; ?></option>
					<?php endforeach; ?>
					</select>
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? "Selecciona una Sucursal" : "" ?>
					</div>
				<?php endif; ?>							
				</div>
				<div class="col-md-3">	
					<label>Categoria</label>
					<option>Selecciona una categoria</option>
					<select class="form-control" name="tipo">
						<?php foreach($listaCategorias as $rows): ?>
						<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreCategoria'] ?></option>
					<?php endforeach; ?>
					</select>
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? "Selecciona una Tipo de Usuario" : "" ?>
					</div>
				<?php endif; ?>		
				</div>
		</div>			

				<div class="row">
					<div class="btn btn*-group-sm">
						<button class="btn btn-primary" type="submit" name="btnGuardar" value="Guardar">Guardar</button>
					</div>
				</div>
	</form>	

<div class="card-footer">

	<table id="table_id" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Id</th>
			<th>Usuario</th>
			<th>Correo</th>
			<th>Tipo de Usuario</th>
			<th>Sucursal</th>
			<th>Accion Eliminar</th>	
			<th>Accion Seleccion</th>
		</tr>
		</thead>
		
		<tbody>
			<?php foreach($listaUsuarios as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['nombreUsuario']; ?></td>
			<td><?php echo $rows['correoElectronico']; ?></td>
			<td><?php echo $rows['nombreCategoria']; ?></td>
			<td><?php echo $rows['nombreSucursal']; ?></td>
			<td>
				<a href="#" onclick="preguntar(<?php echo $rows['id'] ?>);"  class="btn btn-danger"><i class="fas fa-trash"></i></a>
			</td>
			<td>
	            <a href="actualizarUsuarios.php?id=<?php echo $rows['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
			</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>	
	</div>	
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
				  	window.location.href = "eliminarUsuarios.php?id="+id;
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