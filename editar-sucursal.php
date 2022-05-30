<?php
    include("conexion.php");
    
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $consulta= "SELECT sucursales_id, paises_nombre, provincias_nombre, ciudades_nombre, sucursales_direccion, sucursales_telefono
        FROM sucursales , paises, provincias , ciudades WHERE sucursales_id = $id"; //Selecciona todos los datos del producto cuyo id es el enviado
        $result= mysqli_query($connect, $consulta); 
        
        if(mysqli_num_rows($result)==1){ //Si al menos hay un producto que ha coincidido con este id lo muestro
            $row= mysqli_fetch_array($result);
            $pais= $row['paises_nombre'];
            $provincia= $row['provincias_nombre'];
            $ciudad= $row['ciudades_nombre'];
            $direccion= $row['sucursales_direccion'];
            $telefono= $row['sucursales_telefono'];
        }
        
    }
    
    if(isset($_POST['cargar'])){
        $id = $_GET['id'];
        $idpais=$_POST['idpais'];//Guardamos los datos
        $idprovincia=$_POST['idprovincia'];
        $idciudad=$_POST['idciudad'];
        $direccion=$_POST['direccion'];
        $telefono=$_POST['telefono'];

        $consult= "UPDATE sucursales SET paises_id='$idpais', provincias_id='$idprovincia', ciudades_id='$idciudad' , 
        sucursales_direccion='$direccion', sucursales_telefono='$telefono' WHERE sucursales_id=$id ";
        $result= mysqli_query($connect,$consult);
        if (!$result) {
	    	die("Error");
        }
        $_SESSION['message']= 'Sucursal editada correctamente';
        $_SESSION['message_type']='warning';
        header("Location: sucursales.php");
    }

?>
<?php include('include/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">     
            <div class="card card-body">
                <form action="editar-sucursal.php?id=<?php echo $_GET['id']; ?>" method="POST">
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
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion" autofocus >
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefono" class="form-control" placeholder="Telefono" autofocus >
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="cargar" value="Cargar" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>