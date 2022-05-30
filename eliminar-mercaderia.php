<?php 
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "DELETE FROM compras WHERE compras_id = $id"; //Elimina el producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(!$result){
            die("Error");
        }

        $_SESSION['message']= 'Registro de compra eliminado correctamente';
        $_SESSION['message_type']= 'danger';
        
        header("Location: mercaderia.php");
    }

?>