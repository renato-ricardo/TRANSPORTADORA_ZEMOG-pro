<?php 

require_once 'includes/sucursalFunciones.php';

$funciones = new sucursalFunciones();

$id = $_POST['id'];
$nombre = $_POST['nombre'];



$funciones->Actualizar($id,$nombre);

header("Location:sucursal.php");

?>