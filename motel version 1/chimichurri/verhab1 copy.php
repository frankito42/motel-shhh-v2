<?
include_once('conn.php');
require "conection.php";
//$id= $res['habitacion'];

if(isset($_GET['id'])){
	$id= @ $_GET['id'];
}else{
	$id=$movtemp['habitacion'];
}





 

$cero='00:00:00';
// sacar fecha y hora de inicio
$sel="select * from movtemp where habitacion='".$id."' and id2=''";
/* echo $sel."<BR>"; */
$execSel=mysqli_query($conn,$sel);
$rowSel=mysqli_fetch_array($execSel,MYSQLI_BOTH);
// cargar horario de fin de turno

/* DETIENE LA HORA PARA QUE NO PASE EL TIMEPO MIENTRAS UNO SE VA A COBRAR */
if(empty($rowSel['fechaDesActS1'])){
	$fechaDesActS1=date('Y-m-d');
	
}else{
	$fechaDesActS1=$rowSel['fechaDesActS1'];
}
if(empty($rowSel['horaDesActS1'])){
	$horaDesActS1=date('H:i:s');
	
}else{
	$horaDesActS1=$rowSel['horaDesActS1'];
}


$idmov=$rowSel['id'];
/*esto iria en otro php*/
//$upd="update movtemp set id2='".$id."', fechaDesActS1='".$fechaDesActS1."', horaDesActS1='".$horaDesActS1."' where id='".$id."' and id2=''";
//echo $upd."<br>";
/* if((date("l")=="Tuesday"||date("l")=="Wednesday"||date("l")=="Thursday") && $rowSel['habitacion']!="62"){
	if ($rowSel['descuento']<=0) {
		$descuento=16.67;
		$sql="UPDATE `movtemp` SET `descuento`=:descuento WHERE `id`=:idmov";
		$update=$conexion->prepare($sql);
		$update->bindParam(":descuento",$descuento);
		$update->bindParam(":idmov",$idmov);
		$update->execute();
	}
} */
/* TERMINA EL DESCUENTO EL VIERNES DESPUES DE LAS 10:00:00 */
/* if((date("l")=="Friday" && $rowSel['horaActS1']<"10:00:00" && $rowSel['fechaActS1']==date("Y-m-d")) && $rowSel['habitacion']!="62"){
	if ($rowSel['descuento']<=0) {
		$descuento=16.67;
		$sql="UPDATE `movtemp` SET `descuento`=:descuento WHERE `id`=:idmov";
		$update=$conexion->prepare($sql);
		$update->bindParam(":descuento",$descuento);
		$update->bindParam(":idmov",$idmov);
		$update->execute();
	}
} */
/* EMPIEZA EL DESCUENTO EL LUNES DESPUES DE LAS 10:00:00 */
/* if((date("l")=="Monday" && $rowSel['horaActS1']>"10:00:00" && $rowSel['fechaActS1']==date("Y-m-d")) && $rowSel['habitacion']!="62"){
	if ($rowSel['descuento']<=0) {
		$descuento=16.67;
		$sql="UPDATE `movtemp` SET `descuento`=:descuento WHERE `id`=:idmov";
		$update=$conexion->prepare($sql);
		$update->bindParam(":descuento",$descuento);
		$update->bindParam(":idmov",$idmov);
		$update->execute();
	}
} */


/* $sel="select * from movtemp where habitacion='".$id."' and id2=''"; */
/* echo $sel."<BR>"; */
/* $execSel=mysqli_query($conn,$sel);
$rowSel=mysqli_fetch_array($execSel,MYSQLI_BOTH); */



/* $descuentoTarjetaSql="SELECT v.veneficio FROM `movtemp` = m JOIN veneficios = v on v.id=m.idTarjetaDescuento WHERE habitacion='".$id."' and id2=''";
$executeTarjetaDescuento=mysqli_query($conn,$descuentoTarjetaSql);
$tarjetaDescuento=mysqli_fetch_array($executeTarjetaDescuento,MYSQLI_BOTH);


if($tarjetaDescuento!=null && $rowSel['entroTarjeta']==""){
	
	$entro="si";
	$sqlUpdateEntro="UPDATE `movtemp` SET `entroTarjeta`=:entroTarjeta WHERE `id`=:idmov";
	$entroTarjeta=$conexion->prepare($sqlUpdateEntro);
	$entroTarjeta->bindParam(":entroTarjeta",$entro);
	$entroTarjeta->bindParam(":idmov",$idmov);
	$entroTarjeta->execute();


	$descuentoMasTarjeta=$rowSel['descuento']+$tarjetaDescuento['veneficio'];
	$sql="UPDATE `movtemp` SET `descuento`=:descuento WHERE `id`=:idmov";
	$update=$conexion->prepare($sql);
	$update->bindParam(":descuento",$descuentoMasTarjeta);
	$update->bindParam(":idmov",$idmov);
	$update->execute();

} */

