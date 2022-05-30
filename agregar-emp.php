<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['guardar'])){
        $nombre=$_POST['nombre'];//Guardamos los datos
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $direccion=$_POST['direccion'];
        //Consulta para insertar
        $sql = "INSERT INTO empleados (empleados_nombre, empleados_dni, empleados_telefono, empleados_direccion) VALUES ('$nombre', '$dni', '$telefono', '$direccion')";
        
        //Ejecutar consulta
        $result=$connect->query($sql);
	    if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Empleado guardado correctamente';
        $_SESSION['message_type']= 'success';

        header("Location: empleados.php");
        
    }
?>