<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
session_start();
require "conection.php";
 

if (isset($_GET['id'])) {


        if(isset($_GET['prueba'])){


                $updateModoPruebaSql="UPDATE `habitaciones` SET `modoPrueba`=1 WHERE `habitacion`=:id";
                $executeModoPrueba=$conexion->prepare($updateModoPruebaSql);
                $executeModoPrueba->bindParam(":id",$_GET['id']);
                $executeModoPrueba->execute();
                


        }
    

        $movtemSelect="SELECT `id`, `id2`, `codigo`, `habitacion`, `fechaActS1`, `horaActS1`, `horaActS2`, `horaDesActS2`, `horaActS3`, `horaDesActS3`, `fechaDesActS1`, `horaDesActS1`, `S1`, `S2`, `S3` FROM `movtemp` WHERE habitacion=:id and id2=''";
        $movtem=$conexion->prepare($movtemSelect);
        $movtem->bindParam(":id",$_GET['id']);
        $movtem->execute();
        $movtem=$movtem->fetch(PDO::FETCH_ASSOC);


        $id=$_GET['id'];

        print_r($movtem);
         if($movtem==null){
        
                $sql="insert into movtemp set habitacion='".$id."', fechaActS1='".date('Y-m-d')."',S1='SI', horaActS1='".date('H:i:s')."',S2='SI',S3='SI'";
                $upp=$conexion->prepare($sql);
                $upp->execute();
                
                $sqlUpdate="UPDATE `habitaciones` SET   estado=?
                                                WHERE habitacion=?";
                $update=$conexion->prepare($sqlUpdate); 
                $update->execute(array("ocupada",$id));
                
                $_SESSION['message2']="Habitacion ocupada";
                
                header("location:detalleHabitacion.php?id=$id");
        }else{
                
                $_SESSION['message2']="habitacion ocupada.      ";
                header("location:detalleHabitacion.php?id=$id");
        } 

        
}else{
/* $ip= $_SERVER["REMOTE_ADDR"];

// buscar id de habitciones por la ip
$sql2="select habitacion from habitaciones where dirip=:ip";
//echo $sql."<br>";

$res=$conexion->prepare($sql2);
$res->bindParam("ip",$ip);
$res->execute();
$res=$res->fetch(PDO::FETCH_ASSOC);

print_r($res);

$sql='';
if (isset($_GET['S1A'])){
	$sql="insert into movtemp set habitacion=:habitacion, fechaActS1='".date('Y-m-d')."',S1='SI', horaActS1='".date('H:i:s')."'";
        echo "sensor 1";
}
if (isset($_GET['S2A'])){
	$sql="update movtemp set S2='SI', horaActS2='".date('H:i:s')."' where habitacion=:habitacion and S2='NO' and S3='NO'";
        echo "sensor 2";
}
if (isset($_GET['S3A'])){
	$sql="update movtemp set S3='SI', horaActS3='".date('H:i:s')."' where habitacion=:habitacion and S1='SI' and S2='SI' and S3='NO'";
        echo "sensor 3";
}
 $arduino=$conexion->prepare($sql);
 $arduino->bindParam(":habitacion",$res['habitacion']); 
 $arduino->execute();
echo "listo"; */
}

?>