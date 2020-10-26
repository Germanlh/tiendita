<?php
include("funciones.php");
destruyesesion();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"> <meta charset="ISO-8859-1"> <link rel="stylesheet" href="">
		<script language="javascript" src=""></script>
		<style type="text/css"> </style>
		<title>CRM Krea</title>
	</head>

	<body>
		<header>
			<h2 align="center"> :: BIENVENIDO :: </h2>
			<h4 align="center"> AL SISTEMA DE GESTION DE KREA</h4>
			<nav>	</nav>
		</header>
		<HR align="CENTER" size="2" width="50%" color="Red">
		<section>
			<header></header>
		<!-- Aqui colocamos nuestro formulario para acceder a las demas Paginas, dependiendo de que clase de usuario seas
			veras la siguiente pagina editada-->
				<form method="POST" action="usr/USRvalida.php" >
					<br><br><br><br><br><br>
					<p align="center">
						<input type="text" id="usr" name="usr" required placeholder="Nombre de usuario">
						<input type="password" name="psw" id="psw" required placeholder="Contraseña"/>
						<input type="submit" id="enviar" name="enviar" value="Accesar">
					</p>
				</form>
<!--********************************************************************************************-->							
			<?php
				$mensaje=$_GET['mensaje'];
				echo"<br><br> <p align='center'>";
				switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
					case 1: 
						echo"<mark>No Posee permisos suficientes consultarlo con el administrador</mark>";
						break;
					case 2: 
						echo"<mark>Usuario no Resgistrado</mark>";
						break;
					case 3: 
						echo"<mark>Tiempo de espera mayor a 10 minutos Inicie sesion nuevamente</mark>";
						break;
					case 4: 
						echo"<mark>Operacion Exitosa Inicie sesion nuevamente</mark>";
						break;	
					default: break;
					}
				echo"</p>";	
			?>
				<article>
					<header></header>
						<p class="next-to-aside"></p>
						<aside>	<p></p></aside>
					<footer></footer>
				</article>
			
			<footer></footer>
		</section>

		<footer></footer>
	</body>
</html>