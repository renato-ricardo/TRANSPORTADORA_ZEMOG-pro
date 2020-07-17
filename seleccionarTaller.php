<?php
//Importacion de documentos
require_once 'includes/talleresFunciones.php';

//Instancia de clase

$fun_tall = new talleresFunciones();

if(isset($_POST)){
    
    $id = isset($_POST['id']) ? $_POST['id'] : false;
    $nombreTaller = isset($_POST['nombreTaller']) ? $_POST['nombreTaller'] : false;
    $direccionTaller = isset($_POST['direccionTaller']) ? $_POST['direccionTaller'] : false;

    $validacion = $fun_tall->update($id,$nombreTaller,$direccionTaller);

    if($validacion){
        header("location:talleres.php");
    }else{
        die("Error en tu codigo Hermano");
    }
    
}

