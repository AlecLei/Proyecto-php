<?php

    $host = "localhost";
    $usuario = "root";
    $password ="";
    $db = 'facturacion';

    $conection = @mysqli_connect($host, $usuario, $password, $db);

    if(!$conection){
        echo "Error en la conexion";
    }
?>