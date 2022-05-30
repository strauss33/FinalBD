<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT ventas_id, ventas_fecha, productos_nombre, empleados_nombre, clientes_nombre 
        FROM ventas , productos , empleados , clientes WHERE ventas_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $fecha= $row['ventas_fecha'];
            $producto= $row['productos_nombre'];
            $empleado= $row['empleados_nombre'];
            $cliente= $row['clientes_nombre'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $idprod=$_POST['idprod'];//Guardamos los datos
        $idemp=$_POST['idemp'];
        $idclient=$_POST['idclient'];
        $fecha=$_POST['fecha'];
    
        $f= explode('/',$fecha); // Cuando encuentra "/" lo separa en un arreglo
        $fecha_sql= $f[2]."-".$f[1]."-".$f[0]; //Para ingresar la fecha debe estar como AAAA/MM/DD

        $consult= "UPDATE ventas SET productos_id='$idprod', empleados_id='$idemp', clientes_id='$idclient', ventas_fecha='$fecha_sql' WHERE ventas.ventas_id=$id ";
        $result= mysqli_query($connect,$consult);
        if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Venta editada correctamente';
        $_SESSION['message_type']='warning';
        header("Location: registroventas.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">     
            <div class="card card-body">
                <form action="editar-registro.php?id=<?php echo $_GET['id']; ?>" method="POST">
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
                            <select name="idemp" class="form-control" id="" required>
                                <option value="" >Vendedor</option>
                            <?php 
                            $emp= "SELECT * FROM empleados order by empleados_id";
                            $resultado= $connect->query($emp);
                            while($empleados= mysqli_fetch_row($resultado)){ ?>
                                <option value="<?php echo $empleados[0] ?>"><?php echo $empleados[1]?></option> <!--Posicion 0 de la id (envio id) posicion 1 nombre(muestro el nombre) -->
                            <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="idclient" class="form-control" id="" required>
                                <option value="" >Cliente</option>
                            <?php 
                            $client= "SELECT * FROM clientes order by clientes_id";
                            $resultado= $connect->query($client);
                            while($clientes= mysqli_fetch_row($resultado)){ ?>
                                <option value="<?php echo $clientes[0] ?>"><?php echo $clientes[1]?></option> <!--Posicion 0 de la id (envio id) posicion 1 nombre(muestro el nombre) -->
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