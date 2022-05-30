<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT * FROM proveedores WHERE proveedores_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $nombre= $row['proveedores_nombre'];
            $cuit= $row['proveedores_cuit'];
            $telefono= $row['proveedores_telefono'];
            $direccion= $row['proveedores_direccion'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $nombre= $_POST['nombre'];
        $cuit= $_POST['cuit'];
        $telefono= $_POST['telefono'];
        $direccion= $_POST['direccion'];

        $consulta= "UPDATE proveedores set proveedores_nombre='$nombre', proveedores_cuit='$cuit' , proveedores_telefono ='$telefono', proveedores_direccion='$direccion' WHERE proveedores_id= $id";
        mysqli_query($connect,$consulta);
        $_SESSION['message']= 'Proveedor editado correctamente';
        $_SESSION['message_type']='warning';
        header("Location: proveedores.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar-prov.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nuevo nombre">
                    </div>
                    <div class="form-group">
                        <input name="cuit" type="text" class="form-control" value="<?php echo $cuit; ?>" placeholder="Nuevo cuit">
                    </div>
                    <div class="form-group">
                        <input name="telefono" type="text" class="form-control" value="<?php echo $telefono; ?>" placeholder="Nuevo telefono">
                    </div>
                    <div class="form-group">
                        <input name="direccion" type="text" class="form-control" value="<?php echo $direccion; ?>" placeholder="Nueva direccion">
                    </div>
                    <button class="btn btn-success" name="cargar">Cargar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>