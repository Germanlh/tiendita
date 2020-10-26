<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

$criterioord="tipo";
$tipo="todos";
$datoscliente="no";

if(!$_GET['orden']){$criterioord="tipo";}
else{$criterioord=$_GET['orden'];}

if(!$_GET['tipo']){$tipo="todos";}
else{$tipo=$_GET['tipo'];}

if(!$_GET['idcliente']){$datoscliente="no";}
else{$datoscliente=$_GET['idcliente'];}
/*
NOMBRE	APELLIDOS    TIPO    IDVENTAS     VER
*/
echo "<h2 align='center'> :: DIRECTORIO :: </h2>";

$mensaje=$_GET['mensaje'];
echo"<p align='left'>";
switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
	case 1: 
		echo"<mark>Cambios del  Registro Realizados Satisfactoriamente</mark> </p>";
		break;
	case 2: 
		echo"<mark>Registro Eliminado Satisfactoriamente</mark> </p>";
		break;	
	default: break;
	}
			
echo"
<table border=1 width=100% valign='middle'>
<form method='GET' id='filtro' name='filtro'></form>			
	<tr>
		<td colspan=2 align='right'> FILTRAR REGISTROS POR TIPO</td>
		<td>
			<select name='tipo' form='filtro' >
				<option value='todos' selected >Todos</option>
				<option value='".KREA."'>Krea</option>
				<option value=".CLIENTE.">Cliente</option>
				<option value='".MAQUILADOR."'>Maquilador</option>
		";
	if($_SESSION['permisos']==ADMIN || $_SESSION['permisos']==ENCARGADO ){
					echo"<option value='".PROVEEDOR."'>Proveedor</option>";
					echo"<option value='".TERCERO."'>Tercero</option>";
					}
	if($_SESSION['permisos']==JEFEPROD){echo"<option value='".TERCERO."'>Tercero</option>";	}	
	echo"
			</select>
			<input type='submit' id='filtrar' name='filtrar' value='FILTRAR'  form='filtro'>
		</td>
		<td colspan=3></td>
	</tr>
	<tr>
		<th><a href='DIRconsulta.php?orden=nombres&tipo=".$tipo."&idcliente=".$datoscliente."'> NOMBRES </a></th>
		<th><a href='DIRconsulta.php?orden=apellidos&tipo=".$tipo."&idcliente=".$datoscliente."'> APELLIDOS </a></th>
		<th><a href='DIRconsulta.php?orden=tipo&tipo=".$tipo."&idcliente=".$datoscliente."'> TIPO </a></th>
		<th>DATOS</th>
		<th>ACTUALIZAR</th>
		<th>ELIMINAR</th>
	</tr>
	";
/**************************************************************************************/
	$conexion=conectabd("crmkrea");
	
	if($tipo=="todos"){	$peticion="SELECT * FROM directorio ORDER BY ".$criterioord;	}
	else{ $peticion="SELECT * FROM directorio WHERE tipo='".$tipo."' ORDER BY ".$criterioord;}
	$consulta=mysql_query($peticion);	
	$bgcolor="#FFFFFF";
	while($fila=mysql_fetch_array($consulta)){
		
		if($bgcolor=="#FFFFFF"){$bgcolor="#DDDDDD";}
		else{$bgcolor="#FFFFFF";}
		
		$linkactualizar=$linkelimina="";
		switch($_SESSION['permisos']){
			case ADMIN:
				$linkactualizar=" <a href='DIRmodificaForm.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Actualizar</a>	";
				$linkelimina="<a href='DIRelimina.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Eliminar</a>";	
				break;
			case ENCARGADO:
				if($fila['tipo']==PROVEEDOR||$fila['tipo']==TERCERO||$fila['tipo']==MAQUILADOR){
					$linkactualizar=" <a href='DIRmodificaForm.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Actualizar</a>	";
					}
				if($fila['tipo']==CLIENTE&&$fila['idvendedor']==CLIMOS){
					$linkactualizar=" <a href='DIRmodificaForm.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Actualizar</a>	";
					$linkelimina="<a href='DIRelimina.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Eliminar</a>";	
					}	
				break;
			case VENTAS:
				if($fila['tipo']==CLIENTE&&$fila['idvendedor']==$_SESSION['idkrea']){
					$linkactualizar=" <a href='DIRmodificaForm.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Actualizar</a>	";
					$linkelimina="<a href='DIRelimina.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Eliminar</a>";	
					}
				break;
			case MOSTRADOR:
				if($fila['tipo']==CLIENTE&&$fila['idvendedor']==CLIMOS){
					$linkactualizar=" <a href='DIRmodificaForm.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Actualizar</a>	";
					}
				break;
			case JEFEPROD:
				if($fila['tipo']==CLIENTE&&$fila['idvendedor']==CLIMOS){
					$linkactualizar=" <a href='DIRmodificaForm.php?nombres=".$fila['nombres']."&idcliente=".$fila['idcliente']."'>Actualizar</a>	";
					}
				break;	
			default:break;			
			}		
		 /**************************************************************************************/
		$verdir=0;
		switch($_SESSION['permisos']){
			case ADMIN: $verdir=1; break;
			case ENCARGADO: $verdir=1; break;
			case JEFEPROD: 
				if($fila['tipo']==PROVEEDOR){$verdir=0;}
				else{$verdir=1;}
				break;
			default:
				if($fila['tipo']==PROVEEDOR || $fila['tipo']==TERCERO){$verdir=0;}
				else{$verdir=1;}
				break;
			}
			
		if($verdir==1){
			echo "<tr bgcolor=".$bgcolor.">
					<td>".$fila['nombres']."</td>
					<td>".$fila['apellidos']."</td>
					<td>".$dirtipo[$fila['tipo']]."</td>
					<td> <a href='DIRconsulta.php?idcliente=".$fila['idcliente']."&orden=".$criterioord."&tipo=".$tipo."'>Ver</a>	</td>  
					<td>".$linkactualizar."</td>
					<td>".$linkelimina."</td>
				</tr>";// final de la fila
				
			if($datoscliente==$fila['idcliente']){	
				echo"<tr bgcolor=".$bgcolor.">
						<td colspan=6>
						DIRECCION: ".$fila['direccion']."  COLONIA:".$fila['colonia']."<br>
						C.P. : ".$fila['codpos']."  ".$fila['ciudad'].", ".$fila['estado']."<br><br>
						TEL: ".$fila['tel1'].",  ".$fila['tel2']."    CEL: ".$fila['cel']."<br>
						E-MAIL: ".$fila['email1'].", ".$fila['email2']."
						</td>
					</tr>";
				}
			}
		
		}

mysql_close($conexion);
echo "</table> <br>";


/*********************************************************************************************/
				
?>