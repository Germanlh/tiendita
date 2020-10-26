<?php
/* 
Destruimos la sesión a petición del usuario o la forzamos dependiendo de las necesidades del programa
*/
/**********************************************/
session_start();
session_unset();
session_destroy();
header("Location:../index.php");
/**********************************************/
?>