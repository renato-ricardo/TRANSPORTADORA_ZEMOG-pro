<?php 

//Declaracion de includes
require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
require_once 'includes/funcionesDisponibilidad.php';

//Instancia de Funciones
$funciones = new funcionesDisponibilidad();

//Declaracion de variables
$idEstatus = isset($_POST['estatusId']) ? $_POST['estatusId'] : "vacio";
//Casting de Variable 
$usuarios = (int) $_SESSION['user']['sucursal'];


$listaUnidades = mostrarComboUnidadDisponibilidad('unidades',$usuarios);
//Funcion para mostrar sucursales en comboBox
$listaSucursales = mostrarBaseCombo('sucursales',$usuarios);
//Funciones para mostrar registros de Disponibles
$listaDisponibles = $funciones->mostrarDisponibles($usuarios,$idEstatus);
//Funcion para mostrar en comboBox los talleres
$listaTalleres = mostrarDatos("talleres");
//Funcion para mostrar en combobox los estatus
$listaEstatus = mostrarDatos('estatus');
 ?>



<div class="card-header">
	<h3>Registro de Disponibilidad</h3>
</div>


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

<!--alerta para eliminacion de Registros -->

<?php if(isset($_SESSION['completado'])): ?>
	<div class="alert alert-success alert-dismissible">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	      <h5><i class="icon fas fa-check"></i> Alert!</h5>
	        <?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?> 
	</div>
<?php endif; ?>

