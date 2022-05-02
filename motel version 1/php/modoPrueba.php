<?php
require "conection.php";

$id=$_GET['id'];


$updateModoPruebaSql="UPDATE `habitaciones` SET `modoPrueba`=0 WHERE `habitacion`=:id";
$executeModoPrueba=$conexion->prepare($updateModoPruebaSql);
$executeModoPrueba->bindParam(":id",$_GET['id']);
if ($executeModoPrueba->execute()) {
    echo json_encode("perfecto")
}


?>