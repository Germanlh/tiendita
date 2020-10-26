<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

$usr=$_POST['usr'];
$psw=$_POST['psw'];
$psw2=$_POST['psw2'];
$permisos=$_POST['permisos']; /* Tipo de usuario*/
	
$acceso=0;//inicializamos las variables para lograr que no exista acceso alguno
$pagina="../index.php";//inicializamos las variables para lograr que no exista acceso alguno
$mensaje="";//inicializamos las variables para lograr que no exista acceso alguno

switch($_SESSION['permisos']){
	case ADMIN:
		if($permisos>=ADMIN && $permisos<=TALLER){	$acceso=1;}
		$pagina="USRgestionAd.php";
		break;
	case ENCARGADO:
		if($psw==$psw2 && $permisos>=ENCARGADO && $permisos<=TALLER){$acceso=1;}
		$pagina="USRagrega1.php";
		break;
	default: 
		sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
		break;
	}

if($acceso){//solo si se permite el acceso
		
	/************** Seleccionamos la base de datos*****************************************************/
	$conexion=conectabd("crmkrea");
	/***************Primero Verificar si no existe el registro************************************************/
	$repeticiones=0;//Buscamos la existencia de un usuario repetido
	$usr=strtolower($usr);
	$consulta=mysql_query("SELECT  * FROM usuarios WHERE usuario='$usr'");
	while($fila=mysql_fetch_array($consulta)){
		if($fila['usuario']==$usr){$repeticiones++;}
		}
	if($repeticiones==0){//si no existe entonces agregamos el registro
		$idkrea="incompleto";
		$status=ACTIVO; 
		//$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$query=mysql_query(
			"INSERT INTO 
			usuarios (idkrea,status,usuario, password, permisos)
			VALUES ('$idkrea','$status','$usr', '$psw', '$permisos')
			");
		if(!$query){
			die("No se puede Agregar al USUARIO PROBLEMAS: ".mysql_error());
			echo "<br><a href=".$pagina."> << Regresar </a>";
			}
		$mensaje="?mensaje=1";//Registro Exitoso
		}
	else{$mensaje="?mensaje=2";}// El Usuario ya existia 
	/********** Cerramos la base de datos ************************************************************/
	mysql_close($conexion);	
	}
else{$mensaje="?mensaje=3";}//Incongruencia en los datos vuelva a los datos  // Si no coinciden las password o el tipo Cerramos y regresamos a la pagina
	
header ("Location: ".$pagina.$mensaje);	
?>