<div class="card-body">
	<form action="guardarDisponibilidad.php" method="POST" autocomplete="off">
		<div class="row">

			<div class="col-md-3">
				<label>Unidad :</label>
				<select name="economico" class="form-control" id="miunidad">
					<?php if(isset($_SESSION['error_guardar']['economico'])): ?>
					<option><?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['economico'] :false; ?></option>
				<?php endif; ?>
					<option value="vacio">Seleccione un economico</option>
					<?php foreach($listaUnidades as $row): ?>
					<option value="<?php echo $row['id']; ?>"><?= $row['economico'] ?></option>
					<?php endforeach; ?>
				</select>
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['economico'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['economico'] : "" ?>
					</div>
				<?php endif; ?>								
			</div>
			<div class="col-md-3">
				<label>Fecha de Ingreso :</label>
				<input type="date" name="fechaIngreso" class="form-control" value="<?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['fechaIngreso'] : false; ?>">
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['fechaIngreso'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['fechaIngreso'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div class="col-md-3">
				<label>Fecha Promesa :</label>
				<input type="date" name="fechaPromesa" class="form-control"  value="<?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['fechaPromesa'] : false; ?>" >
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['fechaPromesa'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['fechaPromesa'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			
			<div class="col-md-3">
				<label>Motivo :</label>
				<select name="motivo" id="motivo" class="form-control" >
					<?php if(isset($_SESSION['error_guardar']['motivo'])): ?>
					<option value="<?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['motivo'] : false ?>"><?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['motivo'] : false; ?></option>
				<?php endif; ?>
					<option value="vacio">Selecciona un motivo</option>
					<option value="Garantia">Garantia</option>
					<option value="Mantenimiento Correctivo">Mantenimiento Correctivo</option>
					<option value="Mantenimiento Preventivo">Mantenimiento Preventivo</option>
					<option value="Rescate">Rescate</option>
					<option value="Siniestro">Siniestro</option>
					<option value="Consignados">Consignados</option>
				</select>
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['motivo'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['motivo'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div class="col-md-3">
				<label>Taller</label>
				<select name="talleres" class="form-control" id="talleres">
					<?php if(isset($_SESSION['error_guardar']['talleres'])): ?>
					<option><?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['talleres']:false; ?></option>
				<?php endif; ?>
					<option value="vacio">Selecciona un taller</option>
					<?php foreach($listaTalleres as $row): ?>	
					<option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>	
					<?php endforeach; ?>
				</select>
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['taller'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['taller'] : "" ?>
					</div>
				<?php endif; ?>						
			
			</div>

			<div class="col-md-3">
				<label>Folio de Reporte</label>
				<input type="text" name="folio" placeholder="Ingresa el folio de reporte" class="form-control" value="<?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['folio'] : false; ?>">
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['folio'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['folio'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div class="col-md-3">
				<label>Costo </label>
				<input class="form-control" type="text" name="costo" placeholder="Costo" value="<?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['costo'] : false; ?>">
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['costo'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['costo'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div class="col-md-3">
				<label>Estatus : </label>
				<select class="form-control" name="estatus" id="estatus">
					<?php if(isset($_SESSION['error_guardar']['estatus'])): ?>
					<option><?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['estatus'] : false; ?></option>
				<?php endif; ?>
					<option value="vacio">Selecciona un estatus :</option>
					<?php foreach($listaEstatus as $row): ?>
						<option value="<?= $row['id']?>"><?=$row['nombreEstatus']?></option>
					<?php endforeach; ?>
				</select>
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['estatus'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['estatus'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div  class="col-md-12">
				<label>Descripcion de la Falla :</label>
				<textarea name="comentario" class="form-control" rows="3" placeholder="Ingresa tu comentario ..."><?php echo isset($_SESSION['error_guardar']) ? $_SESSION['error_guardar']['comentario'] : false; ?></textarea>
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['descripcion'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['descripcion'] : "" ?>
					</div>
				<?php endif; ?>								
			</div>
	<div class="row">

	
		<div class="btn btn-group-sm">
			<button class="btn btn-primary" type="submit" name="btnGuardar" value="Guardar">Guardar
			</button>
	
			<a href="reporteExcel/ExcelDisponibles.php" type="button" class="btn btn-success" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Generar Excel
             </a>
			 <?php if($_SESSION['user']['categoria']==1 || $_SESSION['user']['categoria'] == 4): ?>
			<a href="reporteExcel/ExcelCoorporativo.php" type="button" class="btn btn-success" style="margin-right: 5px;">
                <i class="fas fa-download"></i> disponibilidad Coorporativo
             </a>
			 <?php endif; ?>		
		</div>
	</div>

</form>	
</div>

<h3>Tabla de Disponibilidad</h3>

<div class="completo">
<?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?>
</div>

<div class="completo">
<?php echo isset($_SESSION['completado']) ? $_SESSION['completado'] : ""; ?>
</div>

<!---Formulario para filtro avanzado--->
<?php 
//Validacion para que solo el admin pueda ver los filtros
if($_SESSION['user']['categoria'] == 1) : ?>

	<form action="" method="post"> 
		<div class="col-md-4">
			<div class="alert alert-warning">
				<small>Para mostrar todos los registros agrega "Selcciona un estatus"</small>
			</div>
		</div>
		<label>Estatus : </label>
			<select name="estatusId" id="estatus">
				<option value="vacio">Seleccion un estatus :</option>
					<?php foreach($listaEstatus as $row): ?>
						<option value="<?= $row['id']?>"><?=$row['nombreEstatus']?></option>
					<?php endforeach; ?>
				</select>

		<button type="submit" name="enviar">Buscar</button>
	</form>
	
<?php endif; ?>

<!---Formulario para filtro avanzado--->


<div class="box-body">


<div class="card-footer">	

	<table id="table_id" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Eco</th>
			<th>Suc</th>	
			<th>Op</th>	
			<th>Ingreso</th>
			<th>Promesa</th>
			<th>Entrega</th>
			<th>Motivo</th>
			<th>Status</th>
			<th>Costo</th>
			<th>Dias</th>
			<!--<th>Descripcion</th>-->
			<th>Acciones</th>
			<th>Acciones</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($listaDisponibles as $rows): ?>
		<tr>

			<td><?php echo $rows['economico']; ?></td>
			<td><?php echo $rows['nombreModelo']; ?></td>
			<td><?php echo $rows['nombreOperacion']; ?></td>
			<td><?php echo $rows['fechaIngreso']; ?></td>
			<td><?php echo $rows['fechaPromesa']; ?></td>
			<td><?php echo $rows['fechaEntrega']; ?></td>
			<td><?php echo $rows['motivo']; ?></td>
			<td><?php echo $rows['nombreEstatus']; ?></td>
			<td><?php echo " $ " .number_format($rows['costoReparacion']); ?></td>
			<td><?php echo  ($rows['DiasFuera'] >= 5) ? "<p style='color:white; background:red;'>".$rows['DiasFuera']."</p>" : $rows['DiasFuera']; ?></td>
			<!--<td><?php// echo $rows['descripcionFalla']; ?></td>-->
			<td>
				<a href="#" onclick="preguntar(<?php echo $rows['id'] ?>);"  class="btn btn-danger"><i class="fas fa-trash"></i></a>
			</td>
			<td>
	            <a href="actualizarDisponibilidad.php?id=<?php echo $rows['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
			</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table >	
</div>
</div>

	<script type="text/javascript">
			
			function seleccion(){
				var sucursal = document.getElementById('sucursales').value;

				alert("Riacrdo");
			}


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
				  	window.location.href = "eliminarDisponibilidad.php?id="+id;
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