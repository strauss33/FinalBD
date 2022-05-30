<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['guardar'])){
        $nombre=$_POST['nombre'];//Guardamos los datos
        $tipo=$_POST['tipo'];
        $marca=$_POST['marca'];
        $precio=$_POST['precio'];
        //Consulta para insertar
        $sql = "INSERT INTO productos (productos_nombre, productos_tipo, productos_marca, productos_precio) VALUES ('$nombre', '$tipo', '$marca', '$precio')";
        
        //Ejecutar consulta
        $result=$connect->query($sql);
	    if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Producto guardado correctamente';
        $_SESSION['message_type']= 'success';

        header("Location: productos.php");
        
    }
?>

