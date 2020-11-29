<?php
$op=1;

if(isset($_GET['mensaje'])){
  $mensaje=$_GET['mensaje'];
  $op=3;
  }
else{$mensaje=0;}
switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
  case 1: 
    $msj="Usuario No registrado";
    break;
  case 2: 
    $msj="Error en Password";
    break;
  case 3: 
    $msj=" Registro Exitoso";
    break;
  case 4: 
    $msj="Ya existe este usuario";
    break;
  case 5: 
    $msj="Cambio de datos Exitoso";
    break;
  case 6: 
    $msj="Pasword invalido";
    break;
  case 7: 
    $msj="Pasword No Coinciden";
    break;
  case 8: 
    $msj="Borrado exitoso";
    break;  
  default: break;
  }


if(isset($_GET['op'])){
    $op=$_GET['op'];
}
    switch($op){
        case 1:
            $page="login.php";
            break;
        case 2:
            $page="suscribe.php";
            break;
        case 3:
            $page="msj.php";
            break;
        default:
            break;
    }  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiendita AAA</title>
    <link rel="stylesheet" href="css/estilizar.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  </head>
 
  <body><!--***************************************************-->
    
    <?php include $page;?>

  </body><!--**************************************************-->
</html>
