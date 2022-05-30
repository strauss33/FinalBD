<?php 
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "DELETE FROM sucursales WHERE sucursales_id = $id"; //Elimina el producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(!$result){
            die("Error");

        }

        $_SESSION['message']= 'Sucursal eliminada correctamente';
        $_SESSION['message_type']= 'danger';
        
        header("Location: sucursales.php");
    }

?>