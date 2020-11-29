<?php include("../sesion.php");?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modificaciones</title>

	<link rel="stylesheet" href="../../css/estilizar.css">
    <link rel="shortcut icon" href="../../img/favicon.png" type="image/x-icon">
</head>
<body><!--*******************************************************************-->


  <div class="login-box">
	<img src="../../img/logoAAA.svg" class="avatar" alt="Avatar Image">
	
	<form method="POST" action="USRmodifica.php" id="modifica_frm" name="modifica_frm" enctype="application/x-www-form-urlencoded">
	
		<input type="password" name="verpsw" id="verpsw" class="caja-texto" placeholder="Contraseña Actual" required />
		
		<!-- e-mail -->
		<label for="usr">e-mail</label>
		<input type="email" id="usr" name="usr" value="<?php echo $_SESSION['usr']?>" class="caja-texto" placeholder="email" required >
		
		<!-- Nombre -->
		<label for="nombre">Nombre</label>
		<input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION['nombre']?>" class="caja-texto" placeholder="Nombre" required >
		
		
		<!-- PASSWORD  -->
		<label for="psw">Password</label>
		<input type="password" name="psw" id="psw" class="caja-texto" placeholder="Contraseña Nueva" required />
		
		
		<!-- Confirma PSW  -->
		<label for="conpsw">Confirma Password</label>
		<input type="password" name="conpsw" id="conpsw" class="caja-texto" placeholder="Confirma Contraseña Nueva" required />
		
		
		<input type="submit" id="enviar" name="enviar" value="ACTUALIZA">
      </form>
	</div>
	
</body><!--*******************************************************************-->
</html>


