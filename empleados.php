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
                <form action="agregar-emp.php" method="POST">
                    <div class="form-group"><!--Para separar los input -->
                        <input type="text" name="nombre" class="form-control"
                        placeholder="nombre" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="dni" class="form-control"
                        placeholder="dni" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono"  class="form-control"
                        placeholder="telefono" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="direccion" class="form-control"
                        placeholder="direccion" autofocus >
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar" >
                </form>
            </div>
        </div>

        <div class="col-md-8"><!-- columna de 8-->
            <table class="table table-bordered">
                <thead>
                    <th>Nombre</th>
                    <th>Dni</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                        $mostraremp="SELECT * FROM empleados";
                        $resultado_emp= mysqli_query($connect,$mostraremp);//Ejecuto la consulta
                        
                        while($row= mysqli_fetch_array($resultado_emp)){  //Recorrer los productos. $row para hacer una fila ?>
                            <tr>
                                <td><?php echo $row['empleados_nombre'] ?></td>
                                <td><?php echo $row['empleados_dni'] ?></td>
                                <td><?php echo $row['empleados_telefono'] ?></td>
                                <td><?php echo $row['empleados_direccion'] ?></td>
                                <td>
                                  <a href="editar-emp.php?id=<?php echo $row['empleados_id']?>" class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                  <a href="eliminar-emp.php?id=<?php echo $row['empleados_id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include ("include/footer.php"); ?>