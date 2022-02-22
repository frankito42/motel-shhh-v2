<?php
require "../../conection.php";

$insertItem="INSERT INTO `itemverificacion`(`item`) VALUES (:item)";
$item=$conexion->prepare($insertItem);
$item->bindParam(":item",$_POST['item']);
$item->execute();
print "<script>window.history.back()</script>"; 
?>