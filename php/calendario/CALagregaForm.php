<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);
?>
<!DOCTYPE html>
<html lang="es">
<!-- 
Esta pagina se abre al momento de agregar usuarios al directorio todos pueden agregar registros
pero las modificaciones estan restringidas,  los usuarios de krea deben agregar sus datos al primer acceso a su bandeja
			
			<input type="week" name="semana" id="semana" placeholder=" Semana"><br>
			<input type="month" name="mes" id="mes" placeholder=" Mes"><br>
			<input type="time" name="hora" id="hora" placeholder="Hora"><br>
			<input type="datetime-local" name="tiempolocal" id="tiempolocal" placeholder=" Semana"><br>
-->
	<head>
		<!--<meta http-equiv="Content-type" content="text/html; charset=utf-8" />-->
		<meta charset="utf-8">  <link rel="stylesheet" href="">
		<script language="" src=""></script>
		<style type="text/css"> </style>
		<title>:: Agrega al Calendario ::</title>
	</head>
	<body>
			<?php 
				if(!$_GET['fecha']){$fecha="";}
				else{
					$idevcal=$_GET['idevcal'];
					$fechai=$fechaf=$_GET['fecha'];
					$vista=$_GET['vista'];
					}
					$mensaje=$_GET['mensaje'];
					switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
						case 1: 
							echo"<mark>Tiempo El final no puede ser menor al Principio</mark>";
							break;
						case 2: 
							echo"<mark>Fecha Existe una actividad Programada en esta fecha con mayor importancia</mark>";
							break;
						default: break;
						}
				if(isset($_POST['evento'])){		
					$evento=$_POST['evento'];
					$fechai=$_POST['fechai'];
					$horai=$_POST['horai'];
					$fechaf=$_POST['fechaf'];
					$horaf=$_POST['horaf'];
					
					$idcliente=$_POST['idcliente'];
					$prioridad=$_POST['prioridad'];
					$comentarios=$_POST['comentarios'];
					$fecha=$_POST['fecha'];
					$vista=$_POST['vista'];
					$idevcal=$_POST['idevcal'];
					}
				?>
			<table border=1 width=95% valign="middle">
			<tr  bgcolor="#5967DE">
				<th  align="center">EVENTO</th>
				<th  align="center">CLIENTE</th>
				<th  align="center">INICIO</th>
				<th  align="center">FIN</th>
				<th  align="center">PRIORIDAD</th>
			</tr>
			<tr>	
			<form method="POST" action="CALagrega.php" name="fechas" id="fechas">	
				<td><input type="text" value="<?php echo $evento;?>" name="evento"  id="evento" placeholder="Titulo del Evento"  required /></td>
				<?php
					$conexion=conectabd("crmkrea");
					echo'<td><select id="idcliente" name="idcliente">';
					echo'<option value="ninguno">Ninguno</option>';	
					$consulta=mysql_query("SELECT  * FROM directorio WHERE tipo != '".KREA."' ORDER BY nombres");
					if(!$consulta){	die("No accesamos al CALENDARIO: ".mysql_error());}
					while($fila=mysql_fetch_array($consulta)){
						if($fila['idcliente']==$idcliente){echo'<option value="'.$fila['idcliente'].'" selected>'.$fila['nombres'].' '.$fila['apellidos'].'</option>';	}
						else{echo'<option value="'.$fila['idcliente'].'">'.$fila['nombres'].' '.$fila['apellidos'].'</option>';}
						}	
					echo'</select></td>';
					mysql_free_result($consulta);
					mysql_close($conexion);	
				?>
				<td><input type="date" required value="<?php echo $fechai;?>" name="fechai" id="fechai" min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" max="">
						<input type="time"  value="<?php echo $horai;?>" required name="horai"  id="horai" min="07:00" max="21:00"></td>
				<td><input type="date" required value="<?php echo $fechaf;?>" name="fechaf" id="fechaf" min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" max="">
						<input type="time"  value="<?php echo $horaf;?>" required name="horaf"  id="horaf" min="07:00" max="22:00"></td>
				<?php
				
			
				echo'<td><select id="prioridad" name="prioridad" required >';   /* ID Vendedor asignado */
					for($i=1;$i<=4;$i++){
						if($prioridad==$i){echo'<option value="'.$i.'" selected>'.$calprioridad[$i].'</option>';}
						else{echo'<option value="'.$i.'">'.$calprioridad[$i].'</option>';}
						}	
				echo '</select></td>
				<input type="hidden" name="fecha" id="fecha" value="'.$fecha.'">
				<input type="hidden" name="vista" id="vista" value="'.$vista.'">
				<input type="hidden" name="idevcal" id="idevcal" value="'.$idevcal.'">	';
				?>
			</tr>	
			<tr>
				<th bgcolor="#5967DE">COMENTARIOS</th>
				<td colspan="3" ><textarea id="comentarios" name="comentarios" cols="120" rows="5" required placeholder="Comentarios del evento"><?php echo $comentarios;?></textarea></td>	
				<td><input type="submit" name="agregar"  id="agregar" value="Registrar" ></td>
			</form>
			</tr>	
	</body>
</html>