<?php

    session_start(); //Iniciar una sesion que nos permita guardar mensajes

    //Declaro variables para la conexion
    $server="localhost"; //Servidor a utilizar, en este caso localhost
    $user="root";        //Usuario de la base de datos
    $pass="";            //La contraseña del usuario que utilizaremos
    $db="trabajo";       //El nombre de la base de datos

    //Creo la conexion
    $connect= mysqli_connect($server,$user,$pass,$db);

    /*Verifico que la conexion se realizo
    if(!$conexion){
        echo "Fallo la conexion <br>";
        die("Connection failed:" . mysqli_connect_error());
    }else{
        echo "Conexion exitosa";
    }*/

?>