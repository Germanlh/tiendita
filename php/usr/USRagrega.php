<?php
/************************************************************************** */
/***Recibimos variables para Validar usuario **********************/
if(isset($_POST['enviar'])){
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
	$nom=$_POST['nombre'];
}
else{
	$usr="";
	$psw="";
	$nom="";
}
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
			VALUES ('".$usr."','".$psw."','".$nom."', 2)
			";
	if ($cnxdb->query($sql) === TRUE){header("Location:../../index.php?mensaje=3");}//Registro exitoso 
	else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
}
else{//Existe Coincidencia
	header("Location:../../index.php?mensaje=4");//No se realizo registro
	}
 
/** Liberamos resultado y cerramos BD *************************  */
$resultado->free();
$cnxdb->close();//cerramos la base de datos
/************************************************************************ */
?>




