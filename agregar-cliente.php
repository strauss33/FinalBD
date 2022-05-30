<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['guardar'])){
        $nombre=$_POST['nombre'];//Guardamos los datos
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $mail=$_POST['mail'];
        //Consulta para insertar
        $sql = "INSERT INTO clientes (clientes_nombre, clientes_dni, clientes_telefono , clientes_mail) VALUES ('$nombre', '$dni', '$telefono', '$mail')";
        
        //Ejecutar consulta
        $result=$connect->query($sql);
	    if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Cliente guardado correctamente';
        $_SESSION['message_type']= 'success';

        header("Location: clientes.php");
        
    }
?>