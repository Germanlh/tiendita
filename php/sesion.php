<?php
/**/ 
session_start();
if(!isset($_SESSION['activo']) || $_SESSION['activo']!=true){
    header("Location: cerrarsesion.php");
}

/**********************************************
ini_set("session.use_trans_sid","0");
session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0);

session_start();
if(!isset($_SESSION['activo']) || $_SESSION['activo']!=true){
    header("Location: cerrarsesion.php");
}else{
    $horaacceso=$_SESSION['horaacceso'];
    $horaactual=date("Y-m-d H:i:s");
    $tiempotranscurrido=(strtotime($horaactual)-strtotime($horaacceso));
    //Checamos el tiempo que ha pasado
    if($tiempotranscurrido>=600){	//60 segundos *10 para 10 minutos
        session_destroy();
        header("Location: cerrarsesion.php");	
        }
    }
//Calculamos el tiempo transcurrido
/**********************************************/
?>

