<?php

include_once 'conexion.php';


if(isset($_POST)){

  
    //transforma una JSON a un arreglo asociativo json_decode(JSON,TRUE)
   // json_encode

    //Transforma una arreglo asociativo a un JSON.

    //tenemos los datos que nos envia el formulario

    $title = $_POST['txtNombre'];
    $body = $_POST['txtCuerpo'];

  
    //Conexion PDO 

        $sql = "INSERT INTO desconocidos(title,body) VALUES(:titulo,:cuerpo)";
        $stm = $conn->prepare($sql);
        
        $stm->bindValue(':titulo',$title);
        $stm->bindValue(':cuerpo',$body);
   

        $validacion = $stm->execute();
    
        
        if($validacion){
            echo json_encode("SUCCESS");
        }else{
            echo json_encode("ERROR");
        }
    

}