/*hasta aca*/
/*sacar los valores de ls costos*/
$selCosto="select c.nombre as nombre, c.turno as turno, c.monto1 as monto1, c.monto1Descuento as monto1Descuento, c.monto2Descuento as monto2Descuento, c.monto3Descuento as monto3Descuento, c.monto4Descuento as monto4Descuento, c.adicional as adicional, c.monto2 as monto2, c.estadia as estadia, c.monto3 as monto3, c.monto4 as monto4, m.habitacion as habitacion, c.horaSalidaEstadia as hSE
from costos c, movtemp as m, habitaciones as h
where  m.habitacion=h.habitacion and h.costo=c.costo and m.id='".$rowSel['id']."'";
/* echo $selCosto."<br>"; */
$exeCosto=mysqli_query($conn,$selCosto);
$rowCos=mysqli_fetch_array($exeCosto,MYSQLI_BOTH);
/* echo $rowCos['turno']."<br>"; */
$turno=(strtotime($rowCos['turno'])-strtotime($cero))/60;
$adic=(strtotime($rowCos['adicional'])-strtotime($cero))/60;
// COSTOS DE LAS HABITACIONES
$cosTur=$rowCos['monto1']; 
$cosAdi=$rowCos['monto2']; 
$cosEst=$rowCos['monto3'];
$cosDor=$rowCos['monto4'];



if((date("l")=="Tuesday"||date("l")=="Wednesday"||date("l")=="Thursday") && $rowSel['habitacion']!="62"){
	$cosTur=$rowCos['monto1Descuento']; 
	$cosAdi=$rowCos['monto2Descuento']; 
	$cosEst=$rowCos['monto3Descuento'];
	$cosDor=$rowCos['monto4Descuento'];

} 


if((date("l")=="Friday" && $rowSel['horaActS1']<"10:00:00" && $rowSel['fechaActS1']==date("Y-m-d")) && $rowSel['habitacion']!="62"){
	$cosTur=$rowCos['monto1Descuento']; 
	$cosAdi=$rowCos['monto2Descuento']; 
	$cosEst=$rowCos['monto3Descuento'];
	$cosDor=$rowCos['monto4Descuento'];

}


if((date("l")=="Monday" && $rowSel['horaActS1']>"10:00:00" && $rowSel['fechaActS1']==date("Y-m-d")) && $rowSel['habitacion']!="62"){

	$cosTur=$rowCos['monto1Descuento']; 
	$cosAdi=$rowCos['monto2Descuento']; 
	$cosEst=$rowCos['monto3Descuento'];
	$cosDor=$rowCos['monto4Descuento'];


} 


















