<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

	$nombres=$_GET['nombres'];
	$idcliente=$_GET['idcliente'];
	/************** Conectamos  a la Base de datos **********************************/
	$conexion=conectabd("crmkrea");
	$consulta=mysql_query("SELECT * FROM directorio WHERE nombres='$nombres' AND idcliente='$idcliente'");	
	while($fila=mysql_fetch_array($consulta)){
		if($fila['nombres']==$nombres&&$fila['idcliente']==$idcliente){$idvendedor=$fila['idvendedor'];$tipo=$fila['tipo'];}
		}	
	mysql_close($conexion);	
	$permiso=0;
	switch($_SESSION['permisos']){
		case ADMIN: $permiso=1; break;
		case ENCARGADO:
			if($tipo==CLIENTE&&$idvendedor==CLIMOS){$permiso=1;}
			else{$permiso=0;}
			break;
		case VENTAS:
			if($tipo==CLIENTE&&$idvendedor==$_SESSION['idkrea']){$permiso=1;}
			else{$permiso=0;}
			break;
		default:$permiso=0;break;	
		}
	if($permiso==1){
		/************** Realizamos el Borado ******************************************/
		$consulta=mysql_query("DELETE FROM directorio WHERE nombres='$nombres' AND idcliente='$idcliente'");
		if(!$consulta){die("No se ha podido eliminar el registro".mysql_error());}
		}
	/********** Cerramos la base de datos ******************************/
	
	header ("Location: DIRconsulta.php?mensaje=2");//Regresamos a la gestion de usuarios
?>