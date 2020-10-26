<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

$status=$_POST['status'];
$tipo=$_POST['tipo'];
$idempresa=$_POST['empresa'];

$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$callenum=$_POST['callenum'];
$colonia=$_POST['colonia'];
$ciudad=$_POST['ciudad'];
$estado=$_POST['estado'];
$cp=$_POST['cp'];

$tel1=$_POST['tel1'];
$tel2=$_POST['tel2'];
$cel=$_POST['cel'];
$email1=$_POST['email1'];
$email2=$_POST['email2'];
$idvendedor=$_POST['vendedor'];

$oldnombres=$_SESSION['oldusr'];
$oldidcliente=$_SESSION['oldidkrea'];
	
$_SESSION['oldusr']="nada";
$_SESSION['oldidkrea']="nada";


/************** Seleccionamos la base de datos*****************************************************/
$conexion=conectabd("crmkrea");
/***************Primero Verificar si no existe el registro************************************************/
	$permiso=0;
	if($oldidcliente==$_SESSION['idkrea']&&$oldnombres=="empleado"){// si el cliente soy yo puedo modificar mis datos 
		$permiso=1;
		$consulta=mysql_query("SELECT * FROM directorio WHERE idcliente='".$oldidcliente."'");
		if(!$consulta){die("No accesamos a DIRECTORIO ERROR: ".mysql_error());}
		while($fila=mysql_fetch_array($consulta)){
			if($fila['idcliente']==$oldidcliente){$oldnombres=$fila['nombres'];}
			}
		}		
	else{
		$consulta=mysql_query("SELECT * FROM directorio WHERE nombres='$oldnombres' AND idcliente='$oldidcliente'");	
		while($fila=mysql_fetch_array($consulta)){
			if($fila['nombres']==$oldnombres&&$fila['idcliente']==$oldidcliente){$idvendedor=$fila['idvendedor'];$tipo=$fila['tipo'];}
			}	
			$permiso=0;
			switch($_SESSION['permisos']){
				case ADMIN: $permiso=1; break;
				case ENCARGADO:
					if(($tipo==PROVEEDOR||$tipo==TERCERO)||$tipo==MAQUILADOR){$permiso=1;}
					else{$permiso=0;}
					if($tipo==CLIENTE&&$idvendedor==CLIMOS){$permiso=1;}
					else{$permiso=0;}
					break;
				case VENTAS:
					if($tipo==CLIENTE&&$idvendedor==$_SESSION['idkrea']){$permiso=1;}
					else{$permiso=0;}
					break;
				case MOSTRADOR:
					if($tipo==CLIENTE&&$idvendedor==CLIMOS){$permiso=1;}
					else{$permiso=0;}
					break;
				case JEFEPROD:
					if($tipo==CLIENTE&&$idvendedor==CLIMOS){$permiso=1;}
					else{$permiso=0;}
					break;
				default:$permiso=0;break;	
				}
		}
	if($permiso==1){
		/************** Realizamos el Borado ******************************************/	
		$peticion="UPDATE directorio SET
			status='".$status."', tipo='".$tipo."', idempresa='".$idempresa."', 
			nombres='".$nombres."', apellidos='".$apellidos."', direccion='".$callenum."', colonia='".$colonia."', 
			ciudad='".$ciudad."', estado='".$estado."', codpos='".$cp."', tel1='".$tel1."', tel2='".$tel2."', 
			cel='".$cel."', email1='".$email1."', email2='".$email2."', idvendedor='".$idvendedor."'
			WHERE nombres='".$oldnombres."' AND idcliente='".$oldidcliente."'";
					
		$query=mysql_query($peticion);
		if(!$query){	die("No se puede Modificar al Directorio PROBLEMAS: ".mysql_error());}
		}
		
/********** Cerramos la base de datos ************************************************************/
mysql_close($conexion);	

header ("Location: DIRconsulta.php?mensaje=1");//Regresamos a la gestion de usuarios

/************************************************************************
/************************************************************************/
?>