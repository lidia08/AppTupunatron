<?php
session_start();

include('config/bd.php');
$txtUsuario = (isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtContrasenia = (isset($_POST['txtContrasenia']))?$_POST['txtContrasenia']:"";

//SELECT * FROM `usuarios` WHERE `nombre_usuario`='Lidia' && `contrasenia`='lidia2021';
$sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=:Usuario");
$sentenciaSQL->bindParam(':Usuario',$txtUsuario);
$sentenciaSQL->execute();
$users=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

$txtUsuario=$users['nombre_usuario'];
$txtContrasenia=$users['contrasenia'];

if($_POST){
    if(($_POST['txtUsuario']==$txtUsuario)&&($_POST['txtContrasenia']==$txtContrasenia)){
        $_SESSION['usuario']="ok";
        $_SESSION['nombre_usuario']=$txtUsuario;
        header('Location:inicio.php');
    }
    else{
        $mensaje="El usuario o contraseña son incorrectos";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Aplicacion Web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

  <body>

         <div class="container">
            <div class="row">
                <div class="col-md-4">    
                </div>

                <div class="col-md-4">
                    <br/><br/><br/><br/>
                    <div class="card">
                        <div class="card-header">
                            Login
                        </div>

                        <div class="card-body">

                        <?php if(isset($mensaje)){?>

                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?php echo $mensaje;?>
                            </div>
                        <?php }?>

                            <form method="POST">

                            <div class = "form-group">
                            <label >Usuario:</label>
                            <input type="text" class="form-control" name="txtUsuario" id="txtUsuario" placeholder="Escribe el usuario">
                            </div>

                            <div class="form-group">
                            <label >Contraseña:</label>
                            <input type="password" class="form-control" name="txtContrasenia" id="txtContrasenia" placeholder="Escribe la contraseña">
                            </div>

                            <button type="submit" class="btn btn-primary">Ingresar</button>

                            </form> 

                        </div>
                    </div>
                </div>
            </div>
        </div>

  </body>
</html>