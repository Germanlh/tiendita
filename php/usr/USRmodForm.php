<?php


include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);

//if($_SESSION['permisos']==ADMIN){

	$usr=$_GET['usuario'];
	$idkrea=$_GET['idkrea'];
	
	$_SESSION['oldusr']=$usr;
	$_SESSION['oldidkrea']=$idkrea;
/************** conectamos a la BD**************/
	$conexion=conectabd("crmkrea");
	
	echo "<table border=1 width=100%>
		<tr>
			<th>USUARIO</th>
			<th>PASSWORD</th>
		";
	if($idkrea==$_SESSION['idkrea']){
// if($_SESSION['permisos']>ADMIN&&$_SESSION['permisos']<=TALLER){
		echo"<th>CONFIRMAR PASSWORD</th><th></th>";
		$usr=$_SESSION['usuario'];
		$idkrea=$_SESSION['idkrea'];
		$_SESSION['oldusr']=$usr;
		}
	if($_SESSION['permisos']==ADMIN&&$idkrea!=$_SESSION['idkrea']){
		echo"		
				<th>STATUS</th>
				<th>PERMISOS</th>
				<th></th>
			";
		}
	echo"</tr>";	
	$query=mysql_query("SELECT * FROM usuarios WHERE usuario='".$usr."' AND idkrea='".$idkrea."'");
	if(!$query){die("No pudimos actualizar".mysql_error());}
	while($fila=mysql_fetch_array($query)){	
		echo"
			<tr>
				<form method='POST' action='USRmodifica.php'>
					<td><input type='text' name='usuario' value='".$fila['usuario']."'></td>
					<td><input type='text' name='password' value='".$fila['password']."'></td>
					";
		if($idkrea==$_SESSION['idkrea']){			
//		if($_SESSION['permisos']>ADMIN&&$_SESSION['permisos']<=TALLER){
			echo'<td><input type="password" id="psw2" name="psw2" required placeholder="confirme password"></input></td>';
			}
		if($_SESSION['permisos']==ADMIN&&$idkrea!=$_SESSION['idkrea']){	
				
			echo"<td> <select name='status' >";
							for($i=ACTIVO;$i<=BAJA;$i++)	{
								if($fila['status']==$i){echo '<option value="'.$fila['status'].'" selected> '.$abstatus[$fila['status']].' </option> ';}
								else{echo '<option value="'.$i.'"> '.$abstatus[$i].' </option> ';}
								}
				echo"</select></td> <td>	<select name='permisos' >";
							for($i=ADMIN;$i<=TALLER;$i++)	{
								if($fila['permisos']==$i){echo '<option value="'.$fila['permisos'].'" selected> '.$usrtipo[$fila['permisos']].' </option> ';}
								else{echo '<option value="'.$i.'"> '.$usrtipo[$i].' </option> ';}
								}
			echo" </select></td>";
			}		
		echo"				
					<td><input type='submit' name='aceptar' value='cambiar'></td>
				</form>
		</tr>";

		}
	echo "</table>";
	mysql_close($conexion);

	
/*******************************************************************************************/
?>