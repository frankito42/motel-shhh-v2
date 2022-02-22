<script>
setInterval(() => {
fetch('../preguntaEstado.php?id='+<?php echo $_GET['id'];?>)
  .then(response => response.json())
  .then((data)=>{
    console.log(data.estado)
    if(data.estado!="verificacion2"){
      location.href="../index.php"
    }  
  });
}, 3000);
</script>
<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires'); 
require "../conection.php";





$sqlItem="SELECT * FROM `itemverificacion`";
$item=$conexion->prepare($sqlItem);
$item->execute();
$item=$item->fetchAll(PDO::FETCH_ASSOC);


$contador=count($item);
/* echo $contador; */

$dividir=intdiv($contador,2);

$aux=$contador-$dividir;


/* echo $dividir;
echo $aux; */
$selec="SELECT `habitacion`, `dirip`, `letra`, `nombre`, `descripcion`, `costo`, `ip_tablet`, `estado` FROM `habitaciones` WHERE habitacion=:id";
$habitacion=$conexion->prepare($selec);
$habitacion->bindParam(":id",$_GET['id']);
$habitacion->execute();
$habitacion=$habitacion->fetch(PDO::FETCH_ASSOC);





$movtemSelect="SELECT `id`, `id2`, `codigo`, `habitacion`, `fechaActS1`, `horaActS1`, `horaActS2`, `horaDesActS2`, `horaActS3`, `horaDesActS3`, `fechaDesActS1`, `horaDesActS1`, `S1`, `S2`, `S3` FROM `movtemp` WHERE habitacion=:id";
$movtem=$conexion->prepare($movtemSelect);
$movtem->bindParam(":id",$_GET['id']);
$movtem->execute();
$movtem=$movtem->fetch(PDO::FETCH_ASSOC);







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motel</title>
    <link rel="stylesheet" type="text/css" href="../mdbootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../mdbootstrap/css/mdb.min.css">
	<link rel="stylesheet" href="../mdbootstrap/all.min.css">
	<link rel="stylesheet" href="../moduloCarrito/css/style.css">
</head>
<style>
.custom-control-label::before, 
.custom-control-label::after {
  
   /*  width: 2rem;
    height: 2rem; */
    /* border-radius:100% !important;
    margin-right:-20%; */
}
.custom-control-label::before {
    position: absolute;
    top: .25rem;
    left: -2.5rem;
    display: block;
    width: 2rem;
    height: 2rem;
    pointer-events: none;
    content: "";
    background-color: #fff;
    border: #adb5bd solid 1px;
    border-radius:100% !important;
}


element.style {
}
.custom-control {
    position: relative;
    display: block;
    min-height: 2.5rem;
    padding-left: 3rem;
}
.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 1247px;
}
.custom-control-label::after {
    position: absolute;
    top: .25rem;
    left: -2.5rem;
    display: block;
    width: 2rem;
    height: 2rem;
    content: "";
    background: no-repeat 50%/50% 50%;
}
</style>
<body style="background:#0000005c;">
    <header>
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
      <a class="navbar-brand" href="#">Motel VIP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="../index.php">Habitaciones
              <span class="sr-only">(current)</span>
            </a>
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
              <a class="dropdown-item waves-effect waves-light" href="../login/login_v5/php/cerrar.php">Cerrar Sesion</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    </header>
<section>
<div class="container">
<?php

if (isset($_SESSION['message2'])) {

  echo "<div id='editadoCorrecto' class='alert alert-dismissible alert-success' style='margin-top:20px;'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>"
    .$_SESSION['message2']."
  </div>";
}
?>


<div style="border-radius: 10px;background: #bb2b887a;box-shadow: 0px 5px 30px 10px #0000007a;" class="container my-5 p-5  animated pulse">


  <!--Section: Content-->
  <section class="text-center black-text">

    <!-- Section heading -->
    <h2 style="font-size:50px;" class="font-weight-bold mb-4 pb-2 text-uppercase"><?php echo $habitacion['nombre']." en verifiacion 2"?></h2>
    <!-- Section description -->
    <!-- Grid row -->
    <!-- Grid row -->

  </section>
  <!--Section: Content-->
  <div style="width:5%;float:left;">
 
   <a id="finVerificacion2" style="background:#269e2ad9;" class="btn btn-lg">FIN DE VERIFICACION 2</a>
   
  

   
  </div>

  <div style="width:75%;float:right;">
      <button class="btn purple-gradient btn-lg" data-toggle="modal" data-target="#modalCheck">Nuevo item</button>
  <div class="row">
    <div class="col-sm">
    <?php
    for ($i=0; $i < $aux ; $i++):
    ?>
    <div class="custom-control custom-checkbox checkbox-xl">
    <input type="checkbox" class="custom-control-input" id="<?php echo $item[$i]['item']?>">
    <label style="font-size: 130%;" class="custom-control-label" for="<?php echo $item[$i]['item']?>"><?php echo $item[$i]['item']?> <a href="phpVerfi/eliminarItem.php?id=<?php echo $item[$i]['idVerificacion']?>"><i style="color:red;" class="fas fa-backspace fa-1x"></i></a></label>
  </div>
  <?php endfor?>
    </div>

    <div class="col-sm">
   
    <?php
    for ($i=$aux; $i < $contador ; $i++):
    ?>
    <div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="<?php echo $item[$i]['item']?>">
    <label style="font-size: 130%;" class="custom-control-label" for="<?php echo $item[$i]['item']?>"><?php echo $item[$i]['item']?> <a href="phpVerfi/eliminarItem.php?id=<?php echo $item[$i]['idVerificacion']?>"><i style="color:red;" class="fas fa-backspace fa-1x"></i></a></label>
  </div>
  <?php endfor?>





    </div>
    
   
  </div>
      
      <!-- <a class="btn btn-success btn-lg">aaaaaa</a> -->
 
  </div>
<br style="clear:both;">
</div>


</section>




</body>
<script src="../mdbootstrap/js/jquery.min.js"></script>
<script src="../mdbootstrap/js/bootstrap.min.js"></script>
<script src="../mdbootstrap/js/mdb.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="../js/js.js"></script>
<?php unset($_SESSION['message2'])?>

<script>
document.getElementById("finVerificacion2").addEventListener("click",()=>{
      document.getElementById('finVerificacion2').disabled =true
     let ipArduino="<?php echo $habitacion['dirip']?>"
     
    /* $.ajax({
        url:"http://"+ipArduino+"/?LP1"
    }).fail(()=>{
        
    }) */ //AJAX TAMBIEN FUNCIONA PARA COMUNICARME CON EL ARDUINO 
    /* console.log(ipArduino) */
    let param={"ipArduino":ipArduino}
    $.ajax({
        data:param,
        url:"phpVerfi/verificacion2.php",
        success:(e)=>{
            if (e=="bien") {
                $.get("http://"+ipArduino+"/?VC1")
                console.log("bien")
                setTimeout(() => {
                location.href="../index.php" 
                }, 2600);
            }else{
                console.log(e)
            }
        }
    })

})


</script>


<!-- ///////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////// -->
<div class="modal fade" id="modalCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
  <form action="phpVerfi/insertarItem.php" method="post">
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Modal </p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
        <div class="md-form">
            <input type="text" name="item" id="form1" class="form-control">
        <label for="form1">Nuevo item</label>
        </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</a>
         <button class="btn btn-success" type="submit">Guardar <i class="far fa-gem ml-1 text-white"></i></button>
       </div>
     </div>
    </form>
     <!--/.Content-->
   </div>
 </div>
<!-- ///////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////// -->

</html>