<?php

require_once 'includes/redireccion.php';
require_once 'includes/sucursalFunciones.php';
require_once 'includes/tipoUsuario.php';
require_once 'includes/operacionesFunciones.php';

$funciones = new operacionesFunciones();

$id = $_GET['id'];

$datos = $funciones->seleccionarPorId($id);


?>

<div class="card-header">
        <h5 class="card-title m-0">Registro de Operaciones</h5>
  </div>
<div class="card-body">

	<form action="actualizarOperaciones.php" method="post" autocomplete="off">
		  	<input class="form-control" type="hidden" name="idUsuario" value="<?php echo $_SESSION['user']['id'] ?>">	
		  	<input class="form-control" type="hidden" name="id" value="<?php echo $datos['id'] ?>">	
		<div class="row">
                <div class="col-md-12">
                    <label for="nombre">Operacion:</label>
                    <input class="form-control" autofocus="on" type="text" name="operacion" placeholder="Ingresa la operacion" value="<?php echo $datos['nombreOperacion']?>">
                    <div class="alert-warning"><?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['economico'] : "";?></div>                            
				</div>
		</div>
            <div class="row">
                <div class="btn btn-group-sm">
                    <button type="submit" class="btn btn-success" name="btnNombre" ><i class="fa fa-save"></i> Actualizar</button>
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





<?php require 'includes/layout/footer.php'; ?>