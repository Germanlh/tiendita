<?php
/*********************************************************** */
include("../sesion.php");

/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_GET['id'])){
	$id_prod=$_GET['id'];

	/************** conectamos a la BD *******************************/
	include("../conectadb.php");
	/*** Consultamos el usuario y psw ********************************* */
			
		$sql= "DELETE FROM producto WHERE id_producto='".$id_prod."'";
	
		if ($cnxdb->query($sql) === TRUE){
			header("Location:../tiendita.php?op=2&mensaje=6");//Borrado Exitoso
		}//Eliminacion exitoso 
		else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
	}
	
	/** Liberamos resultado y cerramos BD *************************  */
	$cnxdb->close();//cerramos la base de datos
	
/************************************************************* */
?>
