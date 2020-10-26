<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

$idrecado=$_GET['idrecado'];
$status=$_GET['status'];

switch($status){
	case ACTIVO:  $status=BAJA;	break;
	 case BAJA: $status=ACTIVO; break;
	default: break;	
	}

/************** Seleccionamos la base de datos*****************************************************/
$conexion=conectabd("crmkrea");
/***************Primero Verificar si no existe el registro************************************************/

$query=mysql_query("UPDATE recados SET status='".$status."' WHERE idrecado='".$idrecado."'");
if(!$query){	die("No se puede Modificar al RECADO PROBLEMAS: ".mysql_error());}
	
/********** Cerramos la base de datos ************************************************************/
mysql_close($conexion);	
header ("Location: RECconsulta.php");//Regresamos a la gestion de usuarios
/************************************************************************
/************************************************************************/
?>