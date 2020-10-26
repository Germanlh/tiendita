<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

$emisor= $_POST['emisor'];
$iddestinatario= $_POST['destinatario'];
$tipo=$_POST['tipo'];
$mensaje =$_POST['mensaje'];
$tel=$_POST['tel'];
$empresa=$_POST['empresa'];

$idreceptor= $_SESSION['idkrea']; 
$status = ACTIVO; 
$fecha =date("Y-m-d H:i:s");
$idrecado=generaid($iddestinatario,$idreceptor);

/************** Seleccionamos la base de datos*****************************************************/
$conexion=conectabd("crmkrea");
/***************Primero Verificar si no existe el registro************************************************/

$query=mysql_query("
		INSERT INTO recados (iddestinatario, idreceptor, emisor, fecha, tipo, mensaje, tel, empresa, status, idrecado)
		VALUES('$iddestinatario', '$idreceptor', '$emisor',  '$fecha', '$tipo', '$mensaje', '$tel', '$empresa', '$status', '$idrecado')
		");
	if(!$query){	die("No se puede Agregar Recados PROBLEMAS: ".mysql_error());}
	
/********** Cerramos la base de datos ************************************************************/
mysql_close($conexion);	

header ("Location: RECagregaForm.php?mensaje=1");	
/*****************************************************************************************************/
?>




