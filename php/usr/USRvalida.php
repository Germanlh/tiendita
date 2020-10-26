<?php 
/***Recibimos variables ****************************************/
if(isset($_POST['enviar'])){
	$usr=$_POST['usr'];
	$psw=$_POST['psw'];
}
else{
	$usr="";
	$psw="";
}
$usr=strtolower($usr);// todos los usuarios se escriben en minusculas
/************** conectamos a la BD**************/
$serverdb = "localhost";
$usrdb = "xito";
$pswdb = "g2r4*2YL1";
$db="tiendita";

$cnxdb= new mysqli($serverdb, $usrdb, $pswdb,$db);//Conexion Base de datos
if($cnxdb->connect_error){die("No se ha establecido la Conexion"); exit();}

/** Seleccionamos la BD ************************************ */
$cnxdb->select_db("tiendita");

/*** Consultamos el id y psw ********************************* */
$sql = "SELECT id, psw FROM usuarios WHERE id='".$usr."'";
$resultado=$cnxdb->query($sql);
$fila=$resultado->fetch_array(MYSQLI_BOTH);

/** Verificamos si Corresponde ****************************** */
if (empty($fila)){//No existe coincidencia con id
	header("Location:../../index.php?mensaje=2");
}
else{//Existe Coincidencia
	if($fila['id']==$usr&&$fila['psw']==$psw){//Verifica que coincidan ambos atributos para iniciar sesión y permitir accesos
		session_start();
		$_SESSION['activo']=true;
		$_SESSION['usr']=$usr;
		header("Location:../prueba.php");
		}
	else{//Si no coincide alguno regresamos
		header("Location:../../index.php?mensaje=2");
	}
} 
/** Liberamos resultado y cerramos BD *************************  */
$resultado->free();
$cnxdb->close();//cerramos la base de datos

/*****************************************************************/
?>
