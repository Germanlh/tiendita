<?php include("../sesion.php");?>
<?php 
/******************************************************************************************************/
/************** conectamos a la BD *******************************/
include("../conectadb.php");
/****************************************************************/
/*

$_SESSION['activo']=true;
$_SESSION['usr']=$usr;
$_SESSION['nombre']=$fila['nombre'];
$_SESSION['permisos']=$fila['permisos'];

$_SESSION['total']
$_SESSION['producto'][$cont] = $_GET['p'];
$_SESSION['cantidad'][$cont] = $_GET['cant'];
$_SESSION['contador']++;


	id_venta int AUTO_INCREMENT,
	id_producto int,
	id_nota int,
	cantidad int,
	precio_unitario float,

    id_nota int AUTO_INCREMENT,
	id_usr varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci,
	total decimal,
	fecha timestamp,
	servido tinyint,
*/

if($_SESSION['contador']>0){
    /* Actualiza Inventario PRODUCTO ***********************************/
    for($i=0;$i<$_SESSION['contador'];$i++){
        $sql = "SELECT existencias FROM producto WHERE id_producto = '".$_SESSION['producto'][$i]."' ";
		$resultado = $cnxdb->query($sql);
        $fila=$resultado->fetch_array(MYSQLI_BOTH);
        $resultado->free();
        $cantidad=$fila['existencias']-$_SESSION['cantidad'][$i];
        
        $sql= "UPDATE producto SET existencias='".$cantidad."' WHERE id_producto='".$_SESSION['producto'][$i]."'";

        if ($cnxdb->query($sql) === TRUE){ }//Registro exitoso 
        else {die("Error al Actualizar Existencias: ". $cnxdb->error);}

    }
    
    
    /*
    $sql = "SELECT * FROM producto WHERE id_producto = ".$_SESSION['producto'][$i]." ";
    $resultado = $cnxdb->query($sql);
    while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
        
    }
    /* Ingresamos productos a NOTA *************************************/
    $fecha =date("Y-m-d H:i:s");
    $sql="INSERT INTO nota (id_usr, total, fecha, servido)
        VALUES ('".$_SESSION['usr']."','".$_SESSION['total']."','".$fecha."',0)
        ";
    if ($cnxdb->query($sql) === TRUE){}//Registro exitoso 
    else {die("Error en NOTA". $cnxdb->error);}

    $sql = "SELECT id_nota FROM nota WHERE id_usr = '".$_SESSION['usr']."' ORDER BY fecha DESC LIMIT 1";
	$resultado = $cnxdb->query($sql);
    $fila=$resultado->fetch_array(MYSQLI_BOTH);
    $id_nota=$fila['id_nota'];
    $resultado->free();
    
    /* Ingresamos productos a VENTA ************************************/

    for($i=0;$i<$_SESSION['contador'];$i++){
        /* Buscamos Precio Unitario de cada producto */
        $sql = "SELECT precio_unitario FROM producto WHERE id_producto = ".$_SESSION['producto'][$i]." ";
		$resultado = $cnxdb->query($sql);
        $fila=$resultado->fetch_array(MYSQLI_BOTH);
        $resultado->free();
        
        $sql="INSERT INTO venta (id_producto, id_nota, cantidad, precio_unitario)
        VALUES (
            '".$_SESSION['producto'][$i]."',
            '".$id_nota."',
            '".$_SESSION['cantidad'][$i]."',
            '".$fila['precio_unitario']."'
        )";
        if ($cnxdb->query($sql) === TRUE){}//Registro exitoso 
        else {die("Error EN VENTA: ". $cnxdb->error);}
    }
    
    /* Elimina Carrito *************************************************/
    unset($_SESSION['producto']);
    unset($_SESSION['cantidad']);
    unset($_SESSION['total']);
    $_SESSION['contador']=0;
        
    /* Regresamos a tiendita.php ***************************************/
    header("Location:../tiendita.php?mensaje=1");

	/************************************************************************* */
	//$resultado->free();//Liberamos el resultado
	$cnxdb->close();//cerramos la base de datos
}
/************************************************************************************************/
?>