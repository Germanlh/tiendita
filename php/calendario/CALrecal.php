<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

$colorprioridad=array(1=>"#FFAAAA", 2=>"#FFFFAA", 3=>"#AAFFAA", 4=>"#BBBBFF");

/***********************************************************************************/
function muestrames ($fecha,$tipo){ //Devuelve una cadena de texto reconocible para el usuario
	$msems=array(0=>"Dom", 1=>"Lun", 2=>"Mar", 3=>"Mie", 4=>"Jue", 5=>"Vie", 6=>"Sab");
	$muestramesab=array(1=>"ENE", 2=>"FEB", 3=>"MAR", 4=>"ABR", 5=>"MAY", 6=>"JUN", 7=>"JUL", 8=>"AGO", 
	9=>"SEP", 10=>"OCT", 11=>"NOV", 12=>"DIC");
	$fechanum=explode("-",$fecha);
	$dia=date("w",strtotime($fecha));
	switch($tipo){
		case 3:$texto=$msems[(int)$dia]." ".$fechanum[2]." ".$muestramesab[(int)$fechanum[1]]." ".$fechanum[0]; break;
		default: break;
		}
	return $texto;
	}
/***********************************************************************************/
$fecha=$_GET['fecha'];
$vista=$_GET['vista'];
		
if(isset($_SESSION['idevcalarray'])){
	
	$cont=count($_SESSION['idevcalarray']);
	echo '<br><br>Existen '.$cont.' Eventos que interfieren con el evento que usted esta colocando <br>';

	$cadena="";		
	$a=1;
	foreach($_SESSION['idevcalarray'] as $i=>$valor){
		if($a==$cont){	$cadena=$cadena."idevcal='".$valor."'";}
		else{$cadena=$cadena."idevcal='".$valor."' OR ";}
		$a++;
		}
	}

$conexion=conectabd("crmkrea");	

if($cont){
	
	echo'<table border=1 width=100% valign="middle">
		<tr bgcolor="#5967DE">
			<th  align="center">EVENTO</th>
			<th  align="center">CLIENTE</th>
			<th  align="center">INICIO</th>
			<th  align="center">FIN</th>
			<th colspan=3 align="center">GESTION</th>
		</tr>';
	
	$peticion="SELECT * FROM calendario WHERE ".$cadena."";
	
	$query=mysql_query($peticion);	
	if(!$query){die("CALrecal No pudimos conectar con CALENDARIO:".mysql_error());}
	
	while($fila=mysql_fetch_array($query)){
	
		if($fila['idcliente']=="ninguno"){$cliente="No se selecciono cliente";}
		else{			
			$consulta2=mysql_query("SELECT nombres, apellidos FROM directorio WHERE idcliente='".$fila['idcliente']."'");	
			if(!$consulta2){die("No pudimos conectar con CALENDARIO:".mysql_error());}	
			while($fila2=mysql_fetch_array($consulta2)){$cliente=$fila2['nombres'].' '.$fila2['apellidos'];	}
			}	
	
		if($fila['status']==ACTIVO){$bgcolor=$colorprioridad[$fila['prioridad']]; $txt="Desactivar";}
		else{$bgcolor="#BBBBBB"; $txt="Activar";}
		echo'<tr bgcolor='.$bgcolor.'>
					<td width=22% >'.$fila['evento'].'</td>
					<td width=22% >'.$cliente.'</td>
					<td width=16% >'.muestrames ($fila['fechainicio'],3).' '.$fila['horainicio'].'</td>
					<td width=16% >'.muestrames ($fila['fechafin'],3).' '.$fila['horafin'].'</td>	';
			if($_SESSION['idkrea']==$_SESSION['idpropcal']){ 
				echo '
					<td width=7% ><a href="CALelimina.php?idevcal='.$fila['idevcal'].'&fecha='.$fecha.'&vista='.$vista.'">Eliminar</a></td>
					<td width=7% ><a href="CALmodifica.php?idevcal='.$fila['idevcal'].'&status='.$fila['status'].'&fecha='.$fecha.'&vista='.$vista.'">'.$txt.'</a></td>
					<td width=7% ><a href="CALmodificaForm.php?idevcal='.$fila['idevcal'].'&fecha='.$fecha.'&vista='.$vista.'">Cambiar</a></td>';
					}
			else{ echo'<td colspan=3>::Sin permisos::</td>';	}
		echo'</tr>';

		echo'<tr> <td colspan=7  valign="top">'.$fila['comentarios'].'</td> </tr>';	
		}
	}

echo '</table><br><br><a href="CALconsulta.php"> << IGNORAR </a>';//Que pasa si desea ignorar los cambios	
	
if(($_SESSION['permisos']==ADMIN)&&($_SESSION['idkrea']!=$_SESSION['idpropcal'])){
	unset($_SESSION['idevcalarray']);
	}	

mysql_close($conexion);		
?>