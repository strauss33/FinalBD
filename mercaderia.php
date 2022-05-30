<?php include("conexion.php"); ?>
<?php include ("include/header.php"); ?>

<div class="container p-4"> 

    <div class="row"> <!-- fila-->
        <div class="col-md-4"> <!--columna de 4-->
            <?php if(isset($_SESSION['message'])){?> <!--Preguntar si existe un mensaje -->
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_unset();} ?>

            <div class="card card-body">
                <form action="agregar-mercaderia.php" method="POST">
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
                            placeholder="fecha DD/MM/AAAA" autofocus >
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar" >
                </form>
            </div>
        </div>

        <div class="col-md-8"><!-- columna de 8-->
            <table class="table table-bordered">
                <thead>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                        $mostrarventa="SELECT compras_id, compras_fecha, productos_nombre, proveedores_nombre FROM compras c, productos p, proveedores r
                        WHERE p.productos_id= c.productos_id and r.proveedores_id= c.proveedores_id ";
                        $resultado_vent= mysqli_query($connect,$mostrarventa);//Ejecuto la consulta
                        
                        while($row= mysqli_fetch_array($resultado_vent)){  //Recorrer los productos. $row para hacer una fila ?>
                            <tr>
                                <td><?php echo $row['compras_fecha'] ?></td>
                                <td><?php echo $row['productos_nombre'] ?></td>
                                <td><?php echo $row['proveedores_nombre'] ?></td>
                                <td>
                                  <a href="editar-mercaderia.php?id=<?php echo $row['compras_id']?>" class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                  <a href="eliminar-mercaderia.php?id=<?php echo $row['compras_id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include ("include/footer.php"); ?>