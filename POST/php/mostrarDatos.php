<?php

    include_once 'conexion.php';

    
    $sql = "SELECT * FROM desconocidos";
    $stm = $conn->prepare($sql);

    $validacion = $stm->execute();
       
    $resultSet = $stm->fetchAll(PDO::FETCH_ASSOC);
    

    if($validacion){
        echo json_encode($resultSet);
    }else{
        echo json_encode("ERROR");
    }
