<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT * FROM productos WHERE productos_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $nombre= $row['productos_nombre'];
            $tipo= $row['productos_tipo'];
            $marca= $row['productos_marca'];
            $precio= $row['productos_precio'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $nombre= $_POST['nombre'];
        $tipo= $_POST['tipo'];
        $marca= $_POST['marca'];
        $precio= $_POST['precio'];

        $consulta= "UPDATE productos set productos_nombre='$nombre', productos_tipo='$tipo' , productos_marca ='$marca', productos_precio='$precio' WHERE productos_id= $id";
        mysqli_query($connect,$consulta);
        $_SESSION['message']= 'Producto editado correctamente';
        $_SESSION['message_type']='warning';
        header("Location: productos.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar-prod.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nuevo nombre">
                    </div>
                    <div class="form-group">
                        <input name="tipo" type="text" class="form-control" value="<?php echo $tipo; ?>" placeholder="Nuevo tipo">
                    </div>
                    <div class="form-group">
                        <input name="marca" type="text" class="form-control" value="<?php echo $marca; ?>" placeholder="Nueva Marca">
                    </div>
                    <div class="form-group">
                        <input name="precio" type="text" class="form-control" value="<?php echo $precio; ?>" placeholder="Nuevo precio">
                    </div>
                    <button class="btn btn-success" name="cargar">Cargar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>