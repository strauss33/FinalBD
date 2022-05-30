<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT * FROM empleados WHERE empleados_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $nombre= $row['empleados_nombre'];
            $dni= $row['empleados_dni'];
            $telefono= $row['empleados_telefono'];
            $direccion= $row['empleados_direccion'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $nombre= $_POST['nombre'];
        $dni= $_POST['dni'];
        $telefono= $_POST['telefono'];
        $direccion= $_POST['direccion'];

        $consulta= "UPDATE empleados set empleados_nombre='$nombre', empleados_dni='$dni' , empleados_telefono ='$telefono', empleados_direccion='$direccion' WHERE empleados_id= $id";
        mysqli_query($connect,$consulta);
        $_SESSION['message']= 'Empleado editado correctamente';
        $_SESSION['message_type']='warning';
        header("Location: empleados.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar-emp.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nuevo nombre">
                    </div>
                    <div class="form-group">
                        <input name="dni" type="text" class="form-control" value="<?php echo $dni; ?>" placeholder="Nuevo dni">
                    </div>
                    <div class="form-group">
                        <input name="telefono" type="text" class="form-control" value="<?php echo $telefono; ?>" placeholder="Nuevo telefono">
                    </div>
                    <div class="form-group">
                        <input name="direccion" type="text" class="form-control" value="<?php echo $direccion; ?>" placeholder="Nueva direccion">
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="cargar" value="Cargar" >
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>