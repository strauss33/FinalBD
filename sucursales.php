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
                <form action="agregar-sucursal.php" method="POST">
                    <div class="form-group"><!--Para separar los input -->
                        <select name="idpais" class="form-control" id="" required>
                            <option value="" >Pais</option>
                        <?php 
                        $paises= "SELECT * FROM paises order by paises_id";
                        $resultado= $connect->query($paises);
                        while($paises= mysqli_fetch_row($resultado)){ ?>
                            <option value="<?php echo $paises[0] ?>"><?php echo $paises[1]?></option>
                        <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <select name="idprovincia" class="form-control" id="" required>
                            <option value="" >Provincia</option>
                        <?php 
                        $provincias= "SELECT * FROM provincias order by provincias_id";
                        $resultado= $connect->query($provincias);
                        while($provincias= mysqli_fetch_row($resultado)){ ?>
                            <option value="<?php echo $provincias[0] ?>"><?php echo $provincias[1]?></option> <!--Posicion 0 de la id (envio id) posicion 1 nombre(muestro el nombre) -->
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="idciudad" class="form-control" id="" required>
                            <option value="" >Ciudad</option>
                        <?php 
                        $ciudad= "SELECT * FROM ciudades order by ciudades_id";
                        $resultado= $connect->query($ciudad);
                        while($ciudad= mysqli_fetch_row($resultado)){ ?>
                            <option value="<?php echo $ciudad[0] ?>"><?php echo $ciudad[1]?></option> <!--Posicion 0 de la id (envio id) posicion 1 nombre(muestro el nombre) -->
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                            <input type="text" name="direccion" class="form-control"
                            placeholder="Direccion" autofocus >
                    </div>
                    <div class="form-group">
                            <input type="text" name="telefono" class="form-control"
                            placeholder="Telefono" autofocus >
                    </div>
                    <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar" >
                </form>
            </div>
        </div>

        <div class="col-md-8"><!-- columna de 8-->
            <table class="table table-bordered">
                <thead>
                    <th>Pais</th>
                    <th>Provincia</th>
                    <th>Ciudad</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php
                        $mostrarsucursal="SELECT sucursales_id, paises_nombre, provincias_nombre, ciudades_nombre, sucursales_direccion, sucursales_telefono
                        FROM paises pa, provincias pro, ciudades c, sucursales s
                        WHERE pa.paises_id= s.paises_id and pro.provincias_id= s.provincias_id and c.ciudades_id = s.ciudades_id ";
                        $resultado_suc= mysqli_query($connect,$mostrarsucursal);//Ejecuto la consulta
                        
                        while($row= mysqli_fetch_array($resultado_suc)){  //Recorrer los productos. $row para hacer una fila ?>
                            <tr>
                                <td><?php echo $row['paises_nombre'] ?></td>
                                <td><?php echo $row['provincias_nombre'] ?></td>
                                <td><?php echo $row['ciudades_nombre'] ?></td>
                                <td><?php echo $row['sucursales_direccion'] ?></td>
                                <td><?php echo $row['sucursales_telefono'] ?></td>
                                <td>
                                  <a href="editar-sucursal.php?id=<?php echo $row['sucursales_id']?>" class="btn btn-warning"><i class="fas fa-marker"></i></a>
                                  <a href="eliminar-sucursal.php?id=<?php echo $row['sucursales_id']?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include ("include/footer.php"); ?>