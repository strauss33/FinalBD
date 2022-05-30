<?php 
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "DELETE FROM empleados WHERE empleados_id = $id"; 
        $result= mysqli_query($connect, $consulta); 
        
        if(!$result){
            $_SESSION['message']= 'Error al eliminar, este vendedor se encuentra vinculado a una venta';
            $_SESSION['message_type']= 'danger';

        }else{
            $_SESSION['message']= 'Vendedor eliminado correctamente';
            $_SESSION['message_type']= 'danger';
        }
        header("Location: empleados.php");
    }

?>