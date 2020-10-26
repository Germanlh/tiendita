<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

$idrecado=$_GET['idrecado'];

	/************** Conectamos  a la Base de datos **********************************/
	$conexion=conectabd("crmkrea");
	$consulta=mysql_query("SELECT * FROM recados WHERE idrecado='$idrecado' ");	
	if(!$consulta){die("No pudimos accesar a RECADOS: ".mysql_error());}
	
	$permiso=0;
	while($fila=mysql_fetch_array($consulta)){
		if($fila['iddestinatario']==$_SESSION['idkrea']){$permiso=1;}
		}	
	
	if($permiso==1){
		/************** Realizamos el Borado ******************************************/
		$consulta2=mysql_query("DELETE FROM recados WHERE idrecado='$idrecado'");
		if(!$consulta2){die("No se ha podido eliminar el registro".mysql_error());}
		}
	/********** Cerramos la base de datos ******************************/
	mysql_close($conexion);	
header ("Location: RECconsulta.php");//Regresamos a la gestion de usuarios	
?>