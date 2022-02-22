<?php
session_start();
require "conection.php";


if(!isset($_SESSION['user'])){
header("location:login/login_v5/index.php");
}



$ventas="SELECT m.fechaActS1,u.user,m.horaActS1, h.`nombre` as habitacion, a.`nombre`, c.`cantidad`, c.`precio`,c.`nombreDelArticulo`, c.`estadoProducto`, c.`idMovtemp` FROM `carritos` = c
JOIN articulos = a on a.articulo=c.articulo
JOIN movtemp = m on m.id=c.`idMovtemp`
JOIN habitaciones = h on h.ip_tablet=c.habitacion
JOIN cajas = caja on caja.idMovtemp=m.id
join usuarios = u on u.idUser =caja.idUser ORDER BY `idMovtemp`";
$ventasAll=$conexion->prepare($ventas);
$ventasAll->execute();
$ventasAll=$ventasAll->fetchAll(PDO::FETCH_ASSOC);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <title>ventas</title>
    <link rel="stylesheet" type="text/css" href="mdbootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="mdbootstrap/css/mdb.min.css">
	<link rel="stylesheet" href="mdbootstrap/all.min.css">
	<link rel="stylesheet" href="moduloCarrito/css/style.css">
</head>
<body>
    <header>
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
      <a class="navbar-brand" href="#">Ventas</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="index.php">Habitaciones
              <span class="sr-only">(current)</span>
            </a>
          </li>
          
          <!-- <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="moduloCarrito/categoriasComidas.php">Productos</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="addProducto/addproduct.php">Añadir producto</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Servicios
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
              <a class="dropdown-item waves-effect waves-light" href="cocina.php">Cocina</a>
              <a class="dropdown-item waves-effect waves-light" href="sexHotPanel.php">Sex Hot Panel</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
            <a class="dropdown-item waves-effect waves-light" href="costosAVM.php">costos</a>
            <a class="dropdown-item waves-effect waves-light" href="caja.php">Caja</a>
            <a class="dropdown-item waves-effect waves-light" href="ventas.php">Ventas</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light">
              <i class="fab fa-google-plus-g"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <?php echo $_SESSION['user']['user']?>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item waves-effect waves-light" href="login/login_v5/php/cerrar.php">Cerrar Sesion</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    </header>
  <section>
  <div class="container">
  
  <div class="row">
  <div class="col">
  <h3 style="background: #f5dcf4;border-radius: 12px;width: 65%;">Ventas</h3>
  </div>
  <div style="margin-right: 70%;" class="col">
  <a class="btn btn-blue" href="ventas/exportarExel.php">Exel</a>
  </div>
  </div>
  
<table class="table table-hover">
<thead style="background: #f5198978;">
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
<?php foreach ($ventasAll as $key): $total=$key['cantidad']*$key['precio'];?>
<tr>
<td><?php echo $key['idMovtemp'];?></td>
<td><?php echo $key['user'];?></td>
<td><?php echo $key['habitacion'];?></td>
<td><?php echo $key['fechaActS1'];?></td>
<td><?php echo $key['horaActS1'];?></td>
<?php if(!empty($key['nombreDelArticulo'])){?>
<td><?php echo $key['nombreDelArticulo'];?></td>
<?php }else{?>
<td><?php echo $key['nombre'];?></td>
<?php }?>
<td><?php echo $key['cantidad'];?></td>
<td><?php echo $key['precio'];?></td>
<td><?php echo $total;?></td>
</tr>
<?php endforeach?>
</tbody>
</table>
  
  
  
  
  </div>
  
  </section>


  
    
  


</body>
<script src="mdbootstrap/js/jquery.min.js"></script>
<script src="mdbootstrap/js/bootstrap.min.js"></script>
<script src="mdbootstrap/js/mdb.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/js.js"></script>


<style>
li:hover{
  background:#33b5e5ab;
  color:white;
  border-radius: 8px;
}

</style>

</html>