<?php
/*********************************************************** */
include("../sesion.php");

/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_POST['enviar'])){
	$verpsw=$_POST['verpsw'];
	//echo " VerPsw=[".$verpsw."]<br>";
	//echo "Old USR:".$_SESSION['usr']." Old Nom: ".$_SESSION['nombre']."<br>";
	//echo "BDusr:".$fila['mail']." BDpsw: ".$fila['psw']."<br>";
	/************** conectamos a la BD *******************************/
	include("../conectadb.php");
	/*** Consultamos el usuario y psw ********************************* */
	$sql = "SELECT mail, psw FROM usuarios WHERE mail='".$_SESSION['usr']."'";
	$resultado=$cnxdb->query($sql);
	$fila=$resultado->fetch_array(MYSQLI_BOTH);
	/** Verificamos si Corresponde ****************************** */
	if(password_verify($verpsw, $fila['psw'])){
		
		$sql= "DELETE FROM usuarios WHERE mail='".$_SESSION['usr']."'";
	
		if ($cnxdb->query($sql) === TRUE){
			include("../../cerrarsesion.php");
		}//Eliminacion exitoso 
		else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
	}
	else{// NO Existe Coincidencia
		header("Location:../../index.php?mensaje=6");//No se realizo el cambio
		}
		/** Liberamos resultado y cerramos BD *************************  */
		$resultado->free();
		$cnxdb->close();//cerramos la base de datos
		/************************************************************** */
}
/************************************************************* */
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Eliminamos Cuenta</title>
</head>
<body>
	<h2>Para Eliminar tu cuenta por favor vcerifica tu contraseña</h2>
	<form method="POST" action="USRelimina.php" id="elimina_frm" name="elimina_frm" enctype="application/x-www-form-urlencoded">

		<input type="password" name="verpsw" id="verpsw" placeholder="Verifica tu Contraseña" required />

		<input type="submit" id="enviar" name="enviar" value="Accesar">

	</form>

</body>
</html>
