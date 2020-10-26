<?php
include("funciones.php");
destruyesesion();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8"> <meta charset="ISO-8859-1"> <link rel="stylesheet" href="">
		<script language="javascript" src=""></script>
		<style type="text/css"> </style>
		<title>CRM Krea</title>
	</head>

	<body>
		<header>
			<h2	align="center" > :: BIENVENIDO :: al Sistema de Gestion de KREA</h2>
			<nav>	
					<a href="'.$texto.'aadmin.php">Inicio</a>
  				   <a href="'.$texto.'usr/USRgestionAd.php">Gestion de usuarios  </a>  
				   <a href="'.$texto.'directorio/DIRagregaForm.php">Agrega al Directorio </a>
			</nav>
		</header>
		
		<HR align="CENTER" size="2" width="50%" color="Red">
	
		<section>
			<header></header>
		<!-- Aqui colocamos nuestro formulario para acceder a las demas Paginas, dependiendo de que clase de usuario seas
			veras la siguiente pagina editada valign="top" valign="middle" valign="bottom"   valign="baseline"  valign="top"
				align="center" align="left" align="right"-->
				
			<table width="100%"  border="1" cellspacing="1" cellpadding="0" valign="middle">
				  <tr>	<td height="40" align="center" >texto  alineado arriba </td> </tr>
				  <tr>	<td height="40" align="left" >texto  alineado al centro </td>  </tr>
				  <tr>	<td height="40" align="right">texto alineado abajo </td>  </tr>
				  <tr>	<td height="40" align="justify">texto alineado en la llinea de base </td>  </tr>
			</table>
					

			<p align="left"> 
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
			Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
			non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			</p> 

			<p align="center"> 
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
			Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
			non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			</p> 

			<p align="right"> 
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
			Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
			non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			</p> 

			<p align="justify"> 
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
			Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
			non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			</p> 

			
				<article>
					<header></header>
						<p class="next-to-aside"></p>
						<aside>	<p></p></aside>
					<footer></footer>
				</article>
			
			<footer></footer>
		</section>

		<footer></footer>
	</body>
</html>