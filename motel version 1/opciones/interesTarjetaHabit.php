<?php
require "../conection.php";

$habitacionIPtabelt=$_GET['habitacionIPtabelt'];
$articuloId=271;
$idMovtemp=$_GET['idMovtemp'];
$total=$_GET['total']*0.10;
$id=$_GET['id'];

echo $total;


$insertTarjeta="INSERT INTO `carritos`(`habitacion`, `articulo`, `nombreDelArticulo`,
                            `cantidad`, `precio`, `estadoProducto`, `idMovtemp`) 
                            VALUES ('$habitacionIPtabelt','$articuloId','Interes taj.','1',
                            '$total','listo','$idMovtemp')";
$execute=$conexion->prepare($insertTarjeta);
if ($execute->execute()) {
   header("location: ../habitOcupada.php?id=$id");
}


?>