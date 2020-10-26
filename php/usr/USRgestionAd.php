<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

if(!$_GET['orden']){$criterioord="permisos";}
else{$criterioord=$_GET['orden'];}

if($_SESSION['permisos']==ADMIN){
		/**** Conectamos a la BD desde funciones.php ************/
		$conexion=conectabd("crmkrea");
		/*****************Acomodamos la informacion en una tabla *********************************************/
		echo "<h2 align='center'> :: EMPLEADOS KREA :: </h2>";
		$mensaje=$_GET['mensaje'];
		echo"<p align='left'>";
		switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
			case 1: 
				echo"El Usuario fue dado de alta satisfactoriamente";
				break;
			case 2: 
				echo"<mark>El Usuario ya Existe</mark>";
				break;
			case 3: 
				echo"<mark>Incongruencia en los datos Vuelva a intentarlo</mark>";
				break;
			case 4: 
				echo"<mark>Cambios de usuario Realizados Satisfactoriamente</mark>";
				break;
			case 5: 
				echo"<mark>Usuario Eliminado Satisfactoriamente</mark>";
				break;	
			default: break;
			}
		echo"</p>";
		echo"
		<table border=1 width=100%>
			<tr>
				<th><a href='USRgestionAd.php?orden=usuario'> USUARIO </a></th>
				<th><a href='USRgestionAd.php?orden=password'> PASSWORD </a></th>
				<th><a href='USRgestionAd.php?orden=status'> STATUS </a></th>
				<th><a href='USRgestionAd.php?orden=permisos'> PERMISOS </a></th>
				<th></th>
				<th></th>
			</tr>
			";
		$consulta=mysql_query("SELECT * FROM usuarios ORDER BY ".$criterioord);	
		while($fila=mysql_fetch_array($consulta)){
			
			echo "
				<tr>
					<td>".$fila['usuario']."</td>
					<td>".$fila['password']."</td>
					<td>".$abstatus[$fila['status']]."</td>
					<td>".$usrtipo[$fila['permisos']]."</td>
					<td><a href='USRmodForm.php?usuario=".$fila['usuario']."& idkrea=".$fila['idkrea']."'>Actualizar</a></td>  
					<td><a href='USRelimina.php?usuario=".$fila['usuario']."& idkrea=".$fila['idkrea']."'>Eliminar</a>	</td>  
				</tr>
				";
			}
		mysql_close($conexion);
		/***************** En esta seccion agregamos un nuevo usuario *******************/
		/*rowspan combina celdas por columna*/
		echo '
			<tr>
				<th colspan=6>AÑADIR UN NUEVO REGISTRO</th>
			</tr>
			<tr>
				<form method="POST" action="USRagrega.php">
					<td><input type="text" id="usr" name="usr" required placeholder="Nombre de usuario"></input></td>
					<td><input type="password" id="psw" name="psw" required placeholder="Contraseña"></input></td>
					<td></td>
					<td>
						<select name="permisos">
							<option value='.ADMIN.'>Administrador</option>
							<option value='.ENCARGADO.'>Encargado</option>
							<option value='.JEFEPROD.'>Jefe de produccion</option>
							<option value='.VENTAS.'>Vendedor</option>
							<option value='.MOSTRADOR.'>Mostrador</option>
							<option value='.IMPRESOR.'>Impresor</option>
							<option value='.TALLER.'>Taller</option>
						</select>		
					</td>
					<td><input type="submit" id="registrar" name="registrar"></input></td>
					<td></td>
				</form>
			</tr>
		</table> <br>';
}
else{ sinpermiso(1,1,1); }// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
?>