<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	$psw2 = $_POST['psw2'];
	$status = $_POST['status'];
	$permisos = $_POST['permisos'];

	$oldusr=$_SESSION['oldusr'];
	$oldidkrea=$_SESSION['oldidkrea'];
	
	$_SESSION['oldusr']="nada";
	$_SESSION['oldidkrea']="nada";

/************** conectamos a la BD**************/
	$conexion=conectabd("crmkrea");
	
	if($_SESSION['permisos']==ADMIN&&$oldidkrea!=$_SESSION['idkrea']){
		$consulta="UPDATE usuarios SET 
				usuario='".$usuario."', password= '".$password."', status='".$status."', permisos='".$permisos."'
				WHERE usuario='".$oldusr."' AND idkrea='".$oldidkrea."'";
		}
	if($oldidkrea==$_SESSION['idkrea']){	
		if($password==$psw2){		
			$_SESSION['usuario']=$usuario;
			$consulta="UPDATE usuarios SET 
				usuario='".$usuario."', password= '".$password."'
				WHERE usuario='".$oldusr."' AND idkrea='".$_SESSION['idkrea']."'";
			}
		else{header ("Location: USRmodForm.php");	}
		}	
		
	$query=mysql_query($consulta);
	if(!$query){die("No pudimos actualizar".mysql_error());}
	
	mysql_close($conexion);
	
	if($_SESSION['permisos']==ADMIN){
		header ("Location: USRgestionAd.php?mensaje=4");
		}
	else{ redirige(1);}


?>