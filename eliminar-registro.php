<?php 
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "DELETE FROM ventas WHERE ventas_id = $id"; //Elimina el producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(!$result){
            die("Error");

        }

        $_SESSION['message']= 'Venta eliminada correctamente';
        $_SESSION['message_type']= 'danger';
        
        header("Location: registroventas.php");
    }

?>