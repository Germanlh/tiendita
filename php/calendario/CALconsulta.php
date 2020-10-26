<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

if(isset($_SESSION['idevcalarray'])){
	unset($_SESSION['idevcalarray']);//Nos dirigimos a CONSULTA
	}

$muestrasemana=array(0=>"Domingo", 1=>"Lunes", 2=>"Martes", 3=>"Miercoles", 4=>"Jueves", 5=>"Viernes", 6=>"Sabado");
$msems=array(0=>"Dom", 1=>"Lun", 2=>"Mar", 3=>"Mie", 4=>"Jue", 5=>"Vie", 6=>"Sab");
$muestrames=array(1=>"ENERO", 2=>"FEBRERO", 3=>"MARZO", 4=>"ABRIL", 5=>"MAYO", 6=>"JUNIO", 7=>"JULIO", 
8=>"AGOSTO", 9=>"SEPTIEMBRE", 10=>"OCTUBRE", 11=>"NOVIEMBRE", 12=>"DICIEMBRE");
$muestramesab=array(1=>"ENE", 2=>"FEB", 3=>"MAR", 4=>"ABR", 5=>"MAY", 6=>"JUN", 7=>"JUL", 8=>"AGO", 
	9=>"SEP", 10=>"OCT", 11=>"NOV", 12=>"DIC");
	
$colorprioridad=array(1=>"#FFAAAA", 2=>"#FFFFAA", 3=>"#AAFFAA", 4=>"#BBBBFF");
$hoy=date("Y-m-d");	
	
 if(!$_GET['fecha']){ $fecha=$hoy;}
 else{$fecha=$_GET['fecha'];}
 
 if(!$_GET['vista']){$vista="mes";}
else{$vista=$_GET['vista'];}

 if(!$_GET['idevcal']){$idevcal="nada";}
else{$idevcal=$_GET['idevcal'];}

/***********************************************************************************************/
function muestrames ($fecha,$tipo){ //Devuelve una cadena de texto reconocible para el usuario
	global $muestramesab; global $muestrames;global $muestrasemana;global $msems;
	$fechanum=explode("-",$fecha);
	$dia=date("w",strtotime($fecha));
	switch($tipo){
		case 1:$texto=$fechanum[2]." ".$muestramesab[(int)$fechanum[1]]." ".$fechanum[0]; break;
		case 2:$texto=$fechanum[2]." ".$muestrames[(int)$fechanum[1]]." ".$fechanum[0];break;
		case 3:$texto=$msems[(int)$dia]." ".$fechanum[2]." ".$muestramesab[(int)$fechanum[1]]." ".$fechanum[0]; break;
		case 4:$texto=$muestrasemana[(int)$dia]." ".$fechanum[2]." ".$muestrames[(int)$fechanum[1]]." ".$fechanum[0]; break;
		default: break;
		}
	return $texto;
	}
/***********************************************************************************************/
function vistalista($idevcal,$op){// $op=1->Toda lista        $op=2->Particular
	
	global $calprioridad; global $colorprioridad; global $vista; global $fecha;	$hoy2=strtotime($hoy);						

	echo'<table border=1 width=100% valign="middle">
		<tr bgcolor="#5967DE">
			<th  align="center">EVENTO</th>
			<th  align="center">CLIENTE</th>
			<th  align="center">INICIO</th>
			<th  align="center">FIN</th>
			<th colspan=3 align="center">GESTION</th>
		</tr>';
		switch($op){	
			case 1: 
				$peticion="SELECT * FROM calendario WHERE idusuario='".$_SESSION['idpropcal']."' ORDER BY status, fechainicio, fechafin, horainicio, horafin ASC";
				break;
			case 2: 
				$peticion="SELECT * FROM calendario WHERE idevcal='".$idevcal."' AND idusuario='".$_SESSION['idpropcal']."'";
				break;
			default: break;
			}
		$consulta=mysql_query($peticion);	
		if(!$consulta){die("No pudimos conectar con CALENDARIO:".mysql_error());}
		
		while($fila=mysql_fetch_array($consulta)){
		
			$fechac=strtotime($fila['fechainicio']);
			if($fechac<$hoy2){	
				$query=mysql_query("UPDATE calendario SET status='".BAJA."' WHERE idevcal='".$fila['idevcal']."'");
				if(!$query){	die("Problemas para actualizar STATUS: ".mysql_error());}
				}
		
			if($fila['idcliente']=="ninguno"){$cliente="No se selecciono cliente";}
			else{			
				$consulta2=mysql_query("SELECT nombres, apellidos FROM directorio WHERE idcliente='".$fila['idcliente']."'");	
				if(!$consulta2){die("No pudimos conectar con CALENDARIO:".mysql_error());}	
				while($fila2=mysql_fetch_array($consulta2)){$cliente=$fila2['nombres'].' '.$fila2['apellidos'];	}
				}	
		
			if($fila['status']==ACTIVO){$bgcolor=$colorprioridad[$fila['prioridad']]; $txt="Desactivar";}
			else{$bgcolor="#BBBBBB"; $txt="Activar";}
			echo'<tr bgcolor='.$bgcolor.'>
						<td width=22% ><a href="CALconsulta.php?vista=lista&idevcal='.$fila['idevcal'].'">'.$fila['evento'].'</a></td>
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

			if($idevcal==$fila['idevcal']){echo'<tr> <td colspan=7  valign="top">'.$fila['comentarios'].'</td> </tr>';	}
			}
	}	
