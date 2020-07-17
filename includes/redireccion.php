<?php

//Establece el limitador a private 

$cache_limiter = session_cache_limiter();
 //establecer la caducidad de la cache a 30 min

session_cache_expire(2);
$cache_expire = session_cache_expire();



if(!isset($_SESSION)){
    session_start();
}


if(!isset($_SESSION['user'])){
    
    header("Location:index.php");
        
}
