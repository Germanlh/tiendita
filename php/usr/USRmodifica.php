<?php
include("../sesion.php");

echo "Eliminamos usuario";
/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_POST['enviar'])){
	$verpsw=$_POST['verpsw'];
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
	$nom=$_POST['nombre'];
}
else{
	$usr="";
	$psw="";
	$nom="";
}
//echo "New USR:".$usr." NewNom: ".$nom."<br>";
//echo "Old USR:".$_SESSION['usr']." Old Nom: ".$_SESSION['nombre']."<br>";
/************** conectamos a la BD *******************************/
include("../conectadb.php");
/*** Consultamos el usuario y psw ********************************* */
$sql = "SELECT mail, psw FROM usuarios WHERE mail='".$_SESSION['usr']."'";
$resultado=$cnxdb->query($sql);
$fila=$resultado->fetch_array(MYSQLI_BOTH);

/** Verificamos si Corresponde ****************************** */
if (empty($fila)){//No existe coincidencia con usr Insertamos en la BD

	$psw=password_hash($psw, PASSWORD_DEFAULT);//Generamos la encriptacion del psw
	$sql= "INSERT INTO usuarios (mail,psw,nombre, permisos)
			VALUES ('".$usr."','".$psw."','".$nom."', 2)
			";
	if ($cnxdb->query($sql) === TRUE){header("Location:../../index.php?mensaje=3");}//Registro exitoso 
	else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
}
else{//Existe Coincidencia
	header("Location:../../index.php?mensaje=4");//No se realizo registro
	}
/******************************************************** *
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

/************** conectamos a la BD**************
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

/************************************************************** */
?>