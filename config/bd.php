<?php
$host = "localhost";
$bd = "tt_basedatos";//"tupunat1_tt_basedatos";//"tt_basedatos";
$usuario = "root";//"tupunat1_root";// "root";
$contrasenia = "";// "2021tupunat1_bd";//"";

try {
    $conexion = new PDO("mysql:host=$host; dbname=$bd", $usuario, $contrasenia);
} catch (Exception $ex) {
    echo $ex ->getMessage();
}
?>