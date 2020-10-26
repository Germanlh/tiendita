<?php
/*
Validamos que la sesion se mantenga activa, en caso contrario, cierre la sesion y pida ingresar nuevamente
 */
/**********************************************/
session_start();
if(!isset($_SESSION['activo']) || $_SESSION['activo']!=true){
    header("Location: cerrarsesion.php");
}
/**********************************************/
?>