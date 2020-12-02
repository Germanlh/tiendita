<?php
/************************************************************************** */
/***Recibimos variables para Validar usuario **********************/
if(isset($_POST['enviar'])){
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
	$nom=$_POST['nombre'];
    $conpsw=$_POST['conpsw'];
    $permisos=$_POST['permisos'];
}
else{
	$usr="";
	$psw="";
	$nom="";
	$conpsw="";
}

if($psw==$conpsw&&($permisos>=1&&$permisos<=2)){//Ambos psw coinciden
	/************** conectamos a la BD *******************************/
	include("../conectadb.php");

	/*** Consultamos el usuario y psw ********************************* */
	$sql = "SELECT mail FROM usuarios WHERE mail='".$usr."'";
	$resultado=$cnxdb->query($sql);
	$fila=$resultado->fetch_array(MYSQLI_BOTH);

	/** Verificamos si Corresponde ****************************** */
	if (empty($fila)){//No existe coincidencia con usr Insertamos en la BD

		$psw=password_hash($psw, PASSWORD_DEFAULT);//Generamos la encriptacion del psw
		$sql= "INSERT INTO usuarios (mail,psw,nombre, permisos)
				VALUES ('".$usr."','".$psw."','".$nom."', ".$permisos.")
				";
		if ($cnxdb->query($sql) === TRUE){header("Location:adminUSR.php?mensaje=4");}//Registro exitoso 
		else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
	}
	else{//Existe Coincidencia
		header("Location:adminUSR.php?mensaje=3");//Usuario Existente
		}
	/** Liberamos resultado y cerramos BD *************************  */
	$resultado->free();
	$cnxdb->close();//cerramos la base de datos

}else{
	header("Location:adminUSR.php?mensaje=5");//No se realizo registro PSW no coincide
}

/************************************************************************ */
?>