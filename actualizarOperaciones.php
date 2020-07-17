<?php
require_once 'includes/operacionesFunciones.php';
require_once 'includes/helpers.php';

$funciones = new operacionesFunciones();

if(isset($_POST)){

    echo "Envio de Datos correctos";

    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : false;


   $validacion = $funciones->update($id,$operacion);

    if($validacion){
        header('location:operaciones.php');
    }else{
        echo "No podimos actualizar los datos";
        die();
    }



}