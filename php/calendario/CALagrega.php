<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

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

$idusuario=$_SESSION['idpropcal'];
$status=ACTIVO;
$idevcal=generaid($evento,$_SESSION['usuario']);

/************** Seleccionamos la base de datos*****************************************************/
$conexion=conectabd("crmkrea");
$permiso=0;$cont=0;

if(($_SESSION['idkrea']==$_SESSION['idpropcal'])||($_SESSION['permisos']==ADMIN)){

	$comfh1=strtotime($fechai.$horai);	/* O */
	$comfh2=strtotime($fechaf.$horaf); /* X */

	if($comfh2>$comfh1){$permiso=1;}
	else{$permiso=0; $mensaje="Location: CALagregaForm.php?mensaje=1&fecha=".$fecha."&vista=".$vista."&idevcal=".$idevcal."";}
			
	if($permiso){
		$consulta=mysql_query("SELECT * FROM calendario WHERE idusuario='".$_SESSION['idpropcal']."'");
		if(!$consulta){die("Problemas para Ver CALENDARIO AGREGA".mysql_error());}
		while($fila=mysql_fetch_array($consulta)){
			$fihBD=strtotime($fila['fechainicio'].$fila['horainicio']); /*A*/
			$ffhBD=strtotime($fila['fechafin'].$fila['horafin']); /*B*/
				
			if($fihBD<=$comfh1){	// Revisa si hay Actividades empalmadas
				if($ffhBD<=$comfh1){$permiso=1;}
				else{$permiso=0;/*Existen empalmes*/}
				}
			else{
				if($comfh2<=$fihBD){$permiso=1;}
				else{$permiso=0;/*Existen empalmes*/}
				}	
			if(!$permiso){	//Si existe un empalme $permiso=0
				//Aqui corroboramos la prioridad del Evento que vamos a agregar
				if($prioridad==1&&$fila['prioridad']!=1){
					$permiso=1;
					$cont++;
					$idevcalarray[$cont]=$fila['idevcal'];
					}
				else{
					if($fila['prioridad']!=1){$permiso=1;}
					else{$permiso=0;break;}//Enviamos los datos a CALmodificaForm
					}				
				}
			}//*Fin del While
		}
	}
else{$permiso=0;}

if($permiso){
	$query=mysql_query("
		INSERT INTO calendario (
		idusuario, idcliente, status, evento, fechainicio, horainicio, fechafin, horafin, comentarios, prioridad, idevcal)
		VALUES(
		'".$idusuario."', '".$idcliente."', '".$status."', '".$evento."', '".$fechai."', '".$horai."', '".$fechaf."', 
		'".$horaf."', '".$comentarios."', '".$prioridad."', '".$idevcal."')");
	if(!$query){	die("No se puede Agregar al Directorio PROBLEMAS: ".mysql_error());	}
	$mensaje="Location: CALconsulta.php?fecha=".$fecha."&vista=".$vista."&idevcal=".$idevcal."";
	
	if($cont){
		$_SESSION['idevcalarray']=$idevcalarray;
		$mensaje="Location: CALrecal.php?fecha=".$fecha."&vista=".$vista."&idevcal=".$idevcal."";
		}
	}
else{ //Nos vamos a CALmodifica 
	echo'
		<mark> Ya existen Otras actividades de mayor Prioridad ubicada en este periodo Por favor corrija las fechas</mark>
		<form method="POST" action="CALagregaForm.php" name="recalmodform" id="recalmodform">
			<input type="hidden" name="evento" id="evento" value="'.$evento.'">
			<input type="hidden" name="fechai" id="fechai" value="'.$fechai.'">			
			<input type="hidden" name="horai" id="horai" value="'.$horai.'">			
			<input type="hidden" name="fechaf" id="fechaf" value="'.$fechaf.'">			
			<input type="hidden" name="horaf" id="horaf" value="'.$horaf.'">			
			<input type="hidden" name="idcliente" id="idcliente" value="'.$idcliente.'">			
			<input type="hidden" name="prioridad" id="prioridad" value="'.$prioridad.'">			
			<input type="hidden" name="comentarios" id="comentarios" value="'.$comentarios.'">			
			<input type="hidden" name="idevcal" id="idevcal" value="'.$idevcal.'">			
			
			<input type="hidden" name="fecha" id="fecha" value="'.$fecha.'">			
			<input type="hidden" name="vista" id="vista" value="'.$vista.'">			
			<input type="submit"  name="enviar" id="enviar" value="Enviar" >
		</form>
		';
	}

/********************************************************************************************/
mysql_close($conexion);	
@header ($mensaje);
?>




