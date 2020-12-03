<?php
include("../sesion.php");

/***Recibimos variables para Cambiar al usuario **********************/
if(isset($_POST['enviar'])){
    //foto
    $id=$_POST['id'];
	$nombre=$_POST['nombre'];
	$clase=$_POST['clase'];
	$punit=$_POST['punit'];
    $existencias=$_POST['existencias'];
    $descripción=$_POST['descripcion'];
}
else{
	$nombre="";
	$clase="";
	$punit="";
    $existencias="";
    $descripción="";
}
if($_FILES['foto']['error']>0){
    $sql= "UPDATE producto SET 
            nombre='".$nombre."', 
            clase='".$clase."', 
            precio_unitario='".$punit."', 
            existencias='".$existencias."', 
            descripcion='".$descripción."' 
            WHERE id_producto='".$id."'
			";
}
else{
	$nom_foto=$_FILES['foto']['name'];
	$ruta="../../img/".$nom_foto;
	$archivo_tmp=$_FILES['foto']['tmp_name'];
    $subir=move_uploaded_file($archivo_tmp, $ruta);
    
    $sql= "UPDATE producto SET 
            nombre='".$nombre."', 
            clase='".$clase."', 
            precio_unitario='".$punit."', 
            existencias='".$existencias."', 
            descripcion='".$descripción."',
            imagen='".$nom_foto."' 
            WHERE id_producto='".$id."'
			";
}
	/************** conectamos a la BD *******************************/
	include("../conectadb.php");

		if ($cnxdb->query($sql) === TRUE){header("Location:../tiendita.php?op=2&mensaje=1");}//Registro exitoso 
        else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}
        
	/* Cerramos BD ******************************************** */
	$cnxdb->close();//cerramos la base de datos
?>