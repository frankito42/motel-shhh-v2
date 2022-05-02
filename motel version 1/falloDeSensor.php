<?php
require "conection.php";
$mov=$_GET['idMovtemp'];
$sql="DELETE FROM `movtemp` WHERE `id`=:id";
$up=$conexion->prepare($sql);
$up->bindParam(":id",$mov);
$up->execute();


$estado="disponible";

$vacio="";
$sensorGarajeSql="UPDATE `habitaciones` SET estado=:estado ,`sonido1`=:sensorGaraje,`sonido2`=:sensorPuerta,cobrando=:cobrando,cocina=:cocina,sex=:sex,modoPrueba=:modo  WHERE `habitacion`=:habitacion";
$executeSensor1=$conexion->prepare($sensorGarajeSql);
$executeSensor1->bindParam(":sensorGaraje",$vacio);
$executeSensor1->bindParam(":sensorPuerta",$vacio);
$executeSensor1->bindParam(":cobrando",$vacio);
$executeSensor1->bindParam(":cocina",$vacio);
$executeSensor1->bindParam(":estado",$estado);
$executeSensor1->bindParam(":sex",$vacio);
$executeSensor1->bindParam(":habitacion",$_GET['habitacion']);
$executeSensor1->bindParam(":modo",$vacio);
$executeSensor1->execute();



/* header("location:index.php"); */
?>
<script src="mdbootstrap/js/jquery.min.js"></script>
<script src="mdbootstrap/js/bootstrap.min.js"></script>
<script src="mdbootstrap/js/mdb.min.js"></script>
<script>
        

                setTimeout(() => {
                 $.get("http://"+"<?php echo $_GET['dirip']; ?>"+"/?PC1")
                        setTimeout(() => {
                                $.get("http://"+"<?php echo $_GET['dirip']; ?>"+"/?LP0")    
                                setTimeout(() => {
                                        $.get("http://"+"<?php echo $_GET['dirip']; ?>"+"/?LP1")
                                        setTimeout(() => {
                                                $.get("http://"+"<?php echo $_GET['dirip']; ?>"+"/?VC1")
                                                setTimeout(() => {
                                                        location.href="index.php"  
                                                }, 2400);
                                        }, 1800);
                                }, 1500);    
                        }, 1000);



                }, 100);

                
      


</script>