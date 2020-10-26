<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

if($_SESSION['permisos']==ADMIN){

	$usr=$_GET['usuario'];
	$idkrea=$_GET['idkrea'];
	
	/************** Conectamos  a la Base de datos **********************************/
	$conexion=conectabd("crmkrea");
	
	/************** Realizamos el Borado ******************************************/

	$consulta=mysql_query("DELETE FROM usuarios WHERE usuario='$usr' AND idkrea='$idkrea'");
	if(!$consulta){die("No se ha podido eliminar el registro".mysql_error());}

	/********** Cerramos la base de datos ******************************/
	mysql_close($conexion);
	header ("Location: USRgestionAd.php?mensaje=5");//Regresamos a la gestion de usuarios
	
}
else{sinpermiso(1,1,1);}// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

?>