<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['buscar'])){
        $fechas1=$_POST['fecha1'];//Guardamos los datos
        $fechas2=$_POST['fecha2'];

        $f1= explode('/',$fechas1); // Cuando encuentra "/" lo separa en un arreglo
        $fecha1= $f1[2]."-".$f1[1]."-".$f1[0]; //Para ingresar la fecha debe estar como AAAA/MM/DD

        $f2= explode('/',$fechas2); // Cuando encuentra "/" lo separa en un arreglo
        $fecha2= $f2[2]."-".$f2[1]."-".$f2[0]; //Para ingresar la fecha debe estar como AAAA/MM/DD

        $sql = "SELECT ventas_id, ventas_fecha, productos_nombre, empleados_nombre, clientes_nombre FROM ventas v, productos p, empleados e, clientes c
        WHERE p.productos_id= v.productos_id AND e.empleados_id= v.empleados_id AND c.clientes_id = v.clientes_id AND ventas_fecha 
        BETWEEN '$fecha1' AND '$fecha2' "; //Consulta para insertar
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
            <th>Fecha</th>
            <th>Producto</th>
            <th>Vendedor</th>
            <th>Cliente</th>
        </thead>
        <tbody>
           <?php
            while($row= mysqli_fetch_array($result)){  //Recorrer los productos. $row para hacer una fila ?>
                <tr>
                    <td><?= $row['ventas_fecha'] ?></td>
                    <td><?= $row['productos_nombre'] ?></td>
                    <td><?= $row['empleados_nombre'] ?></td>
                    <td><?= $row['clientes_nombre'] ?></td>
                </tr>
            <?php } ?>
            <a href="registroventas.php" class="btn btn-success mb-2">Volver</a>
        </tbody>
    </table>
</div>
<?php include("include/footer.php"); ?> 