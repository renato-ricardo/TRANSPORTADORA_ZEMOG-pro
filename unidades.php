<?php 
require 'includes/redireccion.php';
require 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';
 ?>


<?php 
$listaSucursales = mostrarDatos("sucursales");
$listaEstatus = mostrarDatos("estatus");
$listaOperaciones = mostrarDatos("operaciones");
$usuarios = (int) $_SESSION['user']['sucursal'];

//$listaUnidades = mostrarComboUnidadDisponibilidad('unidades',$usuarios);
$listaUnidades = mostrarUnidades('unidades',$usuarios);
$listaMarcas = mostrarDatos('marcas_Unidades');
$listaEstatus = mostrarDatos("estatus_disponible"); 



?>



<div class="card-header">

<h5 class="card-title m-0">Registro de Unidades</h5>    

 </div> 
<?php require_once 'dashboard/Unidadesdashboard.php' ?>

<?php if($_SESSION['user']['categoria'] == 1 || $_SESSION['user']['categoria'] == 4 ): ?>

<div class="card-body">
	<form action="guardarUnidades.php" method="post" autocomplete="off" enctype="multipart/form-data">
		  	<input class="form-control" type="hidden" name="Usuarios_id" value="<?php echo $_SESSION['user']['id'] ?>">	
		<div class="row">
                <div class="col-md-3">
                    <label for="nombre">Economico:</label>
                    <input class="form-control" autofocus="on" type="text" name="economico" placeholder="Ingresa el numero economico">
                    <div class="alert-warning"><?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['economico'] : "";?></div>                            
                </div>
                <div class="col-md-3">
                	<label>Serie</label>
                	<input class="form-control" type="text" name="serie" placeholder="Ingresa la serie del vehiculo">
                </div>
                <div class="col-md-3">
                	<label>Placas</label>
                	<input class="form-control" type="text" name="placas" placeholder="Ingresa las placas del vehiculo">
                </div>
                <div class="col-md-3">
                	<label>Modelo</label>
                	<input class="form-control" type="text" name="modelo" placeholder="Ingresa el año del vehiculo">
                </div>
                <div class="col-md-3">
                	<label>Estatus</label>
                	<select class="form-control" name="estatus">
                    <option>Selecciona un estatus</option>
                    <?php foreach($listaEstatus as $row):?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombreEstatus']; ?></option>
                  <?php endforeach; ?>
                	</select>
                </div>	
               
                <div class="col-md-3">
                	<label>Sucursal</label>
              		<select class="form-control" name="Sucursales_id" id="sucursales">
                    <option>Selecciona una unidad</option>
              			<?php foreach($listaSucursales as $rows): ?>
              			<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreSucursal'] ?></option>
              			<?php endforeach; ?>
              		</select>	
                </div>

                <div class="col-md-3">
                  <label>Operacion</label>
                  <select class="form-control" name="operaciones_id" id="sucursales">
                    <option>Selecciona una operacion</option>
                    <?php foreach($listaOperaciones as $rows): ?>
                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreOperacion'] ?></option>
                    <?php endforeach; ?>
                  </select> 
                </div>    

                <div class="col-md-3">
                	<label>Importar Imagen</label>
                	<input class="form-control" type="file" name="imagen" class="form-control">
                </div>
                <div class="col-md-3">
                	<label for="nombre">Mad:</label>
        					<select class="form-control" id="mad" name="mad">
        					    <option data-select2-id="46">Motriz</option>
        					    <option data-select2-id="48">Arrastre</option>
        					    <option data-select2-id="49">Dolly</option>
        					</select>
               	</div>
                <div class="col-md-3">
                  <label>Marca :</label>

                  <select name="marca" class="form-control" id="marca">
                    <?php foreach($listaMarcas as $row): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombreMarca'] ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
               	<div class="col-md-3">
               		<label>Tipo</label>
               		<select class="form-control" name="tipo" disabled>
               			<option value="Caja Seca">Caja Seca</option>
               			<option value="Plataforma Encortinada">Plataforma Encortinada</option>
               			<option value="Volvo">Volvo</option>
               		</select>
               	</div>
                <div class="col-md-3">
                    <label>Placas :</label>
                    <input class="form-control" type="text" name="placas" placeholder="Numero de placas">
                    <div class="alert-warning"><?= isset($_SESSION['errores_frm']['placas']) ? $_SESSION['errores_frm']['placas'] : "" ?></div>          
                </div>
                <div class="col-md-3">
                    <label>Iave :</label>
                    <input class="form-control" type="text" name="iave" placeholder="Ingresa la tarjeta Iave">
                    <div class="alert-warning"><?= isset($_SESSION['errores_frm']['placas']) ? $_SESSION['errores_frm']['placas'] : "" ?></div>          
                </div>                          	
         </div>
 
            <div class="row">
                <div class="btn btn-group-sm">
                    <button type="submit" class="btn btn-success" name="btnNombre" ><i class="fa fa-save"></i> Guardar</button>
                    <a class="btn btn-success" onclick="alert('Creando Excel')" href="reporteExcel/ExcelUnidades.php"><i class="fa fa-file-excel-o"></i> Excel</a>                    
                </div>
            </div>   

	</form>		
</div>
<?php endif; ?>
			<?php if(isset($_SESSION['completo']) ): ?>
			<div class="alert alert-success">
			<?php echo isset($_SESSION['completo']) ? $_SESSION['completo'] : ""; ?>
			</div>

			<div class="completo">
			<?php echo isset($_SESSION['completado']) ? $_SESSION['completado'] : ""; ?>
			</div>

		<?php endif; ?>


      

<div class="card-footer">
	<table id="table_id" class="table table-bordered table-hover">
    <thead>
		<tr>
			<th>Id</th>
			<th>Economico</th>
			<th>Operacion</th>
			<th>Serie</th>
      <th>Sucursal Modelo</th>
      <th>Sucursal Zemog</th>
      <th>Estatus</th>
      <?php if($_SESSION['user']['categoria']==1|| $_SESSION['user']['categoria'] == 4): ?>
			<th>Acciones</th>	
			<th>Acciones</th>	
    <?php endif;?>
		</tr>
    </thead>
    <tbody>
      <?php foreach($listaUnidades as $rows): ?>
		<tr>
			<td><?php echo $rows['id']; ?></td>
			<td><?php echo $rows['economico']; ?></td>	
			<td><?php echo $rows['nombreOperacion']; ?></td>	
			<td><?php echo $rows['serie']; ?></td>	
      <td><?php echo $rows['nombreSucursal']; ?></td> 
      <td><?php echo $rows['nombreModelo']; ?></td> 
      <td><?php echo $rows['nombreEstatus']; ?></td>  
			<!---<td ><a target="_blank" href="<?php echo $rows['url'] ?>"><img id="imagen" height="45px" width="45px" src="<?=$rows['url']?>"></a></td>	-->
            <?php if($_SESSION['user']['categoria']==1 || $_SESSION['user']['categoria'] == 4): ?>
      <td>
          <a href="#" onclick="preguntar(<?php echo $rows['id'] ?>);"  class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
      <td>
          <a href="actualizarUnidades.php?id=<?php echo $rows['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
      </td>
          <?php endif;?>
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
				  	window.location.href = "eliminarUnidades.php?id="+id;
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