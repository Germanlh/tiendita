<?php
include("../sesion.php");

/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_POST['enviar'])){
	$verpsw=$_POST['verpsw'];
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
	$nom=$_POST['nombre'];
	$conpsw=$_POST['conpsw'];

	if($psw==$conpsw){

		/************** conectamos a la BD *******************************/
		include("../conectadb.php");
		/*** Consultamos el usuario y psw ********************************* */
		$sql = "SELECT mail, psw FROM usuarios WHERE mail='".$_SESSION['usr']."'";
		$resultado=$cnxdb->query($sql);
		$fila=$resultado->fetch_array(MYSQLI_BOTH);

		echo "BDusr:".$fila['mail']." BDpsw: ".$fila['psw']."<br>";
		/** Verificamos si Corresponde ****************************** */
		if(password_verify($verpsw, $fila['psw'])){
			$psw=password_hash($psw, PASSWORD_DEFAULT);//Generamos la encriptacion del psw
			
			$sql= "UPDATE usuarios SET mail='".$usr."',psw='".$psw."',nombre='".$nom."' WHERE mail='".$_SESSION['usr']."'";

			if ($cnxdb->query($sql) === TRUE){
				session_start();
				session_unset();
				session_destroy();
				header("Location:../../index.php?mensaje=5");
			}//Registro exitoso 
			else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
		}
		else{// NO Existe Coincidencia
			header("Location:../../index.php?mensaje=6");//No se realizo el cambio
			}

		/** Liberamos resultado y cerramos BD *************************  */
		$resultado->free();
		$cnxdb->close();//cerramos la base de datos
		/************************************************************** */



		
	}else{
		header("Location:../../index.php?mensaje=7");//psw no coinciden
	}



}/* Primer IFisset */

?>