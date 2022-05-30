<?php 
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "DELETE FROM productos WHERE productos_id = $id"; //Elimina el producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(!$result){
            $_SESSION['message']= 'Error al eliminar, este producto se encuentra vinculado a una venta';
            $_SESSION['message_type']= 'danger';

        }else{
            $_SESSION['message']= 'Producto eliminado correctamente';
            $_SESSION['message_type']= 'danger';
        }
        header("Location: productos.php");
    }

?>