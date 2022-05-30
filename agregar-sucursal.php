<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['guardar'])){
        $idpais=$_POST['idpais'];//Guardamos los datos
        $idprovincia=$_POST['idprovincia'];
        $idciudad=$_POST['idciudad'];
        $direccion=$_POST['direccion'];
        $telefono=$_POST['telefono'];

        //Consulta para insertar
        $sql = "INSERT INTO sucursales SET paises_id='$idpais', provincias_id='$idprovincia', ciudades_id='$idciudad', 
        sucursales_direccion='$direccion', sucursales_telefono=$telefono";
        
        //Ejecutar consulta
        $result=$connect->query($sql);
	    if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Sucursal registrada correctamente';
        $_SESSION['message_type']= 'success';

        header("Location: sucursales.php");
        
    }
?>