//Variables Temporales para simplificar
$a=strtotime('23:59:59'); // para el final del dia
$b=strtotime($rowSel['horaActS1']); // hora activacion sensor 1
$c=strtotime('00:00:01'); // para el inicio del dia
$d=strtotime($horaDesActS1); // // hora desactivacion sensor 1
$ajuste=(strtotime('00:00:02')-strtotime($cero))/60; //esto sumar al final del tiempo calculado para recuperar los 2 segundos
$minTotalesTurno=0;
$minResDia=0;
$minIniDia=0;
$tiempoGracia=10;
// variables temporales de calculo de suma de dinero a pagar
$temp=0;
$tmpCHP=0;
$tmpCHPP=0;
$Dias=0;
$x=0;
$chp=0;
$cht=0;
//sacar los minutos totales 
// primero ver el cambio de dia
if ($rowSel['fechaActS1']<$fechaDesActS1){
	/* echo "entro fecha mayor a fecha entrada <br>"; */
	$Dias= cDias($rowSel['fechaActS1'],$fechaDesActS1); // calculo los dias que pasaron
	/* echo $Dias."<br>"; */
	//descontar horas
	$minResDia=(($a-$b)/60); //minutos restantes del dia
	$minIniDia=(($d-$c)/60); //minutos del dia siguiente
	if ($Dias>1){
		$minTotalesTurno=$minIniDia+$minResDia+(($Dias-1)*1440);
	} else {
		$minTotalesTurno=$minIniDia+$minResDia; // sumatoria de ambos
	}
	
	
} else { // el mismo dia
	$minTotalesTurno=($d-$b)/60;
}
$minTotalesTurno=$minTotalesTurno+$ajuste;
/*calular de mayor tiempo a menor tiempo*/
$temp=0;
/* if($estadia='T'){ // ELEGIR ENTRE V O T (VERDADERO O TRUE)
	$cht=$cosEst;
	
} 
if($dormida='T'){ // ELEGIR ENTRE V O T (VERDADERO O TRUE)
	$cht=$cosDor;

} */
	$tiempRestante=0;
	$cantAdic=0;
	if ($minTotalesTurno>$turno){
		/*agregado para el tema de los 5 adicionales*/ 
		$temp=$minTotalesTurno-$turno;
		$cantAdic=round(($temp/$adic),0);
		/*hasta aca*/
		 //echo $temp." trolo <br>"; 
		 //echo (round($temp,0))."el round <br>";
		/* if ($cantAdic>=5){ // 5 es el la cantidad que dispusieron chris y bruno ////////////////////DE AQUI
				$ac="SI";
				$agregarDormida="UPDATE `movtemp` SET `activarDormida`=:dor WHERE `habitacion`=:hab";
                $dormidaActivada=$conexion->prepare($agregarDormida);
                $dormidaActivada->bindParam(":dor",$ac);
                $dormidaActivada->bindParam(":hab",$_GET['id']);
                $dormidaActivada->execute();
		}else{ */	 //////////////////////////////////////////////////////////////////////HASTA AQUI
			if(($temp)>($adic)){
			//if(($temp)>($adic*(round($temp,0)))){
				$xx=round($temp,0)/$adic;
				//a??ado mas 1 para un adicional mas
				$xx++;
				$xx=$xx-0.5;
				//echo $xx."<br>"; 
				while($x<=round($xx)){
					/* echo $x."<br>"; */
					$chp=$x*$cosAdi;
					$x=$x+1;
					/* echo "parc ".$chp."<br>"; */
				}
				$cht=$chp+($cosTur);
			} else {
				//aca esta el temaputo
				$cht=$cosTur+$cosAdi;
			}
		/* } */ //////////////////////////////////////////////////////////////////////ACA COMENTASTE
	} else{
		$cht=$cosTur;
	}

	
if($rowSel['activarDormida']=='SI'){
	$cht=$cosDor;
	echo "<h2 style='color:#024a02;'>DORMIDA ACTIVADA<br></h2><hr>";


	if($rowSel['horaActS1']>"10:00:00"){
	

		

	}


}
if($rowSel['activarEstadia']=='SI'){
	$cht=$cosEst;
	echo "<h2 style='color:#024a02;'>ESTADIA ACTIVADA<br></h2><hr>";
}


if(isset($_GET['id'])){

	function algunNombre($m){
        $d = (int)($m/1440);
        $m -= $d*1440;
         
        $h = (int)($m/60);
        $m -= $h*60; 
         
        return array("dias" => $d, "horas" => $h, "minutos" => $m);
        }
         
        

	
		if($rowSel['entroTarjeta']!=""){
			echo "<h3  style='color:white;text-shadow: 0 0 20px red;background: #00ffad4f;border-radius: 9px;'>Descuento de cliente frecuente<h3>";
		}



echo "<h3 style='color:white;'>Fecha: ".$rowSel['fechaActS1']."</h3>";
echo "<h3 style='color:white;'>Hora inicio: ".$rowSel['horaActS1']."</h3>";
/* echo "minutos que faltan para las 00:00 ".$minResDia."<br>"; */
/* echo "fecha de desactivacion: ".$fechaDesActS1."<br>"; */
/* echo "hora de desactivacion: ".$horaDesActS1."<br>"; */
/* echo "minutos que faltan desde las 00:00 ".$minIniDia."<br>";
echo "minutos totales consumidos: ".$minTotalesTurno."<br>"; */
/* echo "Costos<br>";
echo "Turno: ".$turno."<br>";
echo "Adicional: ".$adic."<br>";
echo "Estad??a: ".$estadia."<br>"; */
$someVar = algunNombre($minTotalesTurno);

$minutosRoundMas0=round($someVar["minutos"]);
$minutosRoundMas0=($minutosRoundMas0<10) ? "0".$minutosRoundMas0 : $minutosRoundMas0;
$horasCon0=($someVar["horas"]<10) ? "0".$someVar["horas"] : $someVar["horas"];
$totalHorasMin=$horasCon0.":".$minutosRoundMas0;



echo "<h3 style='color:white;'>horas: ".$totalHorasMin."</h3>";
$habitacionjj=$cht*((100-$rowSel['descuento'])/100);
echo "<h3 style='color:white;'>Habitacion: $".round($habitacionjj)."</h3>";
}else{
	$habitacionjj=round($cht*((100-$rowSel['descuento'])/100));
}


?>