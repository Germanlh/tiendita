<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

$idevcal=$_GET['idevcal'];
$fecha=$_GET['fecha'];
$vista=$_GET['vista'];
/************** Conectamos  a la Base de datos **********************************/

if($_SESSION['idkrea']==$_SESSION['idpropcal']){
	$conexion=conectabd("crmkrea");
	$consulta=mysql_query("DELETE FROM calendario WHERE idevcal='".$idevcal."'");
	if(!$consulta){die("No se ha podido eliminar el registro".mysql_error());}
	mysql_close($conexion);	
	}

/*Evaluamos si existe la variable, Si no existe nos movemos normal si existe Recalendarizamos*/
if(isset($_SESSION['idevcalarray'])){
	foreach($_SESSION['idevcalarray'] as $i=>$valor){		
		if($idevcal==$valor){	unset($_SESSION['idevcalarray'][$i]);	}
		}
	$cont=count($_SESSION['idevcalarray']);
	if(!$cont){	//Si ya no hay elementos borramos la variable Global y enviamos a consulta
		unset($_SESSION['idevcalarray']);//Nos dirigimos a CONSULTA
		$mensaje="Location: CALconsulta.php?&fecha=".$fecha."&vista=".$vista."";
		}
	else{$mensaje="Location: CALrecal.php?&fecha=".$fecha."&vista=".$vista."";}// Nos dirigimos a RECAL
	}
else{$mensaje="Location: CALconsulta.php?&fecha=".$fecha."&vista=".$vista."";}

header ($mensaje);
?>