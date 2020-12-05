<?php
/* 
Destruimos la sesión a petición del usuario o la forzamos dependiendo de las necesidades del programa
*/
/**********************************************
session_start();
session_unset();
session_destroy();
header("Location:../index.php");
/**********************************************/
session_start();
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
session_destroy(); 
header("Location:../index.php");
?>