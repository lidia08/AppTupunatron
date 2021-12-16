<?php
session_start();

include('config/bd.php');
$txtUsuario = (isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtContrasenia = (isset($_POST['txtContrasenia']))?$_POST['txtContrasenia']:"";

if($_POST){

    //SELECT * FROM `usuarios` WHERE `nombre_usuario`='Lidia' && `contrasenia`='lidia2021';
    $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario=:user and contrasenia=:contra");
    $sentenciaSQL->bindParam(':user',$txtUsuario);
    $sentenciaSQL->bindParam(':contra',$txtContrasenia);
    $sentenciaSQL->execute();
    $users=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
    if($users !== false){
        
        $_SESSION['usuario']="ok";
        $_SESSION['nombre_usuario']=$txtUsuario;
        header('Location:inicio.php');
    }
    else{ $mensaje="El usuario o contraseña son incorrectos"; }
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
    <!-- nuestro CSS -->
    <link rel="stylesheet" href="css/estilo.css">
</head>

  <body>

         <div class="container">
            <div class="row">
                <div class="col-md-4">    
                </div>

                <div class="col-md-4">
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                    <div class="card border-light">
                        
                    
                        <div class="card-body formulario">

                            <?php if(isset($mensaje)){?>

                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> <?php echo $mensaje;?>
                                </div>
                            <?php }?>

                            <form method="POST">

                            <div class = "form-group">
                            <label >Usuario:</label>
                            <input type="text" required class="form-control" name="txtUsuario" placeholder="Escribe el usuario">
                            </div>

                            <div class="form-group">
                            <label >Contraseña:</label>
                            <input type="password" required class="form-control" name="txtContrasenia" placeholder="Escribe la contraseña">
                            </div>
                            
                            <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ingresar">Ingresar</button>
                            </div>

                            </form> 

                        </div>
                    </div>
                </div>
            </div>
        </div>

  </body>
</html>