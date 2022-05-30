<?php 
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "DELETE FROM proveedores WHERE proveedores_id = $id"; //Elimina el producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(!$result){
            $_SESSION['message']= 'Error al eliminar, este proveedor se encuentra vinculado a una compra';
            $_SESSION['message_type']= 'danger';

        }else{
            $_SESSION['message']= 'Proveedor eliminado correctamente';
            $_SESSION['message_type']= 'danger';
        }
        header("Location: proveedores.php");
    }

?>