<?php 


require_once 'includes/redireccion.php';
require_once 'includes/funcionesDisponibilidad.php';
require 'includes/tipoUsuario.php';
//require_once 'includes/layout/header.php';

//instancia de clase 
$funciones = new funcionesDisponibilidad();

$usuarios = (int) $_SESSION['user']['sucursal'];


$listaUnidades = mostrarComboUnidad('unidades',$usuarios);
$listaSucursales = mostrarBaseCombo('sucursales',$usuarios);
$listaDisponibles = $funciones->mostrarDisponibles($usuarios);

$listaTalleres = mostrarDatos("talleres");
$listaEstatus = mostrarDatos('estatus');


if(isset($_GET)){

		$datos = $funciones->seleccionarPorId($_GET['id']);
	
}
	

$estatus = $datos['nombreEstatus'];



?>




<div class="card-body">
	<form action="actualizarDispo.php" method="POST" autocomplete="off">
		<div class="row">
			<div class="col-md-3">
				<input type="hidden" name="id" value="<?php echo $datos['id']?>">
				<label>Unidad :</label>
				<select name="economico" class="form-control" id="miunidad">
					
					<option value="<?=$datos['idUnidad']?>"><?=$datos['economico']?></option>
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
			<!--Sucursales-->
			<div class="col-md-3">
				<label>Sucursal :</label>
					<select name="sucursal" class="form-control" id="sucursales">
						<option value="<?php echo $datos['idSucursal'] ?>"><?php echo $datos['nombreSucursal'] ?></option>
					<?php foreach($listaSucursales as $row): ?>
						<option value="<?php echo $row['id']?>"><?=$row['nombreSucursal']?></option>
					<?php endforeach; ?>
					</select>
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['sucursal'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['sucursal'] : "" ?>
					</div>
				<?php endif; ?>			
			</div>
			<div class="col-md-3">
				<label>Fecha de Ingreso :</label>
				<input type="date" name="fechaIngreso" class="form-control" value="<?php echo $datos['fechaIngreso'] ?>">
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['fechaIngreso'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['fechaIngreso'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div class="col-md-3">
				<label>Fecha Promesa :</label>
				<input type="date" name="fechaPromesa" class="form-control" value="<?php echo $datos['fechaPromesa'] ?>">
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['fechaPromesa'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['fechaPromesa'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>

			<div class="col-md-3">
				<label>Motivo :</label>
				<select name="motivo" class="form-control">
					<option value="<?php echo $datos['motivo']; ?>"><?php echo $datos['motivo']; ?></option>
					<option value="Garantia">Garantia</option>
					<option value="Mantenimiento Correctivo">Mantenimiento Correctivo</option>
					<option value="Mantenimiento Preventivo">Matenimiento Preventivo</option>
					<option value="Rescate">Rescate</option>
					<option value="Siniestro">Siniestro</option>
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
					<option value="<?=$datos['idTalleres']?>"><?=$datos['nombre']?></option>
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
				<input type="text" name="folio" placeholder="Ingresa el folio de reporte" class="form-control" value="<?php echo $datos['folioReporte']?>">
				<!--alerta para registros vacios-->
				<?php if(isset($_SESSION['errores']['folio'])): ?>
					<div class="alert alert-warning">
				<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['folio'] : "" ?>
					</div>
				<?php endif; ?>						
			</div>
			<div class="col-md-3">
				<label>Costo </label>
				<input class="form-control" type="text" name="costo" placeholder="Costo" value="<?php echo $datos['costoReparacion'] ?>">
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
					<option value="<?php echo $datos['idEstatus'] ?>"><?=$datos['nombreEstatus']?></option>
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
				<textarea name="comentario" class="form-control" rows="3" placeholder="Ingresa tu comentario ..."><?php echo $datos['descripcionFalla'] ?></textarea>
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
			<a href="disponibilidad.php" type="button" class="btn btn-success" style="margin-right: 5px;">
                <i class="fas fa-download"></i> Regresar
             </a>
		</div>
	</div>

</form>	
</div>

<script type="text/javascript">
		
	function mostrar(){
		
		var fechaEntrega = document.getElementById('fechaEntrega').value;

		alert(fechaEntrega);

	}



</script>

<?php 

require 'includes/layout/footer.php'; ?>