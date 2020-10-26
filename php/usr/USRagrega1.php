<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

?>
<!DOCTYPE html>
<html lang="es">
<!-- 
Esta pagina se abre solamente con con el encargado... Pero este usuario no tiene permisos para elimnar  solo puede agregar usuarios
de su mismo nivel o inferiores, el unico que puede añadir administradores sera otro administrador
-->
	<head>
		<meta charset="utf-8"> <meta charset="ISO-8859-1"> <link rel="stylesheet" href="">
		<script language="" src=""></script>
		<style type="text/css"> </style>
		<title>:: Agrega Usuarios ::</title>
	</head>

	<body>
		<?php
			if($_SESSION['permisos']==ADMIN||$_SESSION['permisos']==ENCARGADO){
				echo'
					<header>
						<h2 align="center">:: AGREGAMOS UN USUARIO ::</h2>
					</header>
					<nav>	</nav>
					<br><br><br>					
					<section>
						<header></header>
							<form method="POST" action="USRagrega.php">
								<p align="center">
								<input type="text" id="usr" name="usr" required placeholder="Nombre de usuario"></input>
								<input type="password" id="psw" name="psw" required placeholder="Contraseña"></input>
								<select name="permisos">
									<option value='.ENCARGADO.'>Encargado</option>
									<option value='.JEFEPROD.'>Jefe de produccion</option>
									<option value='.VENTAS.'>Vendedor</option>
									<option value='.MOSTRADOR.'>Mostrador</option>
									<option value='.IMPRESOR.'>Mostrador</option>
									<option value='.TALLER.'>Taller</option>
								</select><br><br>
								CONFIRME SU PASSWORD
								<input type="password" id="psw2" name="psw2" required placeholder="Confirme contraseña"></input>
								<input type="submit" id="registrar" name="registrar"></input>
								</p>
							</form>		
								<footer></footer>
					</section>
					';
					$mensaje=$_GET['mensaje'];
					echo"<br><br> <p align='center'>";
					switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
						case 1: 
							echo"El Usuario fue dado de alta satisfactoriamente";
							break;
						case 2: 
							echo"<mark>El Usuario ya Existe</mark>";
							break;
						case 3: 
							echo"<mark>Incongruencia en los datos Vuelva a intentarlo</mark>";
							break;	
						default: break;
						}	
					//echo '<br> <a href="../aencargado.php"> << Regresar </a> </p>';	
				}
			else{ sinpermiso(1,1,1); }// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
		?>		
						
		<footer></footer>

	</body>
</html>