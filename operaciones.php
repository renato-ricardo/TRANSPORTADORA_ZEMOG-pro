	<?php 
require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';
 ?>


<?php 
$listaOperaciones = mostrarDatos("operaciones");

$usuarios = (int) $_SESSION['user']['sucursal'];


?>

<?php// require_once 'dashboard/Unidadesdashboard.php' ?>
  <div class="card-header">
        <h5 class="card-title m-0">Registro de Operaciones</h5>
  </div>
<div class="card-body">

	<form action="guardarOperaciones.php" method="post" autocomplete="off">
		  	<input class="form-control" type="hidden" name="Usuarios_id" value="<?php echo $_SESSION['user']['id'] ?>">	
		<div class="row">
                <div class="col-md-3">
                    <label for="nombre">Operacion:</label>
                    <input class="form-control" autofocus="on" type="text" name="operacion" placeholder="Ingresa la operacion">
                    <div class="alert-warning"><?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['economico'] : "";?></div>                            
				</div>

		</div>
            <div class="row">
                <div class="btn btn-group-sm">
                    <button type="submit" class="btn btn-success" name="btnNombre" ><i class="fa fa-save"></i> Guardar</button>
                    <a class="btn btn-success" onclick="alert('Creando Excel')" href="reporteExcel/ExcelUnidades.php"><i class="fa fa-file-excel-o"></i> Excel</a>                    
                </div>
            </div>   
	</form>		

			<?php if(isset($_SESSION['completo']) ): ?>
			<div class="alert alert-success">
			<?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?>
			</div>

			<div class="completo">
			<?php echo isset($_SESSION['completado']) ? $_SESSION['completado'] : ""; ?>
			</div>

		<?php endif; ?>



	<table  id="table_id" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Id</th>
			<th>Nombre de la Operacion</th>
			<th>Fecha Alta</th>
			<th>Acciones</th>	
			<th>Acciones</th>	
		</tr>
		</thead>
		<tbody>
		<?php foreach($listaOperaciones as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['nombreOperacion']; ?></td>	
			<td><?php echo $rows['fechaAlta']; ?></td>	
			<td><a onclick="preguntar(<?php echo $rows['id'] ?>)" class="btn btn-danger" href="#">Eliminar</a></td>
			<td><a class="btn btn-warning" href="seleccionarModelo.php?id=<?php echo $rows['id']; ?>">Seleccionar</a></td>
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
				  	window.location.href = "eliminarOperacion.php?id="+id;
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