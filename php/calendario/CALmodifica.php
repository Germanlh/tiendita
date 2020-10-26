<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado


$evento=$_POST['evento'];
$fechai=$_POST['fechai'];
$horai=$_POST['horai'];
$fechaf=$_POST['fechaf'];
$horaf=$_POST['horaf'];
$idcliente=$_POST['idcliente'];//Este no Cambia
$prioridad=$_POST['prioridad'];
$comentarios=$_POST['comentarios'];

$fecha=$_POST['fecha'];
$vista=$_POST['vista'];

if(isset($_GET['idevcal'])){// El estatus solo se puede modificar mediante GET
	$idevcal=$_GET['idevcal'];
	$status=$_GET['status'];
	$fecha=$_GET['fecha'];
	$vista=$_GET['vista'];
	switch($status){
		case ACTIVO:  $status=BAJA;	break;
		case BAJA: $status=ACTIVO; break;
		default: break;	
		}
	$peticion="UPDATE calendario SET status='".$status."' WHERE idevcal='".$idevcal."'";
	$permiso=1;
	}
else{	
	$idevcal=$_POST['idevcal'];
	$fechacomp=strtotime($fechai);
	$hoy=time();
	//evaluar el status
	if($fechacomp>=$hoy){$status=ACTIVO;}
	else{$status=BAJA;}
	$peticion="UPDATE calendario SET 
		status='".$status."', evento='".$evento."', fechainicio='".$fechai."', horainicio='".$horai."',	fechafin='".$fechaf."', 
		horafin='".$horaf."', comentarios='".$comentarios."', prioridad='".$prioridad."'
		WHERE idevcal='".$idevcal."'";
	$permiso=0;	
	}

/************** Seleccionamos la base de datos*****************************************************/
$conexion=conectabd("crmkrea");
$cont=0;$modform=0;
if($_SESSION['idkrea']==$_SESSION['idpropcal']&&$permiso==0){// Aqui revisamos si existe empalme o no
	
	$comfh1=strtotime($fechai.$horai);	/* O */
	$comfh2=strtotime($fechaf.$horaf); /* X */

	if($comfh2>$comfh1){$permiso=1;}
	else{$permiso=0; $mensaje="Location: CALagregaForm.php?mensaje=1&fecha=".$fecha."&vista=".$vista."&idevcal=".$idevcal."";}
			
	if($permiso){
		$consulta=mysql_query("SELECT * FROM calendario WHERE  idusuario='".$_SESSION['idpropcal']."'");
		if(!$consulta){die("Problemas para Ver CALENDARIO AGREGA".mysql_error());}
		while($fila=mysql_fetch_array($consulta)){
			
			$fihBD=strtotime($fila['fechainicio'].$fila['horainicio']); /*A*/
			$ffhBD=strtotime($fila['fechafin'].$fila['horafin']); /*B*/
			if($idevcal==$fila['idevcal']){$permiso=1;}	
			else{
				if($fihBD<=$comfh1){	// Revisa si hay Actividades empalmadas
					if($ffhBD<=$comfh1){$permiso=1;}
					else{$permiso=0;/*Existen empalmes*/}
					}
				else{
					if($comfh2<=$fihBD){$permiso=1;}
					else{$permiso=0;/*Existen empalmes*/}
					}	
				}
			if(!$permiso){	//Si existe un empalme $permiso=0
				//Aqui corroboramos la prioridad del Evento que vamos a agregar
				if($prioridad==1&&$fila['prioridad']!=1){
					$permiso=1;//El evento a insertar tiene mas prioridad, Insertar y Recalendarizar los En sitio
					$cont++;
					$idevcalarray[$cont]=$fila['idevcal'];
					}
				else{
					if($fila['prioridad']!=1){$permiso=1;}// No hay problemas con la prioridad, Insertar
					else{//El evento en sitio Tiene Mas prioridad, No insertar
						$permiso=0;
						$mensaje="Location: CALagregaForm.php?mensaje=2&fecha=".$fecha."&vista=".$vista."&idevcal=".$idevcal."";
						break;}//Al primer inconveniente Salgo del While
					}				
				}
			}//*Fin del While
		}
	}

if($permiso){
	$query=mysql_query($peticion);
	if(!$query){	die("No se puede Modificar al CALENDARIO PROBLEMAS: ".mysql_error());}
	

	if(isset($_SESSION['idevcalarray'])){
		if(!$cont){			
			foreach($_SESSION['idevcalarray'] as $i=>$valor){		
				if($idevcal==$valor){	unset($_SESSION['idevcalarray'][$i]);	}
				}
			if(!count($_SESSION['idevcalarray'])){	//Si ya no hay elementos borramos la variable Global y enviamos a consulta
				unset($_SESSION['idevcalarray']);//Nos dirigimos a CONSULTA
				$mensaje="Location: CALconsulta.php?&fecha=".$fecha."&vista=".$vista."";
				}
			else{$mensaje="Location: CALrecal.php?&fecha=".$fecha."&vista=".$vista."";}// Nos dirigimos a RECAL
			}	
		else{ $modform=1;}//Enviar a Mod Form
		
		}
	else{
		if(!$cont){$mensaje="Location: CALconsulta.php?&fecha=".$fecha."&vista=".$vista."";}
		else{//Enviar a RECAL
			$_SESSION['idevcalarray']=$idevcalarray;
			$mensaje="Location: CALrecal.php?fecha=".$fecha."&vista=".$vista."&idevcal=".$idevcal."";
			}
		}
	}	
else{$modform=1;}//Permiso=0 Mandar a Mod form con todas las variables
mysql_close($conexion);

if($modform){
	echo'
		<mark> Ya existen Otras actividades por favor cambie las fechas o reestructure nuevamente sus actividades despues de hacerlo con la lista previa</mark>
		<form method="POST" action="CALmodificaForm.php" name="recalmodform" id="recalmodform">
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
else{header ($mensaje);}

/************************************************************************/
?>