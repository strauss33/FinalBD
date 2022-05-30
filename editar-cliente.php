<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT * FROM clientes WHERE clientes_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $nombre= $row['clientes_nombre'];
            $dni= $row['clientes_dni'];
            $telefono= $row['clientes_telefono'];
            $direccion= $row['clientes_mail'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $nombre= $_POST['nombre'];
        $dni= $_POST['dni'];
        $telefono= $_POST['telefono'];
        $mail= $_POST['mail'];

        $consulta= "UPDATE clientes set clientes_nombre='$nombre', clientes_dni='$dni' , clientes_telefono ='$telefono', clientes_mail='$mail' WHERE clientes_id= $id";
        mysqli_query($connect,$consulta);
        $_SESSION['message']= 'Cliente editado correctamente';
        $_SESSION['message_type']='warning';
        header("Location: clientes.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar-cliente.php?id=<?php echo $_GET['id']; ?>" method="POST">
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
                        <input name="mail" type="text" class="form-control" value="<?php echo $direccion; ?>" placeholder="Nuevo mail">
                    </div>
                    <button class="btn btn-success" name="cargar">Cargar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>