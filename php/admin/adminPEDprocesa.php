<?php
include("../sesion.php");
/************** conectamos a la BD *******************************/
include("../conectadb.php");
/******************************************************************/
if(isset($_GET['op']) && isset($_GET['id'])){
      /*0= pendiente 1=enviado 2=terminado 3=Cancelado*/
    if($_GET['op']==1){$actualiza=3;}//cancela        
    elseif($_GET['op']==2){$actualiza=1;}//envia
    elseif($_GET['op']==3){$actualiza=2;}//terminado   
    elseif($_GET['op']==4){$actualiza=0;}//terminado     
    
    $sql= "UPDATE nota SET servido ='".$actualiza."' WHERE id_nota='".$_GET['id']."'";
    if ($cnxdb->query($sql) === TRUE){header("Location:../tiendita.php?op=3");}//Registro exitoso 
    else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
    /** Liberamos resultado y cerramos BD *************************  */
    $resultado->free();
    $cnxdb->close();//cerramos la base de datos
}
/******************************************************************/
?>
