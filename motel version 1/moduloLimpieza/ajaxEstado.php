<?php
require "../conection.php";
$estado="disponible";
$sqlUpdate="UPDATE `habitaciones` SET `estado`=:estado WHERE `dirip`=:dirip";
$update=$conexion->prepare($sqlUpdate);
$update->bindParam(":estado",$estado);
$update->bindParam(":dirip",$_GET['ipArduino']);

if ($update->execute()) {
    echo "bien";
}



?>