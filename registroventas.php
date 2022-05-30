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
                <form action="agregar-registro.php" method="POST">
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
                            placeholder="fecha DD/MM/AAAA" autofocus >
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar" >
                </form>
            </div>
        </div>

        <div class="col-md-8"><!-- columna de 8-->
            <form class="form-inline" action="buscar-fecha.php" method="POST">
                <div class="form-group mx-sm mb-3">
                    <a>Desde<a>
                    <input type="text" name="fecha1" class="form-control" placeholder="DD/MM/AAAA" autofocus>
                    <a>Hasta<a>
                    <input type="text" name="fecha2" class="form-control" placeholder="DD/MM/AAAA" autofocus>
                    <input type="submit" class="btn btn-success mb-2" name="buscar" value="Buscar">
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                        $mostrarventa="SELECT ventas_id, ventas_fecha, productos_nombre, empleados_nombre, clientes_nombre FROM ventas v, productos p, empleados e, clientes c
                        WHERE p.productos_id= v.productos_id and e.empleados_id= v.empleados_id and c.clientes_id = v.clientes_id ";
                        $resultado_vent= mysqli_query($connect,$mostrarventa);//Ejecuto la consulta
                        
                        while($row= mysqli_fetch_array($resultado_vent)){  //Recorrer los productos. $row para hacer una fila ?>
                            <tr>
                                <td><?php echo $row['ventas_fecha'] ?></td>
                                <td><?php echo $row['productos_nombre'] ?></td>
                                <td><?php echo $row['empleados_nombre'] ?></td>
                                <td><?php echo $row['clientes_nombre'] ?></td>
                                <td>
                                  <a href="editar-registro.php?id=<?php echo $row['ventas_id']?>" class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                  <a href="eliminar-registro.php?id=<?php echo $row['ventas_id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } 
                        $cantidad= "SELECT COUNT(v.ventas_fecha)AS numero FROM ventas v";
                        $ejecutar_cant= mysqli_query($connect,$cantidad);
                        $valor= mysqli_fetch_assoc($ejecutar_cant);
                        $final=$valor['numero'];
                        ?>
                        <div class="alert alert-info" role="alert"><a><?php echo "Cantidad de ventas :"." ".$final; ?></a></div>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include ("include/footer.php"); ?>