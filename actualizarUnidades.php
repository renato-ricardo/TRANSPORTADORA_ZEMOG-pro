<?php 
require 'includes/redireccion.php';
require 'includes/tipoUsuario.php';
require_once 'includes/unidadesFunciones.php'; 
//require 'includes/layout/header.php';

$listaSucursales = mostrarDatos("sucursales");
$listaEstatus = mostrarDatos("estatus");
$listaOperaciones = mostrarDatos("operaciones");
$listaDatos  = new unidadesFunciones();
$usuarios = (int) $_SESSION['user']['sucursal'];

var_dump($_SESSION['user']['categoria']);

$id = isset($_GET['id']) ? $_GET['id']:"";
$datos = $listaDatos->seleccionarPorId($id);



$listaUnidades = mostrarUnidades('unidades',$usuarios);

$listaMarcas = mostrarDatos('marcas_Unidades');
$listaEstatus = mostrarDatos("estatus_disponible"); 



?>


<div class="card-body">

	<form action="updateUnidades.php" method="post" autocomplete="off" enctype="multipart/form-data">

		<div class="row">
           <input type="hidden" class="form-control"  name="id" value="<?=$datos['IdUnidad']?>"> 
                <div class="col-md-3">
                    <label for="nombre">Economico:</label>
                    <input class="form-control" autofocus="on" disabled type="text" name="economico" placeholder="Ingresa el numero economico" value="<?=$datos['economico']?>">
                    <div class="alert-warning"><?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['economico'] : "";?></div>                            
                </div>
                <div class="col-md-3">
                	<label>Serie</label>
                	<input class="form-control" type="text" name="serie" placeholder="Ingresa la serie del vehiculo" value="<?=$datos['serie']?>" disabled>
                </div>
                <div class="col-md-3">
                	<label>Placas</label>
                	<input class="form-control" type="text" name="placas" placeholder="Ingresa las placas del vehiculo" value="<?=$datos['placas']?>">
                </div>
                <div class="col-md-3">
                	<label>Modelo</label>
                	<input value="<?=$datos['modelo']?>" class="form-control" type="text" name="modelo" placeholder="Ingresa el año del vehiculo" disabled>
                </div>
                <div class="col-md-3">
                	<label>Estatus</label>
                	<select class="form-control" name="estatus">
                    <option value="<?=$datos['idEstatus']?>"><?=$datos['nombreEstatus']?></option>
                    <?php foreach($listaEstatus as $row):?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombreEstatus']; ?></option>
                  <?php endforeach; ?>
                	</select>
                </div>	
               <div class="col-md-3">
                	<label>Operaciones</label>
                	<select class="form-control" name="operacion" id="operacion">
                    <option value="<?=$datos['idOperacion']?>"><?=$datos['nombreOperacion']?></option>
                    <?php foreach($listaOperaciones as $rows):?>
                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreOperacion']; ?></option>
                  <?php endforeach; ?>
                	</select>
                </div>	              
                <div class="col-md-3">
                	<label>Sucursal</label>
              		<select class="form-control" name="Sucursales_id" id="sucursales">
                    <option value="<?=$datos['idSucursal']?>"><?=$datos['nombreSucursal'] ?></option>
                    <option>Selecciona una unidad</option>
              			<?php foreach($listaSucursales as $rows): ?>
              			<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreSucursal'] ?></option>
              			<?php endforeach; ?>
              		</select>	
                </div>
                <div class="col-md-3">
                	<label>Importar Imagen</label>
                	<input class="form-control" type="file" name="imagen" class="form-control">
                    <input type="text" name="url" class="form-control" value="<?=$datos['imagen']?>">    
                </div>
                <div class="col-md-3">
                	<label for="nombre">Mad:</label>
        					<select class="form-control" id="mad" name="mad" disabled>
        						<option value="<?=$datos['mad']?>"><?=$datos['mad']?></option>
        					    <option data-select2-id="46" value="MOTRIZ">MOTRIZ</option>
        					    <option data-select2-id="48" value="ARRASTRE">ARRASTRE</option>
        					    <option data-select2-id="49" value="DOLLY">DOLLY</option>
        					</select>
               	</div>
                <div class="col-md-3">
                  <label>Marca :</label>
                  <select name="marca" class="form-control" id="marca" disabled>
                  	<option value="<?=$datos['idMarca']?>"><?=$datos['nombreMarca']?></option>
                    <?php foreach($listaMarcas as $row): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombreMarca'] ?></option>
                  <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                    <label>Iave :</label>
                    <input class="form-control" type="text" name="iave" placeholder="Ingresa la tarjeta Iave" value="<?=$datos['iave']?>">
                    <div class="alert-warning"><?= isset($_SESSION['errores_frm']['placas']) ? $_SESSION['errores_frm']['placas'] : "" ?></div>          
                </div>                          	
         	</div>

             <div class="row">
                <div class="btn btn-group-sm">
                    <button style="color: white" type="submit" class="btn btn-warning" name="btnNombre" ><i class="fa fa-save "></i> Actualizar</button>
                    <a class="btn btn-success" href="unidades.php"><i class="fa fa-file-excel-o"></i>Atras</a>                    
                </div>
            </div>   

	</form>		
        <div class="form-group">
             <img style="width: 100%; height: 50%;" class="img-thumbnail rounded mx-auto d-block" src="<?php echo !empty($datos['url']) ? $datos['url'] : "<p>Agregar imagen</p>"; ?>"/>
        </div>


<?php require_once 'includes/layout/footer.php'; ?>