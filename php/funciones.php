<?php
/****** Variables Estaticas usados por la tabla USUARIOS ****************************************************/
//Modificamos php.ini pasa usar solo cookis como session 
ini_set("session.use_only_cookies","1");
ini_set("session.use_trans_sid","0");
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);
session_start();
//Corroborar las funciones que tiene 
//session_name("LoginUsuario");
//Cambiamos la duracion de la cookie

define("ACTIVO",1);//********* Constante de Alta o baja
define("BAJA",2);

$abstatus=array(1=>"ACTIVO", 2=>"BAJA");

define("ADMIN",1);//**********Constantes para Usuarios
define("ENCARGADO",2);
define("JEFEPROD",3);
define("VENTAS",4);
define("MOSTRADOR",5);
define("IMPRESOR",6);
define("TALLER",7);

$usrtipo=array(1=>"Administrador", 2=>"Encargado", 3=>"Jefe de Produccion", 4=>"Ventas", 
5=>"Mostrador", 6=>"Impresor", 7=>"Taller");

define("KREA",1);//**********Constantes para DirectoriosUsuarios
define("CLIENTE",2);
define("PROVEEDOR",3);
define("TERCERO",4);
define("MAQUILADOR",5);
define("CLIMOS","mostrador_all");

$dirtipo=array(1=>"Empleado KREA", 2=>"Cliente", 3=>"Proveedor", 
						4=>"Tercero",  5=>"Maquilador", "mostrador_all"=>"Mostrador");

define("MSGURG",1);//************* Constantes para RECADOS
define("MSGQSC",2);
define("MSGQPAV",3);
define("MSGSCD",4);
define("MSGCITA",5);
define("MSGVINO",6);

$msgtipo=array(1=>"Urgente", 2=>"Que se comunique", 3=>"Que pasa a verlo a cierta hora", 
						4=>"Se comunica despues",  5=>"Solicita Cita", 6=>"Vino a verlo");
						
/*prioridad tinyint				// Indica la prioridad del evento en cuestion 1-> Muy Alta  2-> Alta   3->Normal   4->No necesaria*/
define("CEMALTA",1);//************* Constantes para Calendario
define("CEALTA",2);
define("CENORMAL",3);
define("CENNECESARIA",4);

$calprioridad=array(1=>"Muy alta", 2=>"Alta", 3=>"Normal", 4=>"No necesaria",);

						

/************** DESTRUYE SESSION *****************************************************************/
function destruyesesion(){
	session_unset();
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) { 
	   setcookie(session_name(), '', time()-42000, '/'); 
		} 
	session_destroy(); 
	$parametros_cookies = session_get_cookie_params(); 
	setcookie(session_name(),0,1,$parametros_cookies["path"]);
	session_start();
	session_regenerate_id(true);
