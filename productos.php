<?php include("conexion.php"); ?>
<?php include("include/header.php"); ?>

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
                <form action="agregar-prod.php" method="POST">
                    <div class="form-group"><!--Para separar los input -->
                        <input type="text" name="nombre" class="form-control"
                        placeholder="nombre" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tipo" class="form-control"
                        placeholder="tipo" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="marca"  class="form-control"
                        placeholder="marca" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="precio" class="form-control"
                        placeholder="precio" autofocus >
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar" >
                </form>
            </div>
        </div>

        <div class="col-md-8"><!-- columna de 8-->
            <form class="form-inline" action="buscar-prod.php" method="POST">
                <div class="form-group mx-sm-3 mb-2">
                    <input type="text" name="dato" class="form-control" placeholder="Ingrese dato" autofocus>
                </div>
                <input type="submit" class="btn btn-success mb-2" name="buscar" value="Buscar">
            </form>
            <table class="table table-bordered">
                <thead>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                        $mostrarprod="SELECT * FROM productos";
                        $resultado_prod= mysqli_query($connect,$mostrarprod);//Ejecuto la consulta
                        while($row= mysqli_fetch_array($resultado_prod)){  //Recorrer los productos. $row para hacer una fila ?>
                            <tr>
                                <td><?php echo $row['productos_nombre'] ?></td>
                                <td><?php echo $row['productos_tipo'] ?></td>
                                <td><?php echo $row['productos_marca'] ?></td>
                                <td><?php echo $row['productos_precio'] ?></td>
                                <td>
                                  <a href="editar-prod.php?id=<?php echo $row['productos_id']?>" class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                  <a href="eliminar-prod.php?id=<?php echo $row['productos_id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include ("include/footer.php"); ?>