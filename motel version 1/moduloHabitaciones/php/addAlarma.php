<?
/* require "../../conection.php";

$sqlAlarma="SELECT CONCAT( TIMESTAMPDIFF(DAY, :inicio1, NOW()), ' dias, '
    , MOD(TIMESTAMPDIFF(HOUR, :inicio2,NOW()), 24), ' horas, '
    , MOD(TIMESTAMPDIFF(MINUTE, :inicio3,NOW()), 60), ' minutos' )";


$resAlarma=$conn-prepare($sqlAlarma);

$resAlarma->bindParam(":inicio1",)
 */


echo json_encode("hola");

?>