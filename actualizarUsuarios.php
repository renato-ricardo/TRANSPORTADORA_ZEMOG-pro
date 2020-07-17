  <?php 
require 'includes/redireccion.php';
require 'includes/usuarioFunciones.php';
require 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';


$listaUsuarios = mostrarUsuarios();
$listaCategorias = mostrarDatos("categorias"); 
$listaSucursales = mostrarDatos("sucursales"); 
$usuarios = (int) $_SESSION['user']['sucursal'];
$funciones = new usuarioFunciones();


if (isset($_GET)) {
	$usuario = $funciones->seleccionarPorId($_GET['id']);

	$idUsuario = $usuario['id'];
	$idCategoria = $usuario['idCategoria'];
	$idSucursal = $usuario['idSucursal'];

	$nombre = $usuario['nombreUsuario'];
	$correo = $usuario['correoElectronico'];
	$contraseña = $usuario['contraseña'];
	$categoria = $usuario['nombreCategoria'];
	$sucursal = $usuario['nombreSucursal'];

}

 ?>


  <div class="card-header">
        <h5 class="card-title m-0">Actualizar de Usuarios</h5>

  </div>

<div class="card-body">

	<form action="actualizarUser.php" method="post" autocomplete="off">
		<div class="row">
                <div class="col-md-3">
                	<input type="hidden" name="id" value="<?php echo isset($idUsuario) ? $idUsuario : "" ?>">
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
					<input class="form-control" type="password" name="contraseña" placeholder="Ingresa una contraseña" value="<?php echo isset($contraseña) ? $contraseña : "";?>">
				<?php if(isset($_SESSION['errores'])): ?>
					<div class="alert alert-warning">
						<?php echo isset($_SESSION['errores']) ? $_SESSION['errores']['contraseña'] : "" ?>
					</div>
				<?php endif; ?>
				</div>			
				<div class="col-md-3">
					<label>Sucursal</label>
					<select class="form-control" name="Sucursales">
						<option value="<?=$idSucursal?>"><?php echo $sucursal?></option>
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
					
					<select class="form-control" name="tipo">
						<option value="<?=$idCategoria?>"><?=$categoria?></option>
						<?php foreach($listaCategorias as $rows): ?>
						<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nombreCategoria'] ?></option>
					<?php endforeach; ?>
					</select>
				</div>
		</div>			

				<div class="row">
					<div class="btn btn*-group-sm">
						<button class="btn btn-warning" type="submit" name="btnGuardar" value="Guardar">Actualizar</button>
						<a href="usuarios.php" class="btn btn-success">Regresar</a>
					</div>
				</div>
	</form>		

	<?php require 'includes/layout/footer.php'; ?>