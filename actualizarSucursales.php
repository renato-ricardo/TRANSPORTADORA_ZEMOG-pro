<?php 

require_once 'includes/sucursalFunciones.php';
require_once 'includes/helpers.php';
$funciones = new sucursalFunciones();

$id = isset($_POST['id']) ? test_input($_POST['id']) : "";
$nombre = isset($_POST['nombre']) ? test_input($_POST['nombre']) : "";
$direccion = isset($_POST['direccion']) ? test_input($_POST['direccion']) :"";
$telefono = isset($_POST['telefono']) ? test_input($_POST['telefono']) : "";
$operacion = isset($_POST['operacion']) ? test_input($_POST['operacion']) : "";
$numeroLocalidad = isset($_POST['localidad']) ? test_input($_POST['localidad']) :"";

$funciones->Actualizar($id,$nombre,$direccion,$telefono,$numeroLocalidad,$operacion);
header("Location:sucursal.php");

?>