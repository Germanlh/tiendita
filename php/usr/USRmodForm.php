<?php include("../sesion.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modificaciones</title>
</head>
<body>
	<form method="POST" action="USRmodifica.php" id="modifica_frm" name="modifica_frm" enctype="application/x-www-form-urlencoded">

		<input type="password" name="verpsw" id="verpsw" placeholder="Verifica tu Contraseña" required />

		<input type="email" id="usr" name="usr" value="<?php echo $_SESSION['usr']?>" placeholder="email" required >
		<input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre']?>"placeholder="Nombre" required >
		<input type="password" name="psw" id="psw" placeholder="Contraseña" required />
		<input type="password" name="conpsw" id="conpsw" placeholder="Confirma Contraseña" required />
		<input type="submit" id="enviar" name="enviar" value="Accesar">

	</form>

</body>
</html>


