<?php
/******************************************************* */

$serverdb = "localhost";
$usrdb = "xito";
$pswdb = "g2r4*2YL1";
$db="tiendita";

$cnxdb= new mysqli($serverdb, $usrdb, $pswdb,$db);//Conexion Base de datos
if($cnxdb->connect_error){
    die("Imposible efectuar Conexión"); 
    exit();
}
    $cnxdb->query("SET NAMES 'utf8'");//Solo para accesar datos

	// Todo este bloque es para asegurar compatibilidad de caracteres 
	$cnxdb->query('SET names=utf8');  
	$cnxdb->query('SET character_set_client=utf8');
	$cnxdb->query('SET character_set_connection=utf8');   
	$cnxdb->query('SET character_set_results=utf8');   
    $cnxdb->query('SET collation_connection=utf8_general_ci'); 

/******************************************************** */
?>