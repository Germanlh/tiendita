<?php

include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
/*
$origen=$_GET['origen'];//Obtenemos la variable 

if($origen=="EMPLEADO"){ 	$idcliente=$_SESSION['idkrea']; }//Colocamos la ID deacuerdo a si es miembro de Krea o no
else{$idcliente=generaid($nombres,$apellidos);}
*/
$status=ACTIVO;
$tipo=$_POST['tipo'];
$idempresa=$_POST['empresa'];

$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$callenum=$_POST['callenum'];
$colonia=$_POST['colonia'];
$ciudad=$_POST['ciudad'];
$estado=$_POST['estado'];
$cp=$_POST['cp'];

$tel1=$_POST['tel1'];
$tel2=$_POST['tel2'];
$cel=$_POST['cel'];
$email1=$_POST['email1'];
$email2=$_POST['email2'];
$idvendedor=$_POST['vendedor'];
$idcliente=generaid($nombres,$apellidos);

/*
if($origen=="EMPLEADO"){ 	$idcliente=$_SESSION['idkrea']; }//Colocamos la ID deacuerdo a si es miembro de Krea o no
else{$idcliente=generaid($nombres,$apellidos);}

Estas Variables se agregan conforme exista actividad de ventas
ventaanterior
ventaultima
*/

/************** Seleccionamos la base de datos*****************************************************/
$conexion=conectabd("crmkrea");
/***************Primero Verificar si no existe el registro************************************************/

$repeticiones=0;
$consulta=mysql_query("SELECT  * FROM directorio WHERE nombres='$nombres' AND apellidos='$apellidos'");
while($fila=mysql_fetch_array($consulta)){
	if($fila['nombre']==$nombre&&$fila['apellidos']==$apellidos){$repeticiones++;}
	}
	
if($repeticiones==0){//si no existe entonces agregamos el registro
	$query=mysql_query("
		INSERT INTO directorio (
		idcliente, status, tipo, idempresa, nombres, apellidos, direccion, colonia, ciudad, estado, 
		codpos, tel1, tel2, cel, email1, email2, idvendedor )
		VALUES(
		'$idcliente', '$status', '$tipo', '$idempresa', '$nombres', '$apellidos', '$callenum', '$colonia', '$ciudad', '$estado',
		'$cp', '$tel1', '$tel2', '$cel', '$email1', '$email2', '$idvendedor')
		");
	if(!$query){
		die("No se puede Agregar al Directorio PROBLEMAS: ".mysql_error());
		echo "<br><a href=".$pagina."> << Regresar </a>";
		}
	$mensaje="?mensaje=1";//Registro Exitoso
	if($_SESSION['idkrea']=="incompleto"){
		$consulta="UPDATE usuarios SET idkrea='".$idcliente."' WHERE usuario='".$_SESSION['usuario']."' AND idkrea='".$_SESSION['idkrea']."'";
		$query=mysql_query($consulta);
		if(!$query){die("No pudimos actualizar".mysql_error());}
		header ("Location: ../index.php?mensaje=4");
		exit;
		}
	}
else{$mensaje="?mensaje=2";}// El Usuario ya existia 



/********** Cerramos la base de datos ************************************************************/
mysql_close($conexion);	

header ("Location: DIRagregaForm.php".$mensaje);	

?>




