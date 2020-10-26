<?php 
/*******************************************/
if(isset($_POST['enviar'])){
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
}
else{
	$usr="";
	$psw="";
}

if($usr=="xito" && $psw=="123"){
	session_start();
	$_SESSION['activo']=true;
	$_SESSION['usr']=$usr;
	header("Location:../prueba.php");
}
else{
	header("Location:../../index.php?mensaje=2");
}

/********************************************************************************************
include("../funciones.php");



//inicializo las variables con datos inutiles que me permitiran evaluar si se accedio o no
$_SESSION['idkrea']="0000000000000";
$pswbd=$usrbd=$_SESSION['usuario']="00000000000000";
$status=$_SESSION['permisos']=0;
$destino="Location: ../principal.php";

/************** conectamos a la BD**************
$conexion=conectabd("crmkrea");
/**********************************************************************************
$usr=strtolower($usr);// todos los usuarios se escriben en minusculas
$consulta=mysql_query("SELECT  * FROM usuarios WHERE usuario='$usr'");
while($fila=mysql_fetch_array($consulta)){
	if($fila['usuario']==$usr&&$fila['password']==$psw&&$fila['status']==ACTIVO){
		if($fila['idkrea']=="incompleto"){$destino="Location: ../directorio/DIRagregaForm.php";	}
		$_SESSION['idkrea']=$fila['idkrea'];// Si existe asignamos variables encontradas
		$usrbd=$_SESSION['usuario']=$fila['usuario'];
		$pswbd=$fila['password'];	//$_SESSION['password']=$fila['password'];
		$status=$fila['status'];			//$_SESSION['status']=$fila['status'];
		$_SESSION['permisos']=$fila['permisos'];
		}
	}
mysql_close($conexion);//cerramos la base de datos
	
if($usrbd==$usr&&$pswbd==$psw&&$status==ACTIVO){
	//definimos la hora que entro como aaaa-mm-dd hh:mm:ss
	/*Vamos a controlar el uso de la session para que despues de 10 minutos de inactividad se cierre automaticamente*
	$_SESSION['horaacceso']=date("Y-n-j H:i:s");
	header ($destino);	
	}
else{ sinpermiso(1,2,0);	}// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
/************************************************/
?>
