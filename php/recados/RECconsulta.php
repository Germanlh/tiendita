<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

echo "<h2 align='center'> :: RECADOS :: </h2>";

/**************************************************************************************/
$conexion=conectabd("crmkrea");

$nempleados=0;	
	$query=mysql_query("SELECT  * FROM usuarios");
	if(!$query){die("No pudo Acceder: ".mysql_error());}
	
		while($fila=mysql_fetch_array($query)){
			$arrayempleados[$nempleados]=$fila['usuario'];
			$arrayidempleados[$nempleados]=$fila['idkrea'];
			$nempleados++;
			}	
		
$peticion="SELECT * FROM recados WHERE iddestinatario='".$_SESSION['idkrea']."' ORDER BY  status";
$consulta=mysql_query($peticion);	
if(!$consulta){die("No pudimos acceder a RECADOS ERROR :".mysql_error());}

echo'<table border=1 width=100% valign="middle">';
while($fila=mysql_fetch_array($consulta)){
		if($fila['status']==ACTIVO){$colorfila="#FFFFFF";}
		if($fila['status']==BAJA){$colorfila="#DDDDDD";}
//		<tr onMouseOver="this.style.backgroundColor='#FFFFC6';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#FFFFFF'"];">
		echo'
			<tr bgcolor='.$colorfila.'>
			<td>Emisor: '.$fila['emisor'].'</td>
			<td>Mensaje: '.$msgtipo[$fila['tipo']].'</td>
			<td>Fecha : '.$fila['fecha'].'</td>
			';
			
			if($fila['status']==ACTIVO){echo'<td><a href="RECmodifica.php?idrecado='.$fila['idrecado'].'&status='.$fila['status'].'">Leido</a></td>';}
			if($fila['status']==BAJA){echo'<td><a href="RECmodifica.php?idrecado='.$fila['idrecado'].'&status='.$fila['status'].'">Pendiente</a></td>';}
						
			echo '<td><a href="RECelimina.php?idrecado='.$fila['idrecado'].'">Eliminar</a></td>	';
		for($i=0;$i<$nempleados;$i++){
			if($arrayidempleados[$i]==$fila['idreceptor']){echo '<td>Recibio: '.$arrayempleados[$i].'</td>';}
			}
			
		echo'
		</tr>
		<tr bgcolor='.$colorfila.'>
			<td colspan=4 rowspan=2> Mensaje: '.$fila['mensaje'].'</td>
			<td align="right">Telefono:</td>
			<td>'.$fila['tel'].'</td>
		</tr>
		<tr bgcolor='.$colorfila.'>
			<td align="right">Empresa</td>
			<td>'.$fila['empresa'].'</td>
		</tr>	
			';
	}
	echo'</table>';
		
mysql_free_result($consulta)	;
mysql_close($conexion);	

/*********************************************************************************************/
				
?>