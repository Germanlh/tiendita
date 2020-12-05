<?php 
/***Recibimos variables para Validar usuario **********************/
if(isset($_POST['enviar'])){
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
}
else{
	$usr="";
	$psw="";
}

/************** conectamos a la BD *******************************/
include("../conectadb.php");

/*** Consultamos el id y psw ********************************* */
$sql = "SELECT mail, psw, nombre, permisos FROM usuarios WHERE mail='".$usr."'";
$resultado=$cnxdb->query($sql);
$fila=$resultado->fetch_array(MYSQLI_BOTH);

/** Verificamos si Corresponde ****************************** */
if (empty($fila)){//No existe coincidencia con id
	header("Location:../../index.php?mensaje=1");
}
else{//Existe Coincidencia
	//Usamos password_verify($psw,$hash) para revisar concordancias con el password encriptado
	if($fila['mail']==$usr&&password_verify($psw, $fila['psw'])){//Verifica que coincidan ambos atributos para iniciar sesión y permitir accesos
		session_start();
		$_SESSION['activo']=true;
		$_SESSION['usr']=$usr;
		$_SESSION['nombre']=$fila['nombre'];
		$_SESSION['permisos']=$fila['permisos'];
		$_SESSION['horaacceso']=date("Y-m-d H:i:s");
		/* Si permisos =1 ventana Admin permisos =2 Tienda */
		header("Location:../tiendita.php");
		}
	else{//No Coincide el Password y regresamos
		header("Location:../../index.php?mensaje=2");
	}
} 
/** Liberamos resultado y cerramos BD *************************  */
$resultado->free();
$cnxdb->close();//cerramos la base de datos

/*****************************************************************/
?>
