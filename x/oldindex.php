<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"> 
		<link rel="stylesheet" href="">
		<title>Tiendita</title>
	</head>

	<body>
		<header>
			<nav>	</nav>
		</header>
		<section>
			<header></header>
		<!-- Aqui colocamos nuestro formulario para acceder a las demas Paginas, dependiendo de que clase de usuario seas
			veras la siguiente pagina editada-->
				<form method="POST" action="php/usr/USRvalida.php" id="acceder_frm" name="acceder_frm" enctype="application/x-www-form-urlencoded">

					<input type="email" id="usr" name="usr" placeholder="email del usuario" required >
					<input type="password" name="psw" id="psw" placeholder="Contraseña" required />
					<input type="submit" id="enviar" name="enviar" value="Accesar">
				</form>
				<br><br><br>
				<form method="POST" action="php/usr/USRagrega.php" id="registrar_frm" name="registrar_frm" enctype="application/x-www-form-urlencoded">

					<input type="email" id="usr" name="usr" placeholder="e-mail" required >
					<input type="text" id="nombre" name="nombre" placeholder="Nombre" required >
					<input type="password" name="psw" id="psw" placeholder="Contraseña" required />
					<input type="password" name="conpsw" id="conpsw" placeholder="Confirma Contraseña" required />
					<input type="submit" id="enviar" name="enviar" value="Accesar">
				</form>
<!--********************************************************************************************-->							
			<?php
				if(isset($_GET['mensaje'])){$mensaje=$_GET['mensaje'];}
				else{$mensaje=0;}
				echo "<br><br><br> <p>";
				switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
					case 1: 
						echo"<h1><mark>Usuario No registrado</mark></h1>";
						break;
					case 2: 
						echo"<h1><mark>Error en Password</mark></h1>";
						break;
					case 3: 
						echo"<h1><mark> Registro Exitoso</mark></h1>";
						break;
					case 4: 
						echo"<h1><mark>Ya existe este usuario</mark></h1>";
						break;
					case 5: 
						echo"<h1><mark>Cambio de datos Exitoso</mark></h1>";
						break;
					case 6: 
						echo"<h1><mark>Pasword invalido</mark></h1>";
						break;
					default: break;
					}
				echo"</p>";	
				
			?>
<!--********************************************************************************************-->
			
			<footer></footer>
		</section>

		<footer></footer>
		<script language="javascript" src=""></script>
	</body>
</html>