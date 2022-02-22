<?php
require "../../conection.php";

$deleteItem="DELETE FROM `itemverificacion` WHERE `idVerificacion`=:id";
$item=$conexion->prepare($deleteItem);
$item->bindParam(":id",$_GET['id']);
$item->execute();
print "<script>window.history.back()</script>"; 
?>