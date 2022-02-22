<?php
require "../conection.php";
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=nombre_archivo.xls');
$sql="SELECT m.fechaActS1,u.user,m.horaActS1, h.`nombre` as habitacion, a.`nombre`, c.`cantidad`, c.`precio`, c.`estadoProducto`, c.`idMovtemp` FROM `carritos` = c
JOIN articulos = a on a.articulo=c.articulo
JOIN movtemp = m on m.id=c.`idMovtemp`
JOIN habitaciones = h on h.ip_tablet=c.habitacion
JOIN cajas = caja on caja.idMovtemp=m.id
join usuarios = u on u.idUser =caja.idUser ORDER BY `idMovtemp`";
$res=$conexion->prepare($sql);
$res->execute();
$res=$res->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exportar productos</title>
</head>
<body>
<table border=1 class="table table-hover">
<thead style="background: #19d6f5b0;">
<tr>
<th>Nro ticket</th>
<th>Usuario</th>
<th>Habitacion</th>
<th>Fecha de inicio</th>
<th>Hora de inicio</th>
<th>Articulo</th>
<th>Cantidad</th>
<th>Costo</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<?php foreach ($res as $key): $total=$key['cantidad']*$key['precio'];?>
<tr>
<td><?php echo $key['idMovtemp'];?></td>
<td><?php echo $key['user'];?></td>
<td><?php echo $key['habitacion'];?></td>
<td><?php echo $key['fechaActS1'];?></td>
<td><?php echo $key['horaActS1'];?></td>
<td><?php echo $key['nombre'];?></td>
<td><?php echo $key['cantidad'];?></td>
<td><?php echo $key['precio'];?></td>
<td><?php echo $total;?></td>
</tr>
<?php endforeach?>
</tbody>
</table>

    
</body>
</html>