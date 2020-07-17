<?php 
require_once 'includes/usuarioFunciones.php';
require_once 'includes/helpers.php';

$funciones = new usuarioFunciones();

$id = isset($_POST['id']) ? test_input($_POST['id']) :"" ;
$usuario = isset($_POST['usuario']) ? test_input($_POST['usuario']) : "";
$password = isset($_POST['contraseña']) ? test_input($_POST['contraseña']) : "";
$sucursal = isset($_POST['Sucursales']) ? test_input($_POST['Sucursales']) : "";
$tipo = isset($_POST['tipo']) ? test_input($_POST['tipo']) : "";


$funciones->update($id,$usuario,$password,$tipo,$sucursal);
header("location:usuarios.php");

