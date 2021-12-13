<?php
session_start();

if($_POST){
    if(($_POST['usuario']=="tupunatron")&&($_POST['contrasenia']=="tupunatron")){
        $_SESSION['usuario']="ok";
        $_SESSION['nombre_usuario']="tupunatron";
        header('Location:inicio.php');
    }
    else{
        $mensaje="El usuario o contraseña son incorrectos";
    }
}
?>