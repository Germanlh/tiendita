<?php


include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

$nombres=$_GET['nombres'];
$idcliente=$_GET['idcliente'];


$_SESSION['oldusr']=$nombres;
$_SESSION['oldidkrea']=$idcliente;
/************** conectamos a la BD**************/
	$conexion=conectabd("crmkrea");
	
	$nvendedores=0;	
	$consulta=mysql_query("SELECT  * FROM usuarios");
	if(!$consulta){die("No pudo Acceder: ".mysql_error());}
		while($fila=mysql_fetch_array($consulta)){
			if($fila['permisos']==VENTAS){
			$arrayventas[$nvendedores]=$fila['usuario'];
			$arrayidventas[$nvendedores]=$fila['idkrea'];
			$nvendedores++;
			}
		}	
	$arrayventas[$nvendedores]="Mostrador";$arrayidventas[$nvendedores]=CLIMOS;$nvendedores++;
 //mysql_free_result($fila);
	if($nombres=="empleado"){
		$query=mysql_query("SELECT * FROM directorio WHERE  idcliente='".$idcliente."'");
		if(!$query){die("No pudimos actualizar".mysql_error());}
		}
	else{
		$query=mysql_query("SELECT * FROM directorio WHERE nombres='".$nombres."' AND idcliente='".$idcliente."'");
		if(!$query){die("No pudimos actualizar".mysql_error());}
		}
	
	while($fila=mysql_fetch_array($query)){	
				
		echo'
			<form method="POST" action="DIRmodifica.php" id="directorio" name="directorio">
				<input type="text" value="'.$fila['nombres'].'" id="nombres" name="nombres" required autofocus ></input>
				<input type="text" value="'.$fila['apellidos'].'" id="apellidos" name="apellidos" required ></input><br><br>
				<input type="text" value="'.$fila['direccion'].'" id="callenum" name="callenum" ></input>
				<input type="text" value="'.$fila['colonia'].'" id="colonia" name="colonia" ></input><br>
				<input type="text" value="'.$fila['ciudad'].'" id="ciudad" name="ciudad"></input>
				<input type="text" value="'.$fila['estado'].'" id="estado" name="estado"></input><br>
				<input type="text" value="'.$fila['codpos'].'" id="cp" name="cp"></input><br></br>	';
				if($fila['idcliente']==$_SESSION['idkrea']){
					
					echo'<select name="tipo" id="tipo">
								<option value="'.$fila['tipo'].'" selected> '.$dirtipo[$fila['tipo']].' </option> 
							</select>';
		
					echo'<select id="status" name="status" >
								<option value="'.$fila['status'].'" selected> '.$abstatus[$fila['status']].' </option>
							</select>';
						
	// Esta seccion la vamos a modificar cuando tengamos de alta a las empresas			
					echo'<select id="empresa" name="empresa" > 
								<option value="'.BAJA.'">Empresa</option>
							</select>';

					echo'<select id="vendedor" name="vendedor" >
								<option value="'.CLIMOS.'" selected> Mostrador</option> 
							</select>';
					}
				else{	
					echo'<select name="tipo" id="tipo">';
						if($fila['tipo']==MAQUILADOR){echo '<option value="'.$fila['tipo'].'" selected> '.$dirtipo[$fila['tipo']].' </option> ';}
						else{
							for($i=KREA;$i<=MAQUILADOR;$i++)	{			
								$permiso=0;  $op=0; 
								switch($i){
									case KREA: $op=2; break;
									case CLIENTE:  $permiso=1;  break;
									case PROVEEDOR:  $op=1;  break;
									case TERCERO:  $op=1; break;
									case MAQUILADOR:  $op=2; break;
									default:  break;
									}
								switch($op){
									case 1: 
										if($_SESSION['permisos']==ENCARGADO||$_SESSION['permisos']==ADMIN){$permiso=1;}
										else{$permiso=0;}
										break;
									case 2:
										if($_SESSION['permisos']==ADMIN){$permiso=1;}
										else{$permiso=0;}
										break;
									default: break;
									}
								if($permiso==1){
									if($fila['tipo']==$i){echo '<option value="'.$fila['tipo'].'" selected> '.$dirtipo[$fila['tipo']].' </option> ';}
									else{ echo '<option value="'.$i.'"> '.$dirtipo[$i].' </option> ';	}
									}
								}
							}
					echo'</select>';
		
					if($_SESSION['permisos']==ADMIN||$_SESSION['permisos']==VENTAS){
						echo'<select id="status" name="status" >';
							for($i=ACTIVO;$i<=BAJA;$i++)	{
										if($fila['status']==$i){echo '<option value="'.$fila['status'].'" selected> '.$abstatus[$fila['status']].' </option> ';}
										else{echo '<option value="'.$i.'"> '.$abstatus[$i].' </option> ';}
										}					
						echo'</select>';
						}
	// Esta seccion la vamos a modificar cuando tengamos de alta a las empresas			
					echo'
						<select id="empresa" name="empresa" > 
							<option value="'.BAJA.'">Empresa</option>
						</select>';

					echo'<select id="vendedor" name="vendedor" >';   /* ID Vendedor asignado */
								for($i=0;$i<$nvendedores;$i++)	{
									if($fila['idvendedor']==$arrayidventas[$i]){echo '<option value="'.$fila['idvendedor'].'" selected> '.$arrayventas[$i].' </option> ';}
									else{echo' <option value="'.$arrayidventas[$i].'">'.$arrayventas[$i].'</option>';}
									}					
					echo'</select>';
					}
				echo'
					<br><br>
					<input type="tel" value="'.$fila['tel1'].'" id="tel1" name="tel1" required placeholder="Telefono1"></input>
					<input type="tel" value="'.$fila['tel2'].'" id="tel2" name="tel2" placeholder="Telefono2"></input>
					<input type="tel" value="'.$fila['cel'].'" id="cel" name="cel" placeholder="Celular"></input><br><br>
					<input type="email" value="'.$fila['email1'].'" id="email1" name="email1" required placeholder="e-mail 1"></input>
					<input type="email" value="'.$fila['email2'].'" id="email2" name="email2" placeholder="e-mail 2"></input><br><br>
					<input type="submit" id="modificar" name="modificar" value="Modificar"></input><br><br>
					</form>
					';
		}
	mysql_close($conexion);
/*******************************************************************************************/
?>