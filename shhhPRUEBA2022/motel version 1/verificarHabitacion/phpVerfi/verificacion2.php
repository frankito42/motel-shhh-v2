<?php
require "../../conection.php";




    if(isset($_GET['ipArduino'])){

        $ipArduino=$_GET['ipArduino'];
        $estado="disponible";
        $sqlEstado="UPDATE `habitaciones` SET `estado`=:estado WHERE dirip=:ip";
        $estadoHabitacion=$conexion->prepare($sqlEstado);
        $estadoHabitacion->bindParam(":ip",$ipArduino);
        $estadoHabitacion->bindParam(":estado",$estado);
        
        if ($estadoHabitacion->execute()) {
          echo "bien";
        }
    }






?>