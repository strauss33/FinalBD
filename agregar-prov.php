<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['guardar'])){
        $nombre=$_POST['nombre'];//Guardamos los datos
        $cuit=$_POST['cuit'];
        $telefono=$_POST['telefono'];
        $direccion=$_POST['direccion'];
        //Consulta para insertar
        $sql = "INSERT INTO proveedores (proveedores_nombre, proveedores_cuit, proveedores_telefono, proveedores_direccion) VALUES ('$nombre', '$cuit', '$telefono', '$direccion')";
        
        //Ejecutar consulta
        $result=$connect->query($sql);
	    if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Proveedor guardado correctamente';
        $_SESSION['message_type']= 'success';

        header("Location: proveedores.php");
        
    }