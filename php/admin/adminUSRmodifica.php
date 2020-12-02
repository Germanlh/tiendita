<?php
include("../sesion.php");

/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_POST['enviar'])){
    $usr=$_POST['usr'];
    $nom=$_POST['nombre'];
	$psw=$_POST['psw'];
    $conpsw=$_POST['conpsw'];
    $permisos=$_POST['permisos'];
}

if($psw==$conpsw&&($permisos>=1&&$permisos<=2)){//Ambos psw coinciden
	/************** conectamos a la BD *******************************/
	include("../conectadb.php");

		$psw=password_hash($psw, PASSWORD_DEFAULT);//Generamos la encriptacion del psw
		$sql= "UPDATE usuarios SET mail='".$usr."',psw='".$psw."',nombre='".$nom."',permisos='".$permisos."' WHERE mail='".$usr."'";
		if ($cnxdb->query($sql) === TRUE){header("Location:../tiendita.php?op=1&mensaje=1");}//Registro exitoso 
		else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
	
	$cnxdb->close();//cerramos la base de datos

}else{
	header("Location:../tiendita.php?op=1&mensaje=5");//No se realizo registro PSW no coincide
}





?>