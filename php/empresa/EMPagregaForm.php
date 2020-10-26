<?php
include("../funciones.php");
sinpermiso(1,1,0);// sinpermiso($jerarquia,$mensaje,$noadmitir) msg 1->  Sin Permisos 2->  No Resgistrado
muestrausr(1);
?>
<!DOCTYPE html>
<html lang="es">
<!-- 
Esta pagina se abre al momento de agregar usuarios al directorio todos pueden agregar registros
pero las modificaciones estan restringidas,  los usuarios de krea deben agregar sus datos al primer acceso a su bandeja
-->
	<head>
		<meta charset="utf-8"> <meta charset="ISO-8859-1"> <link rel="stylesheet" href="">
		<script language="" src=""></script>
		<style type="text/css"> </style>
		<title>:: Agrega Directorio ::</title>
	</head>

	<body>
		<header>
			<h2>Agrega la siguiente información</h2>
			<?php
				if($_SESSION['idkrea']=="incompleto"){
					echo'<mark>Acabas de Iniciar Sesion por primera vez, por favor Ingresa tus datos personales </mark>';
					}
			?>
		</header>
		<nav>	</nav>
									
		<section>
			<header></header>
			<br><br>
			<form method="POST" action="DIRagrega.php" id="directorio" name="directorio">
						
				<input type="text" id="nombres" name="nombres" required autofocus placeholder="Nombre de usuario"></input>
				<input type="text" id="apellidos" name="apellidos" required placeholder="Apellidos"></input><br><br>
				<input type="text" id="callenum" name="callenum"  placeholder="Calle y Número"></input>
				<input type="text" id="colonia" name="colonia" placeholder="Colonia"></input><br>
				<input type="text" id="ciudad" name="ciudad"  placeholder="Ciudad"></input>
				<input type="text" id="estado" name="estado"  placeholder="Estado"></input><br>
				<input type="text" id="cp" name="cp" placeholder="Codigo Postal"></input><br></br>
				<?php
					echo'<select name="tipo" >';
						if($_SESSION['idkrea']=="incompleto"){echo'<option value="'.KREA.'" selected >Empleado KREA</option>';}
						else{
											echo'<option value="'.CLIENTE.'" selected >Cliente</option>';
												
							switch($_SESSION['permisos']){
								case ADMIN:
										echo'		
												<option value="'.PROVEEDOR.'">Proveedor</option>
												<option value="'.TERCERO.'">Tercero</option>
												<option value="'.MAQUILADOR.'">Maquilador</option>';
									break;
								case ENCARGADO:
									echo'	<option value="'.PROVEEDOR.'">Proveedor</option>
												<option value="'.TERCERO.'">Tercero</option>';
									break;
								default:
									break;		
								}
							}
					echo'</select>';	
					
					
				$conexion=conectabd("crmkrea");
				$consulta=mysql_query("SELECT  * FROM usuarios");
				if(!$consulta){die("Problemas para Ver USUARIOS:  ".mysql_error());}
				
				
				echo'<select id="vendedor" name="vendedor" >';   /* ID Vendedor asignado */
					if($_SESSION['idkrea']!="incompleto"){
						while($fila=mysql_fetch_array($consulta)){
							if($fila['permisos']==VENTAS){echo' <option value="'.$fila['idkrea'].'">'.$fila['usuario'].'</option>';	}
							}	
						}
				echo '<option value="'.CLIMOS.'" selected> Mostrador</option></select>';
				
				
				// ID EMPRESA
				echo'<select id="empresa" name="empresa" >';   //*/ ID Vendedor asignado 
					echo'<option value="'.BAJA.'">Empresa</option>';
					/*
					while($fila=mysql_fetch_array($consulta)){
						echo' <option value='.$fila['idkrea'].' selected >'.$fila['usuario'].'</option>';
						}	*/	
				echo '</select>';		
				
				mysql_free_result($consulta);
				mysql_close($conexion);
								
				?>
				<br><br>
				<input type="tel" id="tel1" name="tel1" required placeholder="Telefono1"></input>
				<input type="tel" id="tel2" name="tel2" placeholder="Telefono2"></input>
				<input type="tel" id="cel" name="cel" placeholder="Celular"></input><br><br>
				<input type="email" id="email1" name="email1" required placeholder="e-mail 1"></input>
				<input type="email" id="email2" name="email2" placeholder="e-mail 2"></input><br><br>
				<input type="submit" id="registrar" name="registrar"value="Registrar"></input><br><br>
			
			</form>		
			<footer></footer>
		</section>
		<?php
			$mensaje=$_GET['mensaje'];
			switch($mensaje){//evaluamos el tipo de error y enviamos el mensaje de acuerdo  al problema
					case 1: 
						echo"<br><br>El Usuario fue dado de alta satisfactoriamente";
						break;
					case 2: 
						echo"<br><br>El Usuario ya Existe";
						break;
					case 3: 
						echo"<br><br>Incongruencia en los datos Vuelva a intentarlo";
						break;	
					default: break;
					}		
		?>		
						
		<footer></footer>

	</body>
</html>