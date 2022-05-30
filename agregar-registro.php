<?php
    include("conexion.php"); //El include es para llamar a un archivo, en este caso el de conexion
    if(isset($_POST['guardar'])){
        $idprod=$_POST['idprod'];//Guardamos los datos
        $idemp=$_POST['idemp'];
        $idclient=$_POST['idclient'];
        $fecha=$_POST['fecha'];

        $f= explode('/',$fecha); // Cuando encuentra "/" lo separa en un arreglo
        $fecha_sql= $f[2]."-".$f[1]."-".$f[0]; //Para ingresar la fecha debe estar como AAAA/MM/DD

        //Consulta para insertar
        $sql = "INSERT INTO ventas SET productos_id='$idprod', empleados_id='$idemp', clientes_id='$idclient', ventas_fecha='$fecha_sql'";
        
        //Ejecutar consulta
        $result=$connect->query($sql);
	    if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Venta registrada correctamente';
        $_SESSION['message_type']= 'success';

        header("Location: registroventas.php");
        
    }
?>