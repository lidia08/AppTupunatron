<?php
session_start();

if(!isset($_SESSION['usuario'])){
  header("Location:../index.php");
}
else{
  if($_SESSION['usuario']=="ok"){
    $nombre_usuario=$_SESSION["nombre_usuario"];
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
  </head>

  <body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb"?>  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">

            <li class="nav-item">
              <a class="nav-link active" href="<?php echo $url;?>/inicio.php">Pagina Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url;?>/seccion/equipos.php">Equipos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url;?>/seccion/pesajes.php">Pesajes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url;?>/seccion/cerrar.php">Cerrar Sesion</a>
            </li>
          
          </ul>
        </div>

      </div>
    </nav>

      <div class="container">
      <br/><br/>
          <div class="row">
