<?php include('../template/cabecera.php');?>

<?php

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtModelo = (isset($_POST['txtModelo']))?$_POST['txtModelo']:"";
$txtNum_serie = (isset($_POST['txtNum_serie']))?$_POST['txtNum_serie']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

include('../config/bd.php');

switch($accion){

    case "Agregar":
        //INSERT INTO `equipos` (`ID`, `Modelo`, `Num_serie`) VALUES (NULL, 'Scalift', '145');
        $sentenciaSQL=$conexion->prepare("INSERT INTO equipos (Modelo, Num_serie) VALUES ( :modelo, :num_serie);");
        $sentenciaSQL->bindParam(':modelo',$txtModelo);
        $sentenciaSQL->bindParam(':num_serie',$txtNum_serie);
        $sentenciaSQL->execute();
        header("Location:equipos.php");
        break;

    case "Modificar":
        $sentenciaSQL=$conexion->prepare("UPDATE equipos SET Modelo=:modelo , Num_serie=:num_serie WHERE ID=:id");
        $sentenciaSQL->bindParam(':modelo',$txtModelo);
        $sentenciaSQL->bindParam(':num_serie',$txtNum_serie);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        header("Location:equipos.php");

        break;

    case "Cancelar":
        header("Location:equipos.php");
        break;

    case "Seleccionar":
        
        $sentenciaSQL=$conexion->prepare("SELECT * FROM equipos WHERE ID=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $equipo=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtID=$equipo['ID'];
        $txtModelo=$equipo['Modelo'];
        $txtNum_serie=$equipo['Num_serie'];
        break;

    case "Borrar":

        $sentenciaSQL=$conexion->prepare("DELETE FROM equipos WHERE ID=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        header("Location:equipos.php");
        break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM equipos");
$sentenciaSQL->execute();
$lista_equipos=$sentenciaSQL->FetchAll(PDO::FETCH_ASSOC);

?>



<div class="col-md-5">
<h3>ADMINISTRADOR DE EQUIPOS </h3> 
<br/>

    <div class="card">
        <div class="card-header">
            Datos del equipo a registrar
        </div>

        <div class="card-body">
            <form method="POST">

                <div class = "form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" id="txtID" name="txtID" placeholder="ID">
                </div>
                <div class = "form-group">
                    <label for="txtModelo">Modelo de equipo:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtModelo;?>" id="txtModelo" name="txtModelo" placeholder="Ingrese el modelo del equipo">
                </div>

                <div class = "form-group">
                    <label for="txtNum_serie">Num_serie:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNum_serie;?>" id="txtNum_serie" name="txtNum_serie" placeholder="Ingrese el Numero de Serie">
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form> 
        </div>
        
    </div>
    
</div>

<div class="col-md-7">
<br/><br/><br/>
    <table class="table table-bordered">
        <thead>
            <tr class="table-info">
                <th>ID</th>
                <th>Modelo</th>
                <th>Num_serie</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($lista_equipos as $equipos) { ?>
            
            <tr class="table-secondary">
                <td scope="row"><?php echo $equipos['ID'];?></td>
                <td><?php echo $equipos['Modelo'];?></td>
                <td><?php echo $equipos['Num_serie'];?></td>
                <td>

                    <form method="post">

                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $equipos['ID'];?>" />
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />

                    </form>
                
                </td>
            </tr>
    
            <?php } ?>

        </tbody>
    </table>
</div>

<?php include('../template/pie.php');?>