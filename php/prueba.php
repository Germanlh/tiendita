<?php include("sesion.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
<h1>Estamos en una página protegida</h1>
<p>  con el usuario <?php echo $_SESSION['usr'];?> </p>
    
<a href="cerrarsesion.php">Salir</a>
</body>
</html>