<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT compras_id, compras_fecha, productos_nombre, proveedores_nombre 
        FROM compras , productos , proveedores WHERE compras_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $fecha= $row['compras_fecha'];
            $producto= $row['productos_nombre'];
            $proveedor= $row['proveedores_nombre'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $idprod=$_POST['idprod'];//Guardamos los datos
        $idprov=$_POST['idprov'];
        $fecha=$_POST['fecha'];
    
        $f= explode('/',$fecha); // Cuando encuentra "/" lo separa en un arreglo
        $fecha_sql= $f[2]."-".$f[1]."-".$f[0]; //Para ingresar la fecha debe estar como AAAA/MM/DD

        $consult= "UPDATE compras SET productos_id='$idprod', proveedores_id='$idprov', compras_fecha='$fecha_sql' WHERE compras_id=$id ";
        $result= mysqli_query($connect,$consult);
        if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Compra de mercaderia editada correctamente';
        $_SESSION['message_type']='warning';
        header("Location: mercaderia.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">     
            <div class="card card-body">
                <form action="editar-mercaderia.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group"><!--Para separar los input -->
                            <select name="idprod" class="form-control" id="" required>
                                <option value="" >Producto</option>
                            <?php 
                            $prod= "SELECT * FROM productos order by productos_id";
                            $resultado= $connect->query($prod);
                            while($productos= mysqli_fetch_row($resultado)){ ?>
                                <option value="<?php echo $productos[0] ?>"><?php echo $productos[1]?></option>
                            <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <select name="idprov" class="form-control" id="" required>
                                <option value="" >Proveedor</option>
                            <?php 
                            $emp= "SELECT * FROM proveedores order by proveedores_id";
                            $resultado= $connect->query($emp);
                            while($empleados= mysqli_fetch_row($resultado)){ ?>
                                <option value="<?php echo $empleados[0] ?>"><?php echo $empleados[1]?></option> <!--Posicion 0 de la id (envio id) posicion 1 nombre(muestro el nombre) -->
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                                <input type="text" name="fecha" class="form-control"
                                placeholder="fecha DD/MM/AA" autofocus >
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="cargar" value="Cargar" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>