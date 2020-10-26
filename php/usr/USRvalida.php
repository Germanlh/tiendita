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


$cnxdb->select_db("tiendita");
/*******************************************************************/

$sql = "SELECT * FROM usuarios WHERE id=".$usr;
$resultado=$cnxdb->query($sql);
if (!$resultado) {echo "ERROR";} 


$fila=$resultado->fetch_array(MYSQLI_NUM);
printf ("%s (%s)\n", $fila[0], $fila[1]);

/***Comparamos con las variables ******************************************************* */
if($fila['id']==$usr&&$fila['psw']==$psw){
	session_start();
	$_SESSION['activo']=true;
	$_SESSION['usr']=$usr;
	header("Location:../prueba.php");
	/*
	$_SESSION['idkrea']=$fila['idkrea'];// Si existe asignamos variables encontradas
	$usrbd=$_SESSION['usuario']=$fila['usuario'];
	$pswbd=$fila['password'];	//$_SESSION['password']=$fila['password'];
	$status=$fila['status'];			//$_SESSION['status']=$fila['status'];
	$_SESSION['permisos']=$fila['permisos'];
	*/
	}
else{
	//header("Location:../../index.php?id=".$fila['id']."&psw=".$fila['psw']);
	//header("Location:../../index.php?mensaje=2");
}
echo "id=".$fila['id']."  psw=".$fila['psw'];

$resultado->free();
$cnxdb->close();//cerramos la base de datos
	
/************************************************************************************

if($usr=="xito" && $psw=="123"){
	session_start();
	$_SESSION['activo']=true;
	$_SESSION['usr']=$usr;
	header("Location:../prueba.php");
}
else{
	header("Location:../../index.php?mensaje=2");
}

/********************************************************************************************/

?>
