<?php include("../sesion.php");?>
<?php 
/******************************************************************************************************/
/************** conectamos a la BD *******************************/
include("../conectadb.php");
/****************************************************************/
$cambio=false;$importe=0;
if(isset($_GET['p'])){
	$cont=$_SESSION['contador'];
	$_SESSION['total']=0;
	for($i = 0;$i< $_SESSION['contador'];$i++){
		if($_SESSION['producto'][$i]==$_GET['p']){
			$_SESSION['cantidad'][$i] += $_GET['cant'];
			$cambio=true;
		}
	}
	if(!$cambio){
		$_SESSION['producto'][$cont] = $_GET['p'];
		$_SESSION['cantidad'][$cont] = $_GET['cant'];
		$_SESSION['contador']++;
	}
}
if(isset($_GET['x'])){
	for($i = 0;$i< $_SESSION['contador'];$i++){
		if($_SESSION['producto'][$i]==$_GET['x']){
			array_splice($_SESSION['producto'], $i, 1);
			array_splice($_SESSION['cantidad'], $i, 1);
			$_SESSION['contador']--;
		}
		header("Location:../tiendita.php");
	}
}
if(isset($_GET['cancela'])){
	unset($_SESSION['producto']);
	unset($_SESSION['cantidad']);
	unset($_SESSION['total']);
	$_SESSION['contador']=0;
	header("Location:../tiendita.php?mensaje=2");
	
}
/*
for($i = 0;$i< $_SESSION['contador'];$i++){
	echo 'Cantidad: '.$_SESSION['cantidad'][$i].'  ';
	echo 'Id:'.$_SESSION['producto'][$i].'  ';
}
*/
if($_SESSION['contador']>0){
	/*****/
	echo "<table>";
	echo "
		<tr>
			<th>Cant.</th>
			<th>nombre</th>
			<th>P.U.</th>
			<th>Importe</th>
			<th></th>
		</tr>
		";
	for($i = 0;$i< $_SESSION['contador'];$i++){
		
		$sql = "SELECT * FROM producto WHERE id_producto = ".$_SESSION['producto'][$i]." ";
		$resultado = $cnxdb->query($sql);
		while($fila=$resultado->fetch_array(MYSQLI_BOTH)) {
			$importe=$_SESSION['cantidad'][$i]*$fila['precio_unitario'];
			echo "
			<tr>
				<td>".$_SESSION['cantidad'][$i]."</td>
				<td>".$fila['nombre']."</td>
				<td>".$fila['precio_unitario']."</td>
				<td> ".number_format($importe,2)."</td>
				<td><a href='productos/poncarrito.php?x=".$_SESSION['producto'][$i]."'><button>X</button></a></td>
			</tr>
			";
			$_SESSION['total'] += $importe;
		}
	}
	echo "
		<tr>
			<td></td>
			<td></td>
			<td>total</td>
			<td>".number_format($_SESSION['total'],2)."</td>
		</tr>
		";
	echo "</table>";
	echo "
		<a href='productos/poncarrito.php?cancela=1'><button>Cancelar</button></a>
		<a href='productos/confirmar.php'><button>Comprar</button></a>
		";
	
	/************************************************************************* */
	$resultado->free();//Liberamos el resultado
	$cnxdb->close();//cerramos la base de datos
	
}
//<td><a href='productos/poncarrito.php?x=".$_SESSION['producto'][$i]."'><button>X</button></a></td>
//<td><button value='".$_SESSION['producto'][$i]."' class='quitar'>X</button></td>
/************************************************************************************************/
?>

