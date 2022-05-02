<?
date_default_timezone_set('America/Argentina/Buenos_Aires');
/* include_once('conn.php'); */
require "conexion.php";
//variables del arduino



if(isset($_GET['EST'])){
/* $ipAr=$_SERVER["REMOTE_ADDR"];

$selec="SELECT `habitacion`, `dirip`, `letra`, `nombre`, `descripcion`, `costo`, `ip_tablet`, `estado` FROM `habitaciones` WHERE dirip=:ipAr";
$habitacion=$conn->prepare($selec);
$habitacion->bindParam(":ipAr",$ipAr);
$habitacion->execute();
$habitacion=$habitacion->fetch(PDO::FETCH_ASSOC); */


/* $sqlMovtemp="SELECT h.`habitacion`, `dirip`, `letra`, `nombre`, `descripcion`, `costo`, `ip_tablet`, `estado`,m.fechaActS1,m.horaActS1,m.id FROM `habitaciones`= h  JOIN movtemp = m on h.habitacion =m.habitacion and m.id2!=m.id WHERE h.ip_tablet=:ip_tablet";

$movtemp=$conexion->prepare($sqlMovtemp);
$movtemp->bindParam(":ip_tablet",$habitacion['ip_tablet']);
$movtemp->execute();
$movtemp=$movtemp->fetch(PDO::FETCH_ASSOC); */
/* if($habitacion['estado']=='ocupada'){
	header('location: http://'.$ipAr.'/?S2A');
}
if($habitacion['estado']=='cobrando'){
	header('location: http://'.$ipAr.'/?AC1');
}
if($habitacion['estado']=='enviar cuenta'){
	header('location: http://'.$ipAr.'/?AC1'); 
}
if($habitacion['estado']=='verificacion1'){
	header('location: http://'.$ipAr.'/?PC1');
}
if($habitacion['estado']=='limpieza'){
	header('location: http://'.$ipAr.'/?LP0');
}
if($habitacion['estado']=='verificacion2'){
	header('location: http://'.$ipAr.'/?LP1');
}
if($habitacion['estado']=='disponible'){
	header('location: http://'.$ipAr.'/?VC1');
} */








}else{


	$ip=$_SERVER["REMOTE_ADDR"];
	/* $V= $_GET['V']; */
	// buscar id de habitciones por la ip
	$sql="select * from habitaciones where dirip=:ip";
	$res=$conn->prepare($sql);
	$res->bindParam(":ip",$ip);
	$res->execute();
	$res=$res->fetch(PDO::FETCH_ASSOC);
	$vandera=false;
	$ocupada="ocupada";
	//echo $sql."<br>";

	$sqlMovtemp="SELECT h.`habitacion`, `dirip`, `letra`, `nombre`, `descripcion`, `costo`, `ip_tablet`, `estado`,m.fechaActS1,m.horaActS1,m.id,m.S2 FROM `habitaciones`= h  JOIN movtemp = m on h.habitacion =m.habitacion and m.id2!=m.id WHERE h.ip_tablet=:ip_tablet";
		$movtemp=$conn->prepare($sqlMovtemp);
		$movtemp->bindParam(":ip_tablet",$res['ip_tablet']);
		$movtemp->execute();
		$movtemp=$movtemp->fetch(PDO::FETCH_ASSOC);
	
	/* $res=mysqli_fetch_array(mysqli_query($conn, $sql),MYSQLI_BOTH); */
	$sql='';


	
	/* if (isset($_GET['S1A'])){
		if($movtemp==null){
		$esta="coche";
		$sql="insert into movtemp set habitacion='".$res['habitacion']."', fechaActS1='".date('Y-m-d')."',S1='SI', horaActS1='".date('H:i:s')."'";
		$exito=$conn->prepare($sql);
		$exito->execute();
		$sqlEstado="UPDATE `habitaciones` SET `estado`=:estado WHERE dirip=:ip";
		$exito2=$conn->prepare($sqlEstado);
		$exito2->bindParam(":estado",$esta);
		$exito2->bindParam(":ip",$ip);
		$exito2->execute();
		}
	}
 */


	if (isset($_GET['S2A'])){

		if($movtemp==null&&$res["estado"]=='disponible'){
			$fecha=date('Y-m-d');
			$hora=date('H:i:s');
			$si="SI";
			/* $insertarUnaSesion="insert into movtemp set habitacion='".$res['habitacion']."', fechaActS1='".date('Y-m-d')."',S1='SI', horaActS1='".date('H:i:s')."'"; */
			$insertarUnaSesion="INSERT INTO `movtemp`( `habitacion`,`fechaActS1`, `horaActS1`, `horaActS2`,`S1`,`S2`) VALUES 
			(:idHabitacion,:fechaActS1,:horaActS1,:horaActS2,:S1,:S2)";
			$insertExito=$conn->prepare($insertarUnaSesion);
			$insertExito->bindParam(":idHabitacion",$res['habitacion']);
			$insertExito->bindParam(":fechaActS1",$fecha);
			$insertExito->bindParam(":horaActS1",$hora);
			$insertExito->bindParam(":horaActS2",$hora);
			$insertExito->bindParam(":S1",$si);
			$insertExito->bindParam(":S2",$si);
			$insertExito->execute();
			/* echo "entro"; */
			 /* $sqlQWERTY="update movtemp set S2='SI', horaActS2='".date('H:i:s')."' where habitacion='".$res['habitacion']."' and S2='NO' and S3='NO'";
			$exito3=$conn->prepare($sqlQWERTY);
			$exito3->execute(); */
			$vandera=true;            
			/* echo "tambien"; */
		}else if($res["estado"]!='mantenimiento'){
			$asdasd="update movtemp set S2='SI', horaActS2='".date('H:i:s')."' where habitacion='".$res['habitacion']."' and S2='NO' and S3='NO'";
			$asdasdasd=$conn->prepare($asdasd);
			$asdasdasd->execute();
			$vandera=true;
			/* echo "tambien"; */
		}
			
		/* if ($movtemp['S2']=="NO") {
			$sql="update movtemp set S2='SI', horaActS2='".date('H:i:s')."' where habitacion='".$res['habitacion']."' and S2='NO' and S3='NO'";
			$exito=$conn->prepare($sql);
			$exito->execute();
			$vandera=true;
			echo "tambien";
		} */
	}



	if (isset($_GET['S3A'])){
		$sql="update movtemp set S3='SI', horaActS3='".date('H:i:s')."' where habitacion='".$res['habitacion']."' and S1='SI' and S2='SI' and S3='NO'";
		$exito=$conn->prepare($sql);
		$exito->execute();
	}



	if($vandera==true){
		$sqlEstado="UPDATE `habitaciones` SET `estado`=:estado WHERE dirip=:ip";
		$exito2=$conn->prepare($sqlEstado);
		$exito2->bindParam(":estado",$ocupada);
		$exito2->bindParam(":ip",$ip);
		$exito2->execute();
	}

}
//header('location: http://'.$ip.'/?'.$V);
?>
<!-- <script>
	let vandera=<?php echo $vandera;?>
	
if (vandera==true) {
	setTimeout(function(){
		 
		fetch('motel version 1/pruebaDeTiempo.php?ip=<?php echo $ip;?>')
		  .then(response => response.json())
		  .then(data => console.log(data));

	}, 25000);
}
	
</script> -->

