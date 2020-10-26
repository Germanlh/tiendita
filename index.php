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
				<form method="POST" action="php/usr/USRvalida.php" name="sesion_frm" enctype="application/x-www-form-urlencoded">

					<input type="text" id="usr" name="usr" placeholder="Nombre de usuario" required >
					<input type="password" name="psw" id="psw" placeholder="Contraseña" required />
					<input type="submit" id="enviar" name="enviar" value="Accesar">

				</form>
<!--********************************************************************************************-->							
			<?php
				if(isset($_GET['mensaje'])){
					$mensaje=$_GET['mensaje'];
				}
				else{
					$mensaje=0;
				}
				
				echo"<br><br> <p>";
				switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
					case 1: 
						echo"<mark>No Posee permisos suficientes consultarlo con el administrador</mark>";
						break;
					case 2: 
						echo"<mark>Usuario no Registrado</mark>";
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
<!--********************************************************************************************-->
			
			<footer></footer>
		</section>

		<footer></footer>
		<script language="javascript" src=""></script>
	</body>
</html>