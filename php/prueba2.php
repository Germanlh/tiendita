<?php
if(isset($_GET['op'])){
    $op=$_GET['op'];
    switch($op){
        case 1:
            echo "<h1>EXITO</h1>";
            break;
        default:
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBA INDEX</title>
</head>
<body>
    <a href="?op=1">aqui</a>
</body>
</html>