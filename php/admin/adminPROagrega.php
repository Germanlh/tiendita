<?php
/***************************************************************************/
include("../sesion.php");

/***Recibimos variables para Validar usuario **********************/
if(isset($_POST['enviar'])){
	//foto
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

if($_FILES['foto']['error']>0){}
else{
	$nom_foto=$_FILES['foto']['name'];
	$ruta="../../img/".$nom_foto;
	$archivo_tmp=$_FILES['foto']['tmp_name'];
	$subir=move_uploaded_file($archivo_tmp, $ruta);
}

	/************** conectamos a la BD *******************************/
	include("../conectadb.php");
	
	/** Realizamos la consulta ****************************** */
	$sql= "INSERT INTO producto (nombre,clase,precio_unitario,existencias,descripcion,imagen)
			VALUES ('".$nombre."','".$clase."','".$punit."','".$existencias."','".$descripción."','".$nom_foto."')
			";
	if ($cnxdb->query($sql) === TRUE){header("Location:../tiendita.php?op=2&mensaje=4");}//Registro exitoso 
	else {die("Error al Crear registro en Usuarios:". $cnxdb->error);}

/** Liberamos resultado y cerramos BD *************************  */
	$cnxdb->close();//cerramos la base de datos
/************************************************************************ */
?>
<img src="" alt="">