return;
}
/************** conectamos a la BD********************************************************************/
function conectabd($nombd){
	//$nombd es a la base de datos a la que nos vamos a conectar
	$conexion=mysql_connect("localhost","shitochang","g2r42yl1");
	if(!$conexion){die("No se establecio la conexion".mysql_error()); }
		mysql_query("SET NAMES 'utf8'");//Solo para accesar datos
	mysql_select_db($nombd,$conexion);//Seleccionamos la BD

		//	mysql_query('SET character_set_results=utf8');// Todo este bloque es para asegurar compatibilidad de caracteres 
			mysql_query('SET names=utf8');  
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_connection=utf8');   
			mysql_query('SET character_set_results=utf8');   
			mysql_query('SET collation_connection=utf8_general_ci'); // Todo este bloque es para asegurar compatibilidad de caracteres

return $conexion;//Devolvemos $conexion para poder cerrar adecuadamente la base de datos
}
/*********** Generamos una funcion para generar Id *********************************************************/
function generaid($nombre,$apellidos){
				
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$cad = "";
	for($i=0;$i<1;$i++) {//Generamos un caracter Aleatorio
		$cad = substr($str,mt_rand(0,62),1);
	}
	$reemplazar=array(" ","\t","\n","\r","\0","\x0B");
	$nombre=str_replace($reemplazar, $cad, $nombre);//Reemplazamos espacios vacios por caracter Aleatorio
	$apellidos=str_replace($reemplazar, $cad, $apellidos);//Reemplazamos espacios vacios por caracter Aleatorio
	$nombre=mb_substr($nombre,0,3,'UTF-8');//Seleccionamos los primeros 3 caracteres
	$apellidos=mb_substr($apellidos,0,3,'UTF-8');//Seleccionamos los primeros 3 caracteres
	$inter = "";
	for($i=0;$i<3;$i++) {//Seleccionamos 3 caracteres Aleatorios para el intermedio
		$inter .= substr($str,mt_rand(0,62),1);
		}
	$fin=uniqid();//Seleccionamos los ultimos 4 digitos de los microsegundos
	$fin=mb_substr($fin,-4,4,'UTF-8');
	
	$id=$nombre.$apellidos.$inter.$fin;	
	
return $id;
}
/*********** Mensje para no permiso ********************************************************************/
function sinpermiso($jerarquia,$mensaje,$noadmitir){
	if($jerarquia==0){$texto="index.php";	}		//mensaje=1->  Sin Permisos
	if($jerarquia==1){$texto="../index.php";	}	//mensaje=2->  No Resgistrado
	$iniciada=isset($_SESSION['permisos']);
	//esta opcion es solo para enviar el mensaje o no este inicada la variable
	if($noadmitir==1||$iniciada==0){
		echo '
			<html>
				<head><meta http-equiv="REFRESH" content="0;url='.$texto.'?mensaje='.$mensaje.'"></head>
			</html>
			';
		exit(); 
		}
	else{	
		if ($_SESSION['permisos'] <= 0||$_SESSION['permisos'] >TALLER) { //Excluye sessiones fuera de rango
			header("Location: ".$texto."?mensaje=".$mensaje);	
			exit(); //ademas salgo de este script 
			}	
		else{	//Es una sesion dentro del rango valido
			//Calculamos el tiempo transcurrido
			$horaacceso=$_SESSION['horaacceso'];
			$horaactual=date("Y-m-d H:i:s");
			$tiempotranscurrido=(strtotime($horaactual)-strtotime($horaacceso));
			//Checamos el tiempo que ha pasado
			if($tiempotranscurrido>=600){	//60 segundos *10 para 10 minutos
				session_destroy();
				header("Location: ".$texto."?mensaje=3");	
				}
			else{$_SESSION['horaacceso']=$horaactual;}
			}
		}
return;
}
/***************************************************************************************************/
function muestrausr($jerarquia){
	if($jerarquia==0){$texto="";	}		
	if($jerarquia==1){$texto="../";	}
	global $usrtipo;// Para acceder a las variables globales debemos declararlas al principio de la funcion
	echo" 
		Bienvenido: << ".$_SESSION['usuario']." >>    Accediste con permisos  de: << ".$usrtipo[$_SESSION['permisos']]." >>  
		<a href='".$texto."index.php'>Salir</a> ";
	echo '<HR align="LEFT" size="2" width="50%" color="Red"><br>';	
	//echo"<br>***************************************************************************************<br>";
	linkssesion($texto); 
	echo"<br>";
return;
}
/***************************************************************************************************
function redirige($jerarquia){
	if($jerarquia==0){$texto="";	}		
	if($jerarquia==1){$texto="../";	}
	switch($_SESSION['permisos']){
		case ADMIN: header ("Location:".$texto."aadmin.php"); break;
		case ENCARGADO: header ("Location: ".$texto."aencargado.php");	break;
		case JEFEPROD: header ("Location: ".$texto."ajefeprod.php");	break;
		case VENTAS: header ("Location: ".$texto."aventas.php"); break;
		case MOSTRADOR:  header ("Location: ".$texto."amostrador.php"); break;
		case IMPRESOR:  header ("Location: ".$texto."aimpresor.php"); break;
		case TALLER: header ("Location: ".$texto."ataller.php"); break;
		default: sinpermiso(1,1,1);	break;
		}
}
/***************************************************************************************************/
function linkssesion($texto){
	echo'<li><a href="'.$texto.'principal.php">Inicio</a></li>';
	echo'<li><a href="'.$texto.'usr/USRmodForm.php?idkrea='.$_SESSION['idkrea'].'">Cambia tu Usuario</a></li>';	
	echo'<li><a href="'.$texto.'directorio/DIRmodificaForm.php?nombres=empleado&idcliente='.$_SESSION['idkrea'].'">Actualiza Tus datos</a></li>';	
	echo'<li><a href="'.$texto.'directorio/DIRagregaForm.php">Agrega al Directorio </a></li>';
	echo'<li><a href="'.$texto.'directorio/DIRconsulta.php">Consulta Directorio </a></li>';	
	echo'<li><a href="'.$texto.'recados/RECagregaForm.php">Agregar Recado</a></li>';
	echo'<li><a href="'.$texto.'recados/RECconsulta.php">Consulta Recados</a></li>';
	switch($_SESSION['permisos']){
		case ADMIN: 
			echo'<li><a href="'.$texto.'usr/USRgestionAd.php">Gestion de usuarios  </a></li>';
			echo'<li><a href="'.$texto.'calendario/CALconsulta.php">Consulta Calendario</a></li>';
			break;
		case ENCARGADO: 
			echo'<li><a href="'.$texto.'usr/USRagrega1.php">Agrega usuarios</a></li>';
			echo'<li><a href="'.$texto.'calendario/CALconsulta.php">Consulta Calendario</a></li>';
			break;
		case JEFEPROD: 
			echo'<li><a href="'.$texto.'calendario/CALconsulta.php">Consulta Calendario</a></li>';
			break;
		case VENTAS:
			echo'<li><a href="'.$texto.'calendario/CALconsulta.php">Consulta Calendario</a></li>';
			break;
		case MOSTRADOR: 
			break;
		case IMPRESOR:
			break;
		case TALLER:
			break;
		default:break;
		}
	}
//echo'<br><br><li><a href="'.$texto.'calendario/CALagregaForm.php">Agrega al calendario</a></li>';	
/***************************************************************************************************/
?>