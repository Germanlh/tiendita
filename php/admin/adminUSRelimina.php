<?php
/*********************************************************** */
include("../sesion.php");

/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_GET['mail'])){
	$usr=$_GET['mail'];

	/************** conectamos a la BD *******************************/
	include("../conectadb.php");
	/*** Consultamos el usuario y psw ********************************* */
			
		$sql= "DELETE FROM usuarios WHERE mail='".$usr."'";
	
		if ($cnxdb->query($sql) === TRUE){
			header("Location:adminUSR.php");//Borrado Exitoso
		}//Eliminacion exitoso 
		else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
	}
	
	/** Liberamos resultado y cerramos BD *************************  */
	$cnxdb->close();//cerramos la base de datos
	
/************************************************************* */
?>
