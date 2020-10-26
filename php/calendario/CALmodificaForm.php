<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

if(isset($_GET['idevcal'])){
	$idevcal=$_GET['idevcal'];
	$fecha=$_GET['fecha'];
	$vista=$_GET['vista'];

	$conexion=conectabd("crmkrea");
	$query=mysql_query("SELECT * FROM calendario WHERE idevcal='".$idevcal."'");
	if(!$query){die("No pudimos actualizar el Calendario: ".mysql_error());}
	while($fila=mysql_fetch_array($query)){
		$evento=$fila['evento'];
		$fechai=$fila['fechainicio'];
		$horai=$fila['horainicio'];
		$fechaf=$fila['fechafin'];
		$horaf=$fila['horafin'];
		$idcliente=$fila['idcliente'];
		$prioridad=$fila['prioridad'];
		$comentarios=$fila['comentarios'];
		
		}
	mysql_close($conexion);
	}
else{
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

/************** conectamos a la BD**************/
$conexion=conectabd("crmkrea");
	
	echo'
		<table border=1 width=95% valign="middle">
		<tr  bgcolor="#5967DE">
			<th  align="center">EVENTO</th>
			<th  align="center">CLIENTE</th>
			<th  align="center">INICIO</th>
			<th  align="center">FIN</th>
			<th  align="center">PRIORIDAD</th>
		</tr>
		<tr>
			<form method="POST" action="CALmodifica.php" name="fechas" id="fechas">	
			
				<td><input type="text" name="evento"  id="evento" value="'.$evento.'" /></td>';
				
	$consulta=mysql_query("SELECT  idcliente, nombres, apellidos FROM directorio WHERE tipo != '".KREA."' ORDER BY nombres");
	if(!$consulta){	die("No accesamos al DIRECTORIO: ".mysql_error());}
	
	echo'<td><select id="idcliente" name="idcliente">';
	echo'<option value="ninguno">Ninguno</option>';	
	while($fila2=mysql_fetch_array($consulta)){
			if($idcliente==$fila2['idcliente']){echo'<option value="'.$fila2['idcliente'].'" selected>'.$fila2['nombres'].' '.$fila2['apellidos'].'</option>';	}
			else{echo'<option value="'.$fila2['idcliente'].'">'.$fila2['nombres'].' '.$fila2['apellidos'].'</option>';	}
			}	
	echo'</select> </td>';
	mysql_free_result($consulta);
							
	echo'
				<td><input type="date" value="'.$fechai.'" name="fechai" id="fechai" min="" max="">
						<input type="time" name="horai" value="'.$horai.'"></td>
				<td><input type="date" value="'.$fechaf.'" name="fechaf" id="fechaf">
						<input type="time" name="horaf"  id="horaf" value="'.$horaf.'"></td>
		';	
	echo'<td><select id="prioridad" name="prioridad" required >';   /* ID Vendedor asignado */
		for($i=1;$i<=4;$i++){
			if($prioridad==$i){echo'<option value="'.$i.'" selected>'.$calprioridad[$i].'</option>';			}
			else{echo'<option value="'.$i.'">'.$calprioridad[$i].'</option>';}
			}	
	echo '</select></td>
		</tr>';
	
	echo' 
		<tr>
			<th bgcolor="#5967DE">COMENTARIOS</th>
			<td colspan=3 ><textarea id="comentarios" name="comentarios" cols=120 rows="5">'.$comentarios.'</textarea></td>
			<td><input type="submit" name="modificar"  id="modificar" value="Modificar" ></td>
		</tr>		
				<input type="hidden" name="fecha" id="fecha" value="'.$fecha.'">
				<input type="hidden" name="vista" id="vista" value="'.$vista.'">
				<input type="hidden" name="idevcal" id="idevcal" value="'.$idevcal.'">
			</form>
		</table>	
		';
mysql_close($conexion);
/*******************************************************************************************/
?>