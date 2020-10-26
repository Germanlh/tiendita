<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);
?>
<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8"> <meta charset="ISO-8859-1"> <link rel="stylesheet" href="">
		<script language="" src=""></script>
		<style type="text/css"> </style>
		<title>:: Agrega Directorio ::</title>
	</head>

	<body>
		<header>
			<h2>Agrega por Favor los usuarios</h2>
		</header>
		<nav>	</nav>
									
		<section>
			<header></header>
			<br><br>
			
			<form method="POST" action="RECagrega.php" id="recados" name="recados">
			<?php
				$conexion=conectabd("crmkrea");
				$consulta=mysql_query("SELECT  * FROM usuarios ORDER BY permisos");
				if(!$consulta){	die("No accesamos a los RECADOS ERROR: ".mysql_error());}
				echo'<select id="destinatario" name="destinatario" required >';   /* ID Vendedor asignado */
					while($fila=mysql_fetch_array($consulta)){
						echo' <option value="'.$fila['idkrea'].'">'.$fila['usuario'].'</option>';	
						}	
				echo'</select>';
				mysql_free_result($consulta);
				mysql_close($conexion);
			?>
				<input type="text" id="emisor" name="emisor" required autofocus placeholder="Quien hablo"></input>
				 <select id="tipo" name="tipo">
					<option value="<?php echo MSGURG;?>" >Urgente</option>
					<option value="<?php echo MSGQSC;?>" >Que se comunique</option>
					<option value="<?php echo MSGQPAV;?>" >Que pasa a verlo a cierta hora</option>
					<option value="<?php echo MSGSCD;?>" >Se comunica despues</option>
					<option value="<?php echo MSGCITA;?>" >Solicita Cita</option>
					<option value="<?php echo MSGVINO;?>" >Vino a verlo</option>
				</select>
				<br><br><textarea id="mensaje" name="mensaje" cols="65" rows="10" required placeholder="mensaje"></textarea><br><br>
				<input type="tel" id="tel" name="tel" required placeholder="Telefono"></input>
				<input type="text" id="empresa" name="empresa"  placeholder="Empresa"></input>
				<input type="submit" id="registrar" name="registrar"value="Registrar"></input><br><br>
			</form>		

			<footer></footer>
		</section>
		<?php
			$mensaje=$_GET['mensaje'];
			switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
					case 1: echo"<br><br>Mensaje Enviado"; break;
					case 2: echo"<br><br>"; break;
					case 3: echo"<br><br>";break;	
					default: break;
					}		
		?>		
						
		<footer></footer>

	</body>
</html>