<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['buscar'])){
        $dato=$_POST['dato'];//Guardamos los datos
        $sql = "SELECT * FROM productos WHERE productos_nombre like '$dato' or productos_tipo like '$dato' 
        or productos_marca like '$dato' or productos_precio like '$dato'"; //Consulta para insertar
        $result=$connect->query($sql); //Ejecutar consulta
	    if (!$result) {
	    	die("Error");
        }
    }
    
?>

<?php include('include/header.php'); ?>
<div class="col-md-8"><!-- columna de 8-->
    <table class="table table-bordered">
        <thead>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Precio</th>
        </thead>
        <tbody>
           <?php
            while($row= mysqli_fetch_array($result)){  //Recorrer los productos. $row para hacer una fila ?>
                <tr>
                    <td><?= $row['productos_nombre'] ?></td>
                    <td><?= $row['productos_tipo'] ?></td>
                    <td><?= $row['productos_marca'] ?></td>
                    <td><?= $row['productos_precio'] ?></td>
                </tr>
            <?php } ?>
            <a href="productos.php" class="btn btn-success mb-2">Volver</a>
        </tbody>
    </table>
</div>
<?php include("include/footer.php"); ?> 