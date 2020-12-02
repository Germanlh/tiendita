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

/************** conectamos a la BD *******************************/
include("../conectadb.php");

/*** Consultamos el usuario y psw ********************************* */

/** Verificamos si Corresponde ****************************** */
if($psw==$conpsw){
	$psw=password_hash($psw, PASSWORD_DEFAULT);//Generamos la encriptacion del psw
	
	$sql= "UPDATE usuarios SET mail='".$usr."',psw='".$psw."',nombre='".$nom."',permisos='".$permisos."' WHERE mail='".$usr."'";

	if ($cnxdb->query($sql) === TRUE){
		header("Location:adminUSR.php?mensaje=1");
	}//Registro exitoso 
	else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
}
else{// NO Existe Coincidencia
	header("Location:adminUSR.php?mensaje=2");//No se realizo el cambio
	}

/** Liberamos resultado y cerramos BD *************************  */
$cnxdb->close();//cerramos la base de datos
/************************************************************** */
?>