/***********************************************************************************************/
function vistadia($fecha,$idevcal){

	global $muestramesab; global $vista; global $muestrames; global $muestrasemana; global $hoy;global $colorprioridad;
	$textofecha= muestrames ($fecha,3);
	
	$diaant=date('Y-m-d', strtotime('-1day '.$fecha));
	$diasig=date('Y-m-d', strtotime('+1day '.$fecha));	
	$diasemana=idate("w",strtotime($fecha));
	
	if($diasemana==0){$bgcolor="#DDDDDD";}
	else{$bgcolor="#5967DE";	}
	if($fecha==$hoy){$bgcolor="#7DF785";}
	
	$consulta=mysql_query("SELECT * FROM calendario WHERE fechainicio<='".$fecha."' AND fechafin>='".$fecha."'  
	AND idusuario='".$_SESSION['idpropcal']."'  ORDER BY status, fechainicio, fechafin, horainicio, horafin ASC");	
	if(!$consulta){die("No pudimos conectar con CALENDARIO:".mysql_error());}
	
	echo'<br><br>
		<table border=1 width=100% valign="middle">
		<tr >
			<th width=20% bgcolor="#BCB3FA" > <a href="CALconsulta.php?fecha='.$diaant.'&vista='.$vista.'"> << Anterior </a> </th>
			<th width=60%  bgcolor='.$bgcolor.' align="center">'.$textofecha.'</th>
			<th width=20% bgcolor="#BCB3FA"> <a href="CALconsulta.php?fecha='.$diasig.'&vista='.$vista.'"> Siguiente >> </a> </th>
		</tr>
		</table><br>
		<table border=1 width=100% valign="middle">
		<tr bgcolor='.$bgcolor.'>
			<th  align="center">EVENTO</th>
			<th  align="center">CLIENTE</th>
			<th  align="center">INICIO</th>
			<th  align="center">FIN</th>
			<th colspan=3 align="center">GESTION</th>
		</tr>';

			
		while($fila=mysql_fetch_array($consulta)){	
			
			if($fila['idcliente']=="ninguno"){$cliente="No se selecciono cliente";}
			else{			
				$consulta2=mysql_query("SELECT nombres, apellidos FROM directorio WHERE idcliente='".$fila['idcliente']."'");	
				if(!$consulta2){die("No pudimos conectar con CALENDARIO:".mysql_error());}	
				while($fila2=mysql_fetch_array($consulta2)){$cliente=$fila2['nombres'].' '.$fila2['apellidos'];	}
				}	
		
			if($fila['status']==ACTIVO){$bgcolor=$colorprioridad[$fila['prioridad']]; $txt="Desactivar";}
			else{$bgcolor="#BBBBBB"; $txt="Activar";}
			echo'<tr bgcolor='.$bgcolor.'>
						<td width=22% ><a href="CALconsulta.php?vista=dia&fecha='.$fecha.'&idevcal='.$fila['idevcal'].'">'.$fila['evento'].'</a></td>
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

			if($idevcal==$fila['idevcal']){echo'<tr> <td colspan=7  valign="top">'.$fila['comentarios'].'</td> </tr>';	}
			
			}			
	}
/***********************************************************************************************/
function vistasemana($fecha){
	$yearmes=explode("-",$fecha);
	$semana=date("W",strtotime($fecha));

	global $muestramesab; global $vista; global $muestrames; global $muestrasemana;global $hoy;
	
	$lunesant=date('Y-m-d', strtotime('Monday previous week'.$fecha));
	$lunessig=date('Y-m-d', strtotime('Monday next week'.$fecha));
	
	echo'<br><br>
		<table border=1 width=100% valign="middle">
		<tr bgcolor="#BCB3FA">
			<th colspan=2 > <a href="CALconsulta.php?fecha='.$lunesant.'&vista='.$vista.'"> << Anterior </a> </th>
			<th colspan=3 align="center"> SEMANA '.$semana.'  de '.$yearmes[0].'</th>
			<th colspan=2> <a href="CALconsulta.php?fecha='.$lunessig.'&vista='.$vista.'"> Siguiente >> </a> </th>
		</tr>
		<tr  bgcolor="#5967DE">';
		for($i=0;$i<7;$i++){
			echo'<th width=14% >'.$muestrasemana[$i].'</th>';
			}
				
	echo'</tr>';
	$marcatiempo=strtotime("Monday this week ".$fecha)-86400;//Corresponde a los segundos por dia 86400
	echo "<tr>";
	for($i=0;$i<7;$i++){		
		if($i==0){$bgcolor="#DDDDDD";}
		else{$bgcolor="#FFFFFF";	}
		$semana=date('Y-m-d',$marcatiempo);
		if($semana==$fecha){$bgcolor="#AAAAFF";}
		if($semana==$hoy){$bgcolor="#7DF785";}
		$marcatiempo+=86400;
		$texto=muestrames ($semana,1);
		
		$consulta=mysql_query("SELECT * FROM calendario WHERE fechainicio<='".$semana."' AND fechafin>='".$semana."'  
		AND idusuario='".$_SESSION['idpropcal']."'  ORDER BY fechainicio, fechafin, horainicio, horafin ASC");
		if(!$consulta){die("No pudimos conectar con CALENDARIO:".mysql_error());}
	
		echo '<td bgcolor="'.$bgcolor.'"  valign="top" height="300"> 
				<a href="CALconsulta.php?fecha='.$semana.'&vista=dia"><b>'.$texto.'</b></a>'; 
				
				if($_SESSION['idkrea']==$_SESSION['idpropcal']){ 
						echo'<br><small><a href="CALagregaForm.php?fecha='.$semana.'">agregar</a></small>';
						while($fila=mysql_fetch_array($consulta)){
							if(strtotime($fila['fechainicio'])<strtotime($semana)){$mhoraini="00:00:00";	}
							else{$mhoraini=$fila['horainicio'];}
							echo ' <br><br>
								<small><a href="CALelimina.php?idevcal='.$fila['idevcal'].'&fecha='.$fecha.'&vista='.$vista.'">:X:</a></small>
								<small><a href="CALmodifica.php?idevcal='.$fila['idevcal'].'&status='.$fila['status'].'&fecha='.$fecha.'&vista='.$vista.'">:R:</a></small>
								<small><a href="CALmodificaForm.php?idevcal='.$fila['idevcal'].'&fecha='.$fecha.'&vista='.$vista.'">:C:</a></small>
								<a href="CALconsulta.php?vista=evento&idevcal='.$fila['idevcal'].'">  '.$mhoraini.'<br>'.$fila['evento'].'</a>';
							}	
						}
					else{ 
						if($_SESSION['permisos']==ADMIN){echo'<br><small><a href="CALagregaForm.php?fecha='.$semana.'">agregar</a></small>';}
						while($fila=mysql_fetch_array($consulta)){
							if(strtotime($fila['fechainicio'])<strtotime($semana)){$mhoraini="00:00:00";	}
							else{$mhoraini=$fila['horainicio'];}
							echo '<br><br>
								<a href="CALconsulta.php?vista=evento&idevcal='.$fila['idevcal'].'">  '.$mhoraini.'<br>'.$fila['evento'].'</a>';
							}	
						}				
			
		echo'</td>';
		}
	echo "</tr>";
	}
/******************* Dibujamos la Tabla Vista por MES ************************************************/
 function vistames($fecha){
 
	global $vista; global $muestrames; global $muestrasemana;global $hoy;
 
	$yearmes=explode("-",$fecha);
	$fechao=$fecha;	
	$fecha=$yearmes[0]."-".$yearmes[1]."-1";	

	$diaprimero=(int)date("w",strtotime($fecha)); //Este es el primer dia del mes 0-> Domingo
	$numdiasmes=idate("t",strtotime($fecha));// Cantidad de dias del mes

	$mesanterior=date('Y-m-d', strtotime('previous month'.$fecha));
	$messiguiente=date('Y-m-d', strtotime('next month'.$fecha));
	
	echo'<br><br>
			<table border=1 width=100% valign="middle">
			<tr bgcolor="#BCB3FA">
				<th colspan=2 > <a href="CALconsulta.php?fecha='.$mesanterior.'&vista='.$vista.'"> << Anterior </a> </th>
				<th colspan=3 align="center"> '.$muestrames[(int)$yearmes[1]].'  '.$yearmes[0].'</th>
				<th colspan=2> <a href="CALconsulta.php?fecha='.$messiguiente.'&vista='.$vista.'"> Siguiente >> </a> </th>
			</tr>
			<tr bgcolor="#5967DE" >';
			for($i=0;$i<7;$i++){
				echo'<th width=14% >'.$muestrasemana[$i].'</th>';
				}
	echo'</tr>';

		$filas=1;$contdiames=0; $permiso=0; //	$hoy=date("Y-m-d");
		do{//Dibujamos la tabla deacuerdo a los datos
			echo'<tr>';
			for($contdiasemana=0;$contdiasemana<7;$contdiasemana++){
				if($contdiasemana==0){$bgcolor="#DDDDDD";}
				else{$bgcolor="#FFFFFF";	}
				if($contdiames>=$numdiasmes&&$contdiasemana==0){$filas=0;break;}
				if($contdiames>=$numdiasmes){$filas=0;echo'<td  valign="top" height="100" bgcolor="'.$bgcolor.'" width=14% > </td>';}
				else{
					if($contdiames){$permiso=1;}
					else{
						if($contdiasemana==$diaprimero){$permiso=1;}
						else{echo'<td  valign="top" height="100"  bgcolor="'.$bgcolor.'"  width=14% > </td>';}
							}
						}			
				if($permiso){
					$contdiames++; 
					$creafecha=$yearmes[0].'-'.$yearmes[1].'-'.$contdiames;
					$creafecha=date('Y-m-d', strtotime($creafecha));
					
					$consulta=mysql_query("SELECT * FROM calendario WHERE fechainicio<='".$creafecha."' AND fechafin>='".$creafecha."'  
					AND idusuario='".$_SESSION['idpropcal']."'  ORDER BY fechainicio, fechafin, horainicio, horafin ASC");
					if(!$consulta){die("No pudimos conectar con CALENDARIO:".mysql_error());}
						
					if($creafecha==$fechao){$bgcolor="#AAAAFF";}
					if($creafecha==$hoy){$bgcolor="#7DF785";}
					
					echo'<td  valign="top" height="100"  bgcolor="'.$bgcolor.'"  width=14% >
							<a href="CALconsulta.php?fecha='.$creafecha.'&vista=dia"><b>'.$contdiames.'</b></a>';
						
					if($_SESSION['idkrea']==$_SESSION['idpropcal']){ 
						echo'<small><a href="CALagregaForm.php?fecha='.$creafecha.'">agregar</a></small>';
						while($fila=mysql_fetch_array($consulta)){
							if(strtotime($fila['fechainicio'])<strtotime($creafecha)){$mhoraini="00:00:00";	}
							else{$mhoraini=$fila['horainicio'];}
							echo ' <br><br>
								<small><a href="CALelimina.php?idevcal='.$fila['idevcal'].'&fecha='.$fecha.'&vista='.$vista.'">:X:</a></small>
								<small><a href="CALmodifica.php?idevcal='.$fila['idevcal'].'&status='.$fila['status'].'&fecha='.$fecha.'&vista='.$vista.'">:R:</a></small>
								<small><a href="CALmodificaForm.php?idevcal='.$fila['idevcal'].'&fecha='.$fecha.'&vista='.$vista.'">:C:</a></small>
								<a href="CALconsulta.php?vista=evento&idevcal='.$fila['idevcal'].'">  '.$mhoraini.'<br> '.$fila['evento'].'</a>';
							}	
						}
					else{ 
						if($_SESSION['permisos']==ADMIN){echo'<small><a href="CALagregaForm.php?fecha='.$creafecha.'">agregar</a></small>';}
						while($fila=mysql_fetch_array($consulta)){
							if(strtotime($fila['fechainicio'])<strtotime($creafecha)){$mhoraini="00:00:00";	}
							else{$mhoraini=$fila['horainicio'];}
							echo '<br><br>
								<a href="CALconsulta.php?vista=evento&idevcal='.$fila['idevcal'].'">  '.$mhoraini.'<br> '.$fila['evento'].'</a>';
							}	
						}
					echo'</td>';	
					$permiso=0;	
					}
				}
			echo'</tr>';	
			}while($filas);

	echo'</table>';
	}
/***********************************************************************************************/
$conexion=conectabd("crmkrea");

$verotros=0;
switch($_SESSION['permisos']){
	case ADMIN: $verotros=1;  	break;
	case ENCARGADO: $verotros=1; break;	
	case JEFEPROD: $verotros=0; break;
	case VENTAS: $verotros=0; 	break;
	default: sinpermiso(1,1,1); break;
	}
	
if(isset($_SESSION['idpropcal'])){
	if(($_SESSION['permisos']==JEFEPROD||$_SESSION['permisos']==VENTAS)){	
		if($_SESSION['idpropcal']!=$_SESSION['idkrea']){$_SESSION['idpropcal']=$_SESSION['idkrea'];}	
		}
	}
else{
	$_SESSION['idpropcal']=$_SESSION['idkrea'];
	}
	
if(isset($_POST['propietario'])&&$verotros){
	$_SESSION['idpropcal']=$_POST['propietario'];
	$fecha=$_POST['fecha'];
	$vista=$_POST['vista'];
	$idevcal=$_POST['idevcal'];
	}
	
if($verotros){
	$consulta=mysql_query("SELECT  * FROM usuarios ORDER BY permisos ASC");
	if(!$consulta){	die("No accesamos a los RECADOS ERROR: ".mysql_error());}
		
		echo'<form method="POST" name="calendarios" id="calendarios">
				<select id="propietario" name="propietario">';   /* ID Vendedor asignado */
			while($fila=mysql_fetch_array($consulta)){
				if($fila['permisos']>VENTAS){break;}
				else{
					if($fila['status']==ACTIVO&&$fila['permisos']>=$_SESSION['permisos']){
						if($fila['idkrea']==$_SESSION['idpropcal']){echo' <option value="'.$fila['idkrea'].'" selected>'.$fila['usuario'].'</option>';}
						else{echo' <option value="'.$fila['idkrea'].'">'.$fila['usuario'].'</option>';}
						}
					}				
				}	
		echo'</select> 
			<input type="hidden" name="fecha" id="fecha" value="'.$fecha.'">
			<input type="hidden" name="vista" id="vista" value="'.$vista.'">
			<input type="hidden" name="idevcal" id="idevcal" value="'.$idevcal.'">
			<input type="submit" name="escoge" id="escoge" value="seleccionar">
			</form>
			';
		mysql_free_result($consulta);
	$verotros=0;	
	}

echo '
	<a href="CALconsulta.php?vista=lista&fecha='.$fecha.'"> << LISTA >> </a>
	<a href="CALconsulta.php?vista=dia&fecha='.$fecha.'"> << DIA >> </a>
	<a href="CALconsulta.php?vista=semana&fecha='.$fecha.'"> << SEMANA >> </a>
	<a href="CALconsulta.php?vista=mes&fecha='.$fecha.'"> << MES >> </a>
	<a href="CALconsulta.php?vista='.$vista.'&fecha='.$hoy.'"> << ACTUAL >> </a>
	';
switch($vista){
	case "lista":	vistalista($idevcal, 1);	break;
	case "dia": vistadia($fecha,$idevcal);	break;
	case "semana": vistasemana($fecha);	break;		
	case "mes":	vistames($fecha);	break;
	case "evento": vistalista($idevcal, 2);	break;			
	default: break;
	}
	
mysql_close($conexion);	
/*********************************************************************************************/